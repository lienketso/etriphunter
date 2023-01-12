<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_request', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->default(0);
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('office')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('hotel')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('persion')->nullable();
            $table->integer('total_guest')->default(0);
            $table->text('description')->nullable();
            $table->double('price')->default('0');
            $table->double('commission')->default(0);
            $table->string('commission_type')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_request');
    }
}
