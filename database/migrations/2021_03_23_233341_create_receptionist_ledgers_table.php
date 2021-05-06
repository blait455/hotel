<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionistLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptionist_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('room_id');
            $table->string('payment_method');
            $table->string('payment_type');
            $table->integer('discount')->nullable();
            $table->integer('discounted_amount')->nullable();
            $table->string('remarks');
            $table->string('balance')->nullable();
            $table->string('pop')->nullable();
            $table->string('rc')->nullable();
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
        Schema::dropIfExists('receptionist_ledgers');
    }
}
