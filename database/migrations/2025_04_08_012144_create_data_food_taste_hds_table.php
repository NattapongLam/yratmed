<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataFoodTasteHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_food_taste_hds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_id')->references('id')->on('personal_data_lists')->onDelete('cascade');
            $table->boolean('dietarycheck1');
            $table->string('dietaryremark1')->nullable();
            $table->boolean('dietarycheck2');
            $table->string('dietaryremark2')->nullable();
            $table->boolean('dietarycheck3');
            $table->string('dietaryremark3')->nullable();
            $table->string('remark')->nullable();
            $table->string('person_at');
            $table->boolean('flag');
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
        Schema::dropIfExists('data_food_taste_hds');
    }
}
