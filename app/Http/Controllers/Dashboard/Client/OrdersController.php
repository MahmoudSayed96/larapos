<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_orders')->only('create');
        $this->middleware('permission:update_orders')->only('edit');
    }

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->paginate(10);
        return view('dashboard.clients.orders.create', \compact('client', 'orders', 'categories'));
    } //end of create

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);
        // Create new order for client
        $order = $client->orders()->create([]);
        $total_price = 0;
        // add products and quantities to order
        foreach ($request->products as $id => $quantity) {
            // find product
            $product = Product::findOrFail($id);
            $quantities = $quantity['quantity'];
            // Calculate products total price
            $total_price += $product->sale_price *  $quantities;
            // add products and there quantities to order
            $order->products()->attach($id, ['quantity' =>  $quantities]);
            // update product stock
            $product->update(['stock' => $product->stock -  $quantities]);
        } //end of foreach
        // update total price
        $order->update(['total_price' => $total_price]);

        session()->flash('success', \Lang::get('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');
    } //end of store

    public function edit(Client $client, Order $order)
    {
        $categories = Category::all();
        $orders = $client->orders()->paginate(10);
        return view('dashboard.clients.orders.edit', \compact('categories', 'orders', 'client', 'order'));
    } //end of edit

    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);
        // remove old order
        $this->detach_order($order);
        // create new order
        $this->attach_order($request, $client);

        session()->flash('success', \Lang::get('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');
    } //end of update

    private function attach_order($request, $client)
    {
        // Create new order for client
        $order = $client->orders()->create([]);
        $total_price = 0;
        // add products and quantities to order
        foreach ($request->products as $id => $quantity) {
            // find product
            $product = Product::findOrFail($id);
            $quantities = $quantity['quantity'];
            // Calculate products total price
            $total_price += $product->sale_price *  $quantities;
            // add products and there quantities to order
            $order->products()->attach($id, ['quantity' =>  $quantities]);
            // update product stock
            $product->update(['stock' => $product->stock -  $quantities]);
        } //end of foreach
        // update total price
        $order->update(['total_price' => $total_price]);
    } //end of attach order

    private function detach_order($order)
    {
        // return quantity to stock
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    } // end of detach order

}
