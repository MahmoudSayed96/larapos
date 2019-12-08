<?php

namespace App\Http\Controllers\Dashboard;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_orders')->only('create');
        $this->middleware('permission:read_orders')->only('index');
        $this->middleware('permission:update_orders')->only('edit');
        $this->middleware('permission:delete_orders')->only('destroy');
    } //end of constructor

    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        })->paginate(10);
        return view('dashboard.orders.index', \compact('orders'));
    } //end of index

    // get order products
    public function products(Order $order)
    {
        $products = $order->products()->paginate(10);
        return view('dashboard.orders._products', \compact('order', 'products'));
    } //end of products

    // delete order
    public function destroy(Order $order)
    {
        // return quantity to stock
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
        session()->flash('success', \Lang::get('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    } //end of destroy
}//end of controller
