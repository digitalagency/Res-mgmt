<?php

use App\Models\Admin\Order;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', array(Order::PENDING, Order::COOKED, Order::COOKING))->default(Order::PENDING);
            $table->bigInteger('employee_id')->unsigned();
            $table->integer('table_id')->unsigned();
            // $table->integer('customer_id')->unsigned();
            $table->timestamps();

            // $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('employee_id')->references('id')->on('users');
            $table->foreign('table_id')->references('id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
