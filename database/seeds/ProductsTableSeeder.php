<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $products = factory(App\Product::class,200)->create();
        $products = ['product 1', 'product 2','product 3','product 4','product 5','product 6','product 7', 'product 8','product 9','product 10','product 11','product 12'];
        $prices = [1000, 50,860,3000,45,22,75,580, 600];
        $sales = [2000, 55,890,3400,47,25,80,780, 900];
        $stock = [20,10,2,4,5];

        foreach ($products as $product) {
            \App\Product::create([
                'category_id' => 1,
                'ar' => ['name' => $product, 'description' => $product . ' desc'],
                'image' => 'default.png',
                'purchase_price' => $prices[rand(0,count($prices)-1)],
                'sale_price' =>  $sales[rand(0,count($sales)-1)],
                'stock' => $stock[rand(0,count($stock)-1)],
            ]);
        } //end of foreach
    } // end of run
}//end of seeder
