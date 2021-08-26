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
            $table->string('product_name');
            $table->text('description');
            $table->string('brand');
            $table->integer('price');
            $table->integer('quantity');
            $table->string('product_code')->unique()->nullable();
            $table->text('barcode')->nullable();
            $table->string('product_img',255);
            $table->integer('alert_stock')->default('100');
            $table->string('product_slug',175)->nullable();
            $table->integer('product_status')->default('1');
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
