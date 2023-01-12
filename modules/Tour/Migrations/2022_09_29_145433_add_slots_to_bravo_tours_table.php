<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlotsToBravoToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bravo_tours', function (Blueprint $table) {
            $table->integer('slots')->nullable(); //Số chỗ còn nhận
            $table->integer('number_of_days')->nullable(); //Số ngày hành trình
            $table->timestamp('departure_day')->nullable(); // Ngày khởi hành
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bravo_tours', function (Blueprint $table) {
            $table->dropColumn('slots');
            $table->dropColumn('number_of_days');
            $table->dropColumn('departure_day');
        });
    }
}
