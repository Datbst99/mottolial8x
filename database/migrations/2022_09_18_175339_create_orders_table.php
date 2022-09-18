<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();;
            $table->integer('total');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();;
            $table->unsignedBigInteger('product_id')->nullable();;
            $table->string('name');
            $table->integer('amount');
            $table->integer('price');
            $table->integer('total');
            $table->integer('point');
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->nullOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
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
        Schema::dropIfExists('invoices');
    }
}
