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
        Schema::create('parking_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location_code')->unique();
            $table->longText('description')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('image');
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
        Schema::dropIfExists('parking_locations');
    }
};
