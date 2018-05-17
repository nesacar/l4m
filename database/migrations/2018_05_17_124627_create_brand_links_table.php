<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->index();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->integer('order')->default(1);
            $table->boolean('publish')->default(1);
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
        Schema::dropIfExists('brand_links');
    }
}
