<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $orders_count = Order::count();
        $products_count = Product::count();
        $categories_count = Category::count();
        $users_count = User::whereRoleIs('admin')->count();
        return view('dashboard.welcome', \compact('orders_count', 'products_count', 'categories_count', 'users_count'));
    }
}
