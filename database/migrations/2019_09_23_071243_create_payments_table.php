<?php

use App\Models\Admin\Payment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->unique();
            // $table->integer('customer_id')->unsigned();
            $table->decimal('net_price', 6, 2);
            $table->decimal('vat', 6, 2);
            $table->decimal('gross_price', 6, 2);
            $table->boolean('payment_status')->default(Payment::UNPAID);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
