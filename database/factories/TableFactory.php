<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Table;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'table_no' => $faker->regexify('^[A-Z][0-9]{2}$'),
        'capacity' => $faker->numberBetween(2,10),
        'status' => $faker->randomElement([0,1]),
    ];
});
