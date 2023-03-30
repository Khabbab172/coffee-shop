<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Product;
use App\models\Cart;
use Illuminate\Support\Facades\Validator;



class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.profile') ;
    }
    public function ordercoffee()
    {
        return view('customer.order') ;
    }

   public function apply_refund(){
       return view('customer.refund') ;
   }

   public function  get_cart_data(){
      $customer_id = User::where('email'  ,'=' , session('email')   )->value('id') ;
      $data =  Cart::where('customer_id'  , '=' ,$customer_id )->get() ;
      return response()->json( ['data' => $data ] ) ;
   }

 public function  wallet(){
    $wallet =   User::where('email'  ,'=' , session('email') )->value('wallet') ;
    return response()->json( ['wallet' => $wallet ] ) ;
 }


public function apply_for_refund(Request  $req){
    $is_refund =  Cart::where('id', '=', $req->id )->value('is_refund') ;
    if( $is_refund == 0 ){

        $update = Cart::where('id', '=', $req->id )->update(
            [
                'is_refund'  => '1'
            ]
            );
            if( $update == 1 ){
                $msg = 'Request sent to admin!   ' ;
                return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
            }
    }else{
        $msg = 'Request Already sent to admin!   ' ;
        return response()->json(array('msg'=> $msg , 'code' => 0  ), 200);
    }
}



    public function buy_coffee(Request $req){
        $user  =   User::where('email'  , '=' , session('email') )->first()  ;
        // $Product_details = Product::where('product_name', '=', $req->name )->get();
        
        
                $Cart = new Cart ;
                $Cart->customer_id = $user->id ;
                $Cart->product_id = $req->id ;
                $Cart->product_name = $req->name ;
                $Cart->product_price = $req->price ;
                $Cart->quantity = $req->quantity ;
                $Cart->total_amt = $req->total ;
                $wallet =   $user->wallet -  $req->total  ;
                if($wallet > 0){
                    $Cart->save() ;
                    if( $Cart->save() == 1 ){
                        $update = User::where('id', '=', $user->id )->update(
                            [
                                'wallet'  => $wallet 
                                ]
                            );
                        if( $update == 1 ){
                            $msg = 'Order is placed successfully!   ' ;
                            $msg .= 'Wallet : '.$wallet ;
                            return response()->json(array('msg'=> $msg , 'code' => 1 , $wallet ), 200);
                        }
                     
                    }
                }else{
                    $msg = 'Your wallet is empty !'  ;
                    return response()->json(array('msg'=> $msg , 'code' => 0 ), 200);
                } 

        
    }

    public function get_customer_data()
    {
        $data =  User::where('email' ,'=' ,  session('email') )->where('password' ,'='  ,session('password'))->first() ;
        return response()->json( ['data' => $data ] ) ;
    }

    public function cart()
    {
        $data =  Cart::where('customer_id' ,'=' ,  session('id') )->count() ; 
        return response()->json( ['data' => $data ] ) ;
    }

    public function edit_profile(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name'=> 'required',
            'email'=>'required',
            'phone'=>'required',
            'pic'=>'required'
            
        ]);
        if($validator->fails()) {
            return ['code'=>0, 'msg'=>"Error: Mandatory Fields should be filled.", '_error'=> 1];
            exit;
        }
        else
        {
          
            if($req->hasFile('pic'))
            {  
                $validat = Validator::make($req->all(), [
                'pic' => 'required|mimes:jpeg,png,jpg|max:500000',
                ]);
                if($validat->fails()) {
                    $file = $req->file('pic');
                    $msg = 'Please fill required fields !';
                    return response()->json(array('msg'=> $msg , 'code' => 0 ), 200);
                    
                }
                else{
                    $file = $req->file('pic');
                    $path = '/uploads/profile_pic/';
                   
                    if (env('APP_ENV') == 'local') {
                        $file_path =  public_path()."/uploads/profile_pic/";
                    }else{
                        $file_path = base_path().'/' .config('app.root_folder').$path;
                    }
                    $fileName = time().'.'.$file->extension();
                    $file->move($file_path,$fileName); 
                    $attachment=$fileName;
                }
            }
            else{
                $attachment="no";
            }
          
            $update = User::where('id', '=', $req->id )->update(
                [
                    'name'  => $req->name ,
                    'email' => $req->email ,
                    'phone'  => $req->phone ,
                    'profile_pic'    => $attachment  
                ]
            );
            
            if( $update == 1 ){
                $msg = 'Profile Updated  successfully!' ;
            
                return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
            }

        }
        
    }
}
