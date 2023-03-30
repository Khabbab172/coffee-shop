<?php

namespace App\Http\Controllers;
use App\models\User;
use Illuminate\Http\Request;

class UserAuth extends Controller
{
    public function verify_user_details( Request $req )
    {
        $data =  $req->input() ; 
        
        $user_data =User::where('email' ,'=' , $data['email'] )->where('password' ,'=' , $data['password'])->get() ;
        
if(count($user_data) > 0 ){
    if(User::where('email' ,'=' , $data['email'] )->value('usertype') == 1){
        $req->session()->put('email' , $data['email']) ;
        // $req->session()->put('id' , $user_data->id) ;
        $req->session()->put('password' , $data['password']) ;
        $req->session()->put('usertype' , 1) ;
        return response()->json(array('usertype'=> 1 , 'code' => 1 ), 200);
        // return redirect('home') ;
    }else if(User::where('email' ,'=' , $data['email'] )->value('usertype') == 2){
        $req->session()->put('email' , $data['email']) ;
        // $req->session()->put('id' , $user_data->id) ;
        $req->session()->put('password' , $data['password']) ;
        $req->session()->put('usertype' , 2) ;
        return response()->json(array('usertype'=> 2 , 'code' => 1 ), 200);
        // return redirect('profile') ;
    }
}else{
    return response()->json(array('msg'=> 'Invalid email or password!' , 'code' => 0 ), 200);
}
       
    }
}
