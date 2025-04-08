<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPhysicalListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_physical_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_id')->references('id')->on('personal_data_lists')->onDelete('cascade');
            $table->string('person_at');
            $table->boolean('flag');
            $table->date('physical_date');
            $table->text('physical_diagnosis')->nullable();
            $table->text('physical_treatment')->nullable();
            $table->text('physical_results')->nullable();
            $table->text('physical_remark')->nullable();
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
        Schema::dropIfExists('data_physical_lists');
    }
}
