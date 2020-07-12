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
        $prices = [1000, 50,860,3000,45,22,75,580, 600,500,100,30];
        $sales = [2000, 55,890,3400,47,25,80,780, 900,550,140,40];
        $stock = [20,10,2,4,5,3,1,13,20,4,2,10];
        $barcode = 444564565;
        foreach ($products as $index=>$product) {
            \App\Product::create([
                'category_id' => 1,
                'ar' => ['name' => $product, 'description' => $product . ' desc'],
                'image' => 'default.png',
                'purchase_price' => $prices[$index],
                'sale_price' =>  $sales[$index],
                'stock' => $stock[$index],
                'collect_price' => 50,
            ]);
        } //end of foreach
    } // end of run
}//end of seeder
