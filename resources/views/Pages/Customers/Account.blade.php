@extends('Layouts.app')
@section('content')
    <h1>Hello,{{session('customer')->name}}<h1>
    <table class='table table-bordered'>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Description</th>
        <th>Action</th>
        @foreach($products as $product)
            <tr>
                <td>{{$product->p_id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->description}}</td>
                <td><a class ="btn btn-success" href="/customers/product/cart/{{$product->p_id}}">Add to cart</a></td>
            </tr>
        @endforeach
    </table>
@endsection