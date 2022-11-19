<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('thumbnail');
            $table->text('description')->nullable();
            $table->tinyInteger('status');
            $table->unsignedBigInteger('create_by')->nullable();
            $table->timestamps();
            $table->index('status');

            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
        });

        Schema::create('product_classifies', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('name')->nullable();
            $table->integer('price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('amount')->nullable();
            $table->string('thumbnail')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->index('status');

            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_classifies');
        Schema::dropIfExists('products');
    }
}
