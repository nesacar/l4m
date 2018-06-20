<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToShopbarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_bars', function (Blueprint $table) {
            $table->integer('parent_category_id')->after('id')->default(0);
            $table->boolean('latest')->after('order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_bars', function (Blueprint $table) {
            $table->dropColumn('parent_category_id');
            $table->dropColumn('latest');
        });
    }
}
