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
        $stats = $this->salesStatistics($request);
        return view('dashboard.reports.sales',compact('categories','orders','stats'));
    }

    /**
     * Calculate purchase price.
     */
    private function salesStatistics($request){
        $stats = [];
        $total_profit  = 0;
        $total_purchases = 0;
        $total_sales = 0;
        $orders = Order::with(['products'=>function($q)use($request){
            return $q->where('category_id',$request->category_id);
        }])->get();
        foreach($orders as $order){
            foreach($order->products as $product){
                $total_purchases += ($product->purchase_price  * $product->pivot->quantity);
                $total_sales += $product->getPriceByQuantity($product->pivot->quantity);
                $total_profit += ($product->profit  * $product->pivot->quantity);
            }
        }
        $stats = [
            'total_profit' => $total_profit,
            'total_purchases' => $total_purchases,
            'total_sales' => $total_sales
        ];
        return $stats;
    }
}
