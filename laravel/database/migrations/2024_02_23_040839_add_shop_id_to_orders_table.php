<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // shop_id カラムを追加
            $table->unsignedBigInteger('shop_id')->after('id')->nullable();
            // 外部キー制約を設定
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['shop_id']);
            // shop_id カラムを削除
            $table->dropColumn('shop_id');
        });
    }
}
