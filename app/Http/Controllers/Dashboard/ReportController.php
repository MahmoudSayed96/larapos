<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class ReportController extends Controller
{
    /**
     * Sales report.
     */
    public function sales() {
        $orders = Order::with('products')->paginate(10);
        return view('dashboard.reports.sales',compact('orders'));
    }
}
