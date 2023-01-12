<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepositToTourMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bravo_tour_meta', function (Blueprint $table) {
            $table->integer('enable_deposit')->default(1);
            $table->text('deposit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bravo_tour_meta', function (Blueprint $table) {
            $table->dropColumn('enable_deposit');
            $table->dropColumn('deposit');
        });
    }
}
