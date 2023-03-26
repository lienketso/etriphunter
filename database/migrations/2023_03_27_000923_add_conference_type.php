<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConferenceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_request', function (Blueprint $table) {
            if (!Schema::hasColumn('booking_request', 'conference_type')) {
                $table->tinyInteger('conference_type')->nullable()->default(1);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_request', function (Blueprint $table) {
            $table->dropColumn('conference_type');
        });
    }
}
