<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataFoodTasteDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_food_taste_dts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foodtaste_id')->references('id')->on('data_food_taste_hds')->onDelete('cascade');
            $table->integer('foodtaste_no');
            $table->string('foodtaste_name');
            $table->integer('foodtaste_qty')->nullable();
            $table->string('foodtaste_remark')->nullable();
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
        Schema::dropIfExists('data_food_taste_dts');
    }
}
