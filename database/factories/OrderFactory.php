<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Order;
use App\Models\Admin\Table;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(['pending', 'cooked', 'cooking']),
        'employee_id' => User::all()->random(),
        'table_id' => Table::all()->random()->id,
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
