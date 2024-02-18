<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id(); // 通知ID
            $table->unsignedBigInteger('shop_id'); // 店舗ID
            $table->string('address'); // 住所
            $table->dateTime('start_time'); // 開始時間
            $table->dateTime('end_time'); // 終了時間
            $table->timestamps(); // タイムスタンプ（created_at および updated_at）

            // 外部キーとして shop_id を設定
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
