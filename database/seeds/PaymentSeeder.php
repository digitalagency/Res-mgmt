<?php

use App\Models\Admin\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Payment::truncate();
        $paymentsNumber = 100;
        factory(Payment::class, $paymentsNumber)->create();
    }
}
