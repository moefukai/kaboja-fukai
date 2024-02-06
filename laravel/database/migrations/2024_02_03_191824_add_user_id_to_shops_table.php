<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToShopsTable extends Migration
{
    /**
     * マイグレーションを実行します。
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            // user_idカラムを追加します。符号なしのbigint型とします
            $table->unsignedBigInteger('user_id')->after('id');
            // 外部キー制約を追加します
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * マイグレーションをロールバックします。
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            // 外部キー制約を削除します
            $table->dropForeign(['user_id']);
            // user_idカラムを削除します
            $table->dropColumn('user_id');
        });
    }
}
