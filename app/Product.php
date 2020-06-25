<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['name', 'description', 'image', 'purchase_price', 'sale_price', 'stock', 'category_id'];
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
        $profit = $this->sale_price - $this->purchase_price;
        return number_format($profit, 2);
    } // end of get profit percent

    public function Orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    } //end of orders
}
