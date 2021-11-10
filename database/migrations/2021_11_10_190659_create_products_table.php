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
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('brand_id')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('product_quantity');
            $table->text('product_details');
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('video_link')->nullable();
            $table->integer('main_slider')->nullable()->default(0);
            $table->integer('mid_slider')->nullable()->default(0);
            $table->integer('hot_deal')->nullable()->default(0);
            $table->integer('hot_new')->nullable()->default(0);
            $table->integer('best_rated')->nullable()->default(0);
            $table->integer('trend')->nullable()->default(0);
            $table->integer('status')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
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
