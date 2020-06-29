<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    protected $fillable = ['name', 'phone', 'address'];

    public function getNameAttribute($value)
    {
        return \ucfirst($value);
    } // end of get name

    public function orders()
    {
        return $this->hasMany(Order::class);
    } //end of orders

}
