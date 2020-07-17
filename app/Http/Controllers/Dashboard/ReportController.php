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
        $orders = $this->search_operation($request);
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
        $orders = $this->search_operation($request);

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

    private function search_operation(Request $request){
        $orders = [];
        // check month and year.
        if(isset($request->month) && isset($request->year)) {
            if(!isset($request->category_id)) {
                $orders = Order::with('products')
                    ->whereRaw('MONTH(created_at) = ' . $request->month)
                    ->WhereRaw('YEAR(created_at) = ' . $request->year)
                    ->orderBy('created_at','desc')->paginate(10);
            } else {
                $orders = Order::with(['products'=>function($q)use($request){
                    return $q->where('category_id',$request->category_id);
                }])
                ->whereRaw('MONTH(created_at) = ' . $request->month)
                ->WhereRaw('YEAR(created_at) = ' . $request->year)
                ->orderBy('created_at','desc')->paginate(10);
            }
        }elseif(isset($request->year) && !isset($request->month)){
            if(!isset($request->category_id)) {
                $orders = Order::with('products')
                    ->WhereRaw('YEAR(created_at) = ' . $request->year)
                    ->orderBy('created_at','desc')->paginate(10);
            } else {
                $orders = Order::with(['products'=>function($q)use($request){
                    return $q->where('category_id',$request->category_id);
                }])
                ->WhereRaw('YEAR(created_at) = ' . $request->year)
                ->orderBy('created_at','desc')->paginate(10);
            }
        }else{
            if(!isset($request->category_id)) {
                $orders = Order::with('products')->orderBy('created_at','desc')->paginate(10);
            } else {
                $orders = Order::with(['products'=>function($q)use($request){
                    return $q->where('category_id',$request->category_id);
                }])->orderBy('created_at','desc')->paginate(10);
            }
        }
        return $orders;
    }
}
