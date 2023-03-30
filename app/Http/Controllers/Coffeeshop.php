<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Product;
use App\models\Cart;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Validator;
class Coffeeshop extends Controller
{
    public function index(){
        return view('admin.home') ;
    }

    public function products(Type $var = null)
    {
        return view('admin.products') ;   
    }
    public function get_products(Type $var = null)
    {
        $data =  Product::all() ;
        return response()->json( ['data' => $data ] ) ;
        
    }



    public function manage_orders(Request $req){
        $cart =  Cart::where('id', '=', $req->id )->first() ;
        if( $cart->is_refund == 1 ){

        $update = Cart::where('id', '=', $req->id )->update(
            [
                'is_refund'  => '0'
            ]
            );
            if( $update == 1 ){
                $user = User::where('id', '=', $cart->customer_id )->first() ; 
                $wallet = $user->wallet ;
                $wallet =  $wallet +  $cart->total_amt ;
                $update_user = User::where('id', '=', $cart->customer_id )->update(
                    [
                        'wallet'  => $wallet
                    ]
                    );
                if($update_user == 1){
                    $msg = 'Amount Refunded successfully !' ;
                    return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
                }      
            }
        }else{
            $msg = 'Request Already sent to admin!   ' ;
            return response()->json(array('msg'=> $msg , 'code' => 0  ), 200);
        }
    }

    public function  get_orders_data(){
        $data =  DB::table('carts')
        ->join('users', 'users.id', '=', 'carts.customer_id')
        ->select('users.*', 'carts.*')
        ->get() ;
        return response()->json( ['data' => $data ] ) ;
     }

    public function orders(Type $var = null)
    {
        return view('admin.orders') ;
    }

    public function add_products(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'name'=> 'required',
            'price'=>'required',
            'pic'=>'required',
            
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
                    $path = '/uploads/products/';

                    if (env('APP_ENV') == 'local') {
                        $file_path =  public_path()."/uploads/products/";
                    }else{
                        $file_path = base_path().'/' .config('app.root_folder').$path ;
                    }
                    $fileName = time().'.'.$file->extension();
                    $file->move($file_path,$fileName);
                    $attachment=$fileName;
                }
            }
            else{
                $attachment="no";
            }

            $Product_details = Product::where('product_name', '=', $req->name )->get();
        
            if( count($Product_details) == 0 ){
                $Product = new Product ;
                $Product->product_name = $req->name ;
                $Product->product_price = $req->price ;
                $Product->product_pic = $attachment ;
               
                $Product->save() ;
                if( $Product->save() == 1 ){
                    $msg = 'Product added  successfully!' ;
                    
                   
                    return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
                }
            }else{
                $msg = 'Product already exist !' ;
                return response()->json(array('msg'=> $msg , 'code' => 0 ) , 200);
            }
            


        }
    }


    public function edit_products(Request $req){
        $validator = Validator::make($req->all(), [
            'name'=> 'required',
            'price'=>'required',
            'pic'=>'required',
            
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
                    $path = '/uploads/products/';
                   
                    if (env('APP_ENV') == 'local') {
                        $file_path =  public_path()."/uploads/products/";
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
          
            $update = Product::where('id', '=', $req->id )->update(
                [
                    'product_name'  => $req->name ,
                    'product_price' => $req->price ,
                    'product_pic'  => $attachment 
                ]
            );
            
            if( $update == 1 ){
                $msg = 'Product Updated  successfully!' ;
            
                return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
            }

        }
        
    }

    public function delete_products(Request $req)
    {
        
        $delete = Product::where('id','=',$req->id)->delete();      
        
        
        if( $delete == 1 ){
            $msg = 'Customer Deleted  successfully!' ;
        
            return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
        }else{
            $msg = 'Customer Not Deleted !' ;
        
            return response()->json(array('msg'=> $msg , 'code' => 0 ), 200);
        }
    }


    public function customers(Type $var = null)
    {
        $data =  User::all() ;
        return view('admin.customer' ) ;
    }

    public function get_customers(Type $var = null)
    {
        $data =  User::all() ;
        return response()->json( ['data' => $data ] ) ;
        
    }
    public function add_customer(Request $req)
    {
        
        $User_details = User::where('email', '=', $req->email )->get();
        
        if( count($User_details) == 0 ){
            $user = new User ;
            $user->name = $req->name ;
            $user->email = $req->email ;
            $user->phone = $req->phone ;
            $user->password = '12345' ;
            $user->save() ;
            if( $user->save() == 1 ){
                $msg = 'Customer added  successfully!' ;
                $data = [
                    'email'=>$req->email,
                    'password'=>$user->password
                ];
                try
                {
                    Mail::to($user->email)->send(new MailNotify($data ));
                }
                catch(Exception $e)
                {
                    $err = 'some error occur' ;
                    Mail::to($user->email)->send(new MailNotify($err ));
                }
                return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
            }
        }else{
            $msg = 'User already exist !' ;
            return response()->json(array('msg'=> $msg , 'code' => 0 ) , 200);
        }
        
       
    }


    public function edit_customer(Request $req)
    {
        
              
        $update = User::where('id', '=', $req->id )->update(
            [
                'name'  => $req->name ,
                'email' => $req->email ,
                'phone'  => $req->phone 
            ]
        );
        
        if( $update == 1 ){
            $msg = 'Customer Updated  successfully!' ;
        
            return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
        }
    }

    public function delete_customer(Request $req)
    {
        
        $delete = User::where('id','=',$req->id)->delete();      
        
        
        if( $delete == 1 ){
            $msg = 'Customer Deleted  successfully!' ;
        
            return response()->json(array('msg'=> $msg , 'code' => 1 ), 200);
        }else{
            $msg = 'Customer Not Deleted !' ;
        
            return response()->json(array('msg'=> $msg , 'code' => 0 ), 200);
        }
    }





   

    
}
