<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instance')->default('shopping');
            $table->integer('customer_id')->nullable()->index();
            $table->integer('payment_id')->unsigned()->index();
            $table->float('total')->default(0);
            $table->boolean('paid')->default(0);
            $table->timestamps();
        });

        Schema::create('shopping_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned()->index();
            $table->string('code');
            $table->string('title');
            $table->integer('qty')->default(1);
            $table->float('price');
            $table->text('options')->nullable();
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
        Schema::dropIfExists('carts');
        Schema::dropIfExists('shopping_items');
    }
}
