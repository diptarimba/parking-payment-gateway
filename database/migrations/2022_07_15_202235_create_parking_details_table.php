<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_transaction_id')->references('id')->on('parking_transactions');
            $table->string('code');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('parking_location_id');
            // $table->string('payment_id')->nullable();
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
        Schema::dropIfExists('parking_details');
    }
};
