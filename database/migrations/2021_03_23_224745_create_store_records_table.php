<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_item_id');
            $table->integer('opening_stock');
            $table->integer('supplied');
            $table->integer('issued');
            $table->integer('closing_stock');
            $table->text('remark');
            $table->timestamps();

            $table->foreign('record_item_id')->references('id')->on('record_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_records');
    }
}
