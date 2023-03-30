<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Coffeeshop ;
use App\Http\Controllers\UserAuth ;
use App\Http\Controllers\MailController ;
use App\Http\Controllers\CustomerController ;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/verify_user_details' , [UserAuth::class,'verify_user_details']);

Route::get('/logout' , function(){
    if(session()->has('email')){
        session()->pull('email' , null);
        session()->pull('password' , null);
    }
    return redirect('/');
});
Route::get('/' , function(){
    if(session()->has('email')){
        if(session()->has('usertype') == 1)
        {
            return view('admin.home');
        }else if(session()->has('usertype') == 2){
            return view('customer.profile');
        }
        
    }
    return view('login');
    
});


Route::get('/profile',[CustomerController::class,'index']);
Route::get('/apply_refund',[CustomerController::class,'apply_refund']);
Route::get('/get_cart_data',[CustomerController::class,'get_cart_data']);
Route::get('/ordercoffee',[CustomerController::class,'ordercoffee']);
Route::post('/edit_profile',[CustomerController::class,'edit_profile']);
Route::post('/buy_coffee',[CustomerController::class,'buy_coffee']);
Route::post('/apply_for_refund',[CustomerController::class,'apply_for_refund']);
Route::get('/get_customer_data',[CustomerController::class,'get_customer_data']);
Route::get('/wallet',[CustomerController::class,'wallet']);
Route::get('/cart',[CustomerController::class,'cart']);




Route::get('/home',[Coffeeshop::class,'index']);
Route::get('/products',[Coffeeshop::class,'products']);
Route::get('/orders',[Coffeeshop::class,'orders']);
Route::get('/customers',[Coffeeshop::class,'customers']);
Route::get('/get_customers',[Coffeeshop::class,'get_customers']);

Route::post('/add_customer' , [Coffeeshop::class,'add_customer']);
Route::post('/edit_customer' , [Coffeeshop::class,'edit_customer']);
Route::post('/delete_customer' , [Coffeeshop::class,'delete_customer']);

Route::get('/get_products',[Coffeeshop::class,'get_products']);
Route::post('/add_products' , [Coffeeshop::class,'add_products']);
Route::post('/edit_products' , [Coffeeshop::class,'edit_products']);
Route::post('/delete_products' , [Coffeeshop::class,'delete_products']);

Route::get('/get_orders_data',[Coffeeshop::class,'get_orders_data']);
Route::post('/manage_orders' , [Coffeeshop::class,'manage_orders']);

Route::get('/send'  , [MailController::class,'index']  );
