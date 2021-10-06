@extends('Layouts.app')
@section('content')
    <h1>Hello,{{session('customer')->name}}<h1>
    <h1>Cart<h1>
    @if (session('cart'))
    <table class='table table-bordered'>
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        @foreach(json_decode(session('cart')) as $product)
            @if (session('customer')->c_id == $product->cid)
                <tr>
                    <td>{{$product->pid}}</td>
                    <td>{{$product->pname}}</td>
                    <td>{{$product->price}}</td>
                </tr>
            @endif
        @endforeach
    </table>
    <a class ="btn btn-success" href="/customers/product/orders">Checkout</a>
    @else
        <h4>Your cart is empty</h4>
    @endif
@endsection