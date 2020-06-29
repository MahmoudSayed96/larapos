<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class ReportController extends Controller
{
    /**
     * Sales report.
     */
    public function sales(Request $request) {
        $categories = Category::all();
        $orders = Order::with(['products'=>function($q)use($request){
            return $q->where('category_id',$request->category_id);
        }])->paginate(10);
        return view('dashboard.reports.sales',compact('categories','orders'));
    }
}
