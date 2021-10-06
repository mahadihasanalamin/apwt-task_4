<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Products;
use App\Models\Orders;

class CustomersController extends Controller
{
    public function login()
    {
        return view('Pages.Customers.Login');
    }

    Public function loginAction(Request $request)
    {
        $this->validate(
            $request,
            [
                'phone'=>'required|min:11|max:15|regex:/^[(0-9)\+\-]+$/'
            ]
        );

        $customer = Customers::where('phone',$request->phone)->first();
        if($customer){
            $request->session()->put('customer',$customer);
            return redirect()->route('customers/account');
        }
        else{
            return back()->with('fail','phone number does not exist');
        }
    }

    public function account(Request $request)
    {
        $products = Products::All();
        if(session()->has('customer')){
            return view('Pages.Customers.Account')->with('products',$products);
        }
        else{
            return redirect()->route('customers/login');
        }
    }

    public function logout(Request $request)
    {
        if(session()->has('customer'))
        {
            session()->pull('customer');
        }
        return redirect()->route('customers/login');
    }

    public function cartAction(Request $request)
    {
        if (session()->has('cart'))
        {
            $list = json_decode(session('cart'));
            $product = Products::where('p_id',$request->p_id)->first();
            $products = array("cid"=>session('customer')->c_id,
                              "cname"=>session('customer')->name,
                              "phone"=>session('customer')->phone,
                              "pid"=>$product->p_id,
                              "pname"=>$product->name,
                              "price"=>$product->price);
            $list[] = (object)$products;
            $cart = json_encode($list);
            $request->session()->put('cart',$cart);
        }
        else
        {
            $list = array();
            $product = Products::where('p_id',$request->p_id)->first();
            $products = array("cid"=>session('customer')->c_id,
                              "cname"=>session('customer')->name,
                              "phone"=>session('customer')->phone,
                              "pid"=>$product->p_id,
                              "pname"=>$product->name,
                              "price"=>$product->price);
            $list[] = (object)$products;
            $cart = json_encode($list);
            $request->session()->put('cart',$cart);
        }
        return redirect()->route('customers/account');
    }

    public function cart()
    {
        return view('Pages.Customers.Cart');
    }

    public function checkout()
    {
        if(session()->has('cart')){
            foreach(json_decode(session('cart')) as $cart){
                if (session('customer')->c_id == $cart->cid)
                {
                    $var = new Orders;
                    $var->c_id = $cart->cid;
                    $var->c_name = $cart->cname;
                    $var->phone = $cart->phone;
                    $var->p_id = $cart->pid;
                    $var->p_name = $cart->pname;
                    $var->price = $cart->price;
                    $var->save();
                }
            }
        }

        session()->pull('cart');
        $orders = Orders::All();
        return view('Pages.Customers.Orders')->with('orders',$orders);
    }

    public function delete(Request $request)
    {
        Orders::where('id',$request->id)->delete();
        return redirect()->route('customers/product/orders');

    }
}
