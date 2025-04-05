<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataostrcDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataostrc_dts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dataostrc_id')->references('id')->on('dataostrc_hds')->onDelete('cascade');
            $table->string('sub_name');
            $table->integer('sub_qty');
            $table->string('sub_remark');
            $table->integer('sub_no');
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
        Schema::dropIfExists('dataostrc_dts');
    }
}
