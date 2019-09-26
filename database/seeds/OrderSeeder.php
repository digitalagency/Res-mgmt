<?php

use App\Models\Admin\Order;
use App\Models\Admin\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Order::truncate();
        DB::table('product_order')->truncate();

        $ordersNumber = 100;

        factory(Order::class, $ordersNumber)->create()->each(
            function($order){
                $products = Product::all()->random(mt_rand(1,2))->pluck('id');
                $order->products()->attach($products, ['quantity' => mt_rand(1,5)]);
            }
        );
    }
}
