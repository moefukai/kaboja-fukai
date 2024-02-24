<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveToppingIdFromOrderOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_options', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['topping_id']);
            // カラムを削除
            $table->dropColumn('topping_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_options', function (Blueprint $table) {
            // カラムを追加
            $table->unsignedBigInteger('topping_id')->nullable();
            // 外部キー制約を再設定
            $table->foreign('topping_id')->references('id')->on('toppings');
        });
    }
}
