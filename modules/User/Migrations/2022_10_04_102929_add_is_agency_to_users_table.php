<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAgencyToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_agency')->default(0); // Là đại lý
            $table->string('agency_type')->nullable(); // Kiểu đại lý
            $table->string('file_agency')->nullable(); // File
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_agency');
            $table->dropColumn('agency_type');
            $table->dropColumn('file_agency');
        });
    }
}
