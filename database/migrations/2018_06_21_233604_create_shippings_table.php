<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('desc')->nullable();
            $table->integer('order')->default(1);
            $table->boolean('publish')->default(1);
            $table->timestamps();
        });

        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->integer('shipping_id')->after('coupon_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');

        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->dropColumn('shipping_id');
        });
    }
}
