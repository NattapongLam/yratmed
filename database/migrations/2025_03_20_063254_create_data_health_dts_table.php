<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataHealthDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_health_dts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_id')->references('id')->on('data_health_hds')->onDelete('cascade');
            $table->integer('sub_no');
            $table->string('sub_name');
            $table->integer('sub_qty');
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
        Schema::dropIfExists('data_health_dts');
    }
}
