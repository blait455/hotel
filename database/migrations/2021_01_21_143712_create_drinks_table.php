<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('drink_category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('image');
            $table->string('price');
            $table->text('description');
            $table->boolean('status')->default('1');
            $table->timestamps();

            $table->foreign('drink_category_id')->references('id')->on('drink_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drinks');
    }
}
