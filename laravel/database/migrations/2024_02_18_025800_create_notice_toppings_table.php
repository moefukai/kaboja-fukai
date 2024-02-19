<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_toppings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notice_menu_id');
            $table->unsignedBigInteger('topping_id');
            $table->timestamps();

            $table->foreign('notice_menu_id')->references('id')->on('notice_menus')->onDelete('cascade');
            $table->foreign('topping_id')->references('id')->on('toppings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_toppings');
    }
}
