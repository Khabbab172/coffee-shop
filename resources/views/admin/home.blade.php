@extends('admin.layouts')
@section('content')

<style>
    .mt-custom{
        margin-top: 3vh;
    }
</style>
<div class="container mt-custom">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body bg-mango">
                    <h2>Customers</h2>
                    <h4>{{\App\models\User::where('usertype' , '!='  , 1)->count()}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body bg-steller">
                    <h2>Products</h2>
                    <h4>{{\App\models\Product::all()->count()}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body bg-lush">
                    <h2>Orders</h2>
                    <h4>{{\App\models\Cart::all()->count()}}</h4>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection