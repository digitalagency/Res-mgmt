<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Order;
use App\Models\Admin\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker)  {
    return [
        'order_id' => $faker->unique()->numberBetween(1,100),
        'net_price' => $faker->numberBetween(10, 100),
        'gross_price' => $faker->numberBetween(10, 100),
        'vat' => $faker->numberBetween(1,50),
        'payment_status' => $faker->randomElement([0,1])
    ];
});
