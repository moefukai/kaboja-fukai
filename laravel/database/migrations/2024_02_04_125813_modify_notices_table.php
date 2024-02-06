<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('message'); // messageカラムの削除
            $table->string('address'); // 住所カラムの追加
            $table->string('menu'); // メニューカラムの追加
            $table->decimal('price', 8, 2); // 価格カラムの追加
            $table->time('start_time'); // 開始時間カラムの追加
            $table->time('end_time'); // 終了時間カラムの追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->text('message'); // messageカラムの再追加
            $table->dropColumn(['address', 'menu', 'price', 'start_time', 'end_time']); // 追加したカラムの削除
        });
    }
}
