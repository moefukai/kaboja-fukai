<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopIdToMenusTable extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            // shop_idカラムを追加
            $table->unsignedBigInteger('shop_id')->after('id');
            // 外部キー制約を設定
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['shop_id']);
            // shop_idカラムを削除
            $table->dropColumn('shop_id');
        });
    }
}
