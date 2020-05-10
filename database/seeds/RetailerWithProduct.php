<?php

use Illuminate\Database\Seeder;

class RetailerWithProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $switch=\App\Product::create(['name'=>'Switch']);
        $bestBuy=\App\Retailer::create(['name'=>'Best buy']);

        $stock=new \App\Stock([
           'price'=>1000,
           'url'=>'http://best-buy',
            'sku'=>'12345',
            'in_stock'=>false
        ]);

        $bestBuy->addStock($switch,$stock);
    }
}
