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
            $table->integer('user_id')->unsigned()->index();
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('collection_id')->unsigned()->nullable()->index();
            $table->integer('set_id')->unsigned();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('short')->nullable();
            $table->text('body')->nullable();
            $table->text('body2')->nullable();
            $table->string('code');
            $table->string('image')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_outlet')->nullable();
            $table->integer('views')->default(0);
            $table->integer('amount')->default(0);
            $table->string('color')->nullable();
            $table->string('water')->nullable();
            $table->string('diameter')->nullable();
            $table->boolean('discount')->default(0);
            $table->integer('sold')->default(0);
            $table->boolean('publish')->default(1);
            $table->timestamp('publish_at')->usCurrent();
            $table->timestamps();
        });

        Schema::create('attribute_product', function (Blueprint $table) {
            $table->integer('attribute_id')->unsigned()->index();
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('attribute_product');
        Schema::dropIfExists('category_product');
    }
}
