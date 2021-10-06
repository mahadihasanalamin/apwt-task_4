@extends('Layouts.app')
@section('content')
    <h1>Hello,{{session('customer')->name}}<h1>
    <h1>Orders<h1>
        @if($orders)
    <table class='table table-bordered'>
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Action</th>
        @foreach($orders as $order)
            @if (session('customer')->c_id == $order->c_id)

                <tr>
                    <td>{{$order->p_id}}</td>
                    <td>{{$order->p_name}}</td>
                    <td>{{$order->price}}</td>
                    <td><a class ="btn btn-danger" href="/customers/delete/order/{{$order->id}}">Remove</a></td>
                </tr>
            @endif
        @endforeach
    </table>
    @else
    <h4>order list empty</h4>
    @endif
@endsection