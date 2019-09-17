<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('slug')->nullable();
            $table->string('name');
            $table->float('price');
            $table->longText('description');
            $table->boolean('status')->default(0);
            $table->boolean('featured')->default(0);
            $table->string('meta_title', 70);
            $table->string('meta_keywords');
            $table->string('meta_description', 160);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
