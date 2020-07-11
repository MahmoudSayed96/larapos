<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['name', 'description', 'image', 'purchase_price', 'sale_price','collect_price', 'sale_type', 'stock', 'category_id'];
    protected $guarded = [];
    protected $appends = ['image_path', 'profit_percent','profit'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute()
    {
        return asset('uploads/images/products/' . $this->image);
    } // end of get image path

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = ($profit * 100) / $this->purchase_price;
        return number_format($profit_percent, 2);
    } // end of get profit percent

    public function getProfitAttribute()
    {
        $profit = 0;
        if($this->sale_type == 'normal'){
            $profit = $this->sale_price - $this->purchase_price;
        }else{
            $profit = $this->collect_price - $this->purchase_price;
        }
        return number_format($profit, 2);
    } // end of get profit percent

    public function Orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    } //end of orders

    // Get product price by quantity
    public function getPriceByQuantity($qty){
        $price = 0;
        if($this->sale_type == 'normal'){
            $price = $this->sale_price * $qty;
        }else{
            $price = $this->collect_price * $qty;
        }
        return $price;
    }

    // Get product price
    public function getPrice(){
        if($this->sale_type == 'normal'){
            return $this->sale_price;
        }else{
            return $this->collect_price;
        }
    }

    // Get sale type.
    public function saleType(){
        if($this->sale_type == 'normal'){
            return __('site.normal_price');
        }else{
            return __('site.collect_price');;
        }
    }
}
