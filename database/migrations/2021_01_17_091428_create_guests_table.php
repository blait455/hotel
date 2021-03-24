<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id')->unsigned();
            $table->string('type');
            $table->string('name');
            $table->string('address');
            $table->string('profession');
            $table->string('email');
            $table->string('phone');
            $table->string('Veh_reg_no');
            $table->string('from');
            $table->string('to');
            $table->string('Purpose');
            $table->string('nights');
            $table->string('no_in_room');
            $table->string('nationality');
            $table->string('emergency_name');
            $table->string('emergency_phone');
            $table->string('status');
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
