<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->integer('order')->default(1);
            $table->string('short')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->boolean('publish')->defailt(1);
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
        Schema::dropIfExists('collections');
    }
}
