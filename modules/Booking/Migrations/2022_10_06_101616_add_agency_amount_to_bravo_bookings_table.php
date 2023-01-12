<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgencyAmountToBravoBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bravo_bookings', function (Blueprint $table) {
            $table->double('agency_amount')->default(0); //tiền hoa hồng cho đại lý
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bravo_bookings', function (Blueprint $table) {
            $table->dropColumn('agency_amount');
        });
    }
}
