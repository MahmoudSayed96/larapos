<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $fillable = ['client_id', 'total_price','is_printed'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    } //end of client

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity');
    } //end of products
}
