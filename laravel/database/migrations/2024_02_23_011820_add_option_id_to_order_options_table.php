<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionIdToOrderOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_options', function (Blueprint $table) {
            // option_id カラムを追加
            $table->unsignedBigInteger('option_id')->nullable();
            // options テーブルの id カラムへの外部キー制約を追加
            $table->foreign('option_id')->references('id')->on('options');
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
            // 外部キー制約を削除
            $table->dropForeign(['option_id']);
            // option_id カラムを削除
            $table->dropColumn('option_id');
        });
    }
}
