<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => rand(1,10),
        'ar' => ['name' => $faker->title(), 'description' => $faker->title()],
        'image' => 'default.png',
        'purchase_price' => 100,
        'sale_price' => 150,
        'stock' => rand(5,30),
    ];
});
