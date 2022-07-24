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
        Schema::create('parking_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('check_in');
            $table->timestamp('check_out')->nullable();
            $table->boolean('posted')->default(0);
            $table->unsignedBigInteger('user_id')->nullable()->references('id')->on('users');
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
        Schema::dropIfExists('parking_transactions');
    }
};
