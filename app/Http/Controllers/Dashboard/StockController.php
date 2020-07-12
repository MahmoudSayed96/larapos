<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_stock')->only('index');
    }

    public function index() {
        $products = Product::latest()->get();
        // return $products;
        return view('dashboard.stock.index',compact('products'));
    }
}
