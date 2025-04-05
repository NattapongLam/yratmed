<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDataListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_data_lists', function (Blueprint $table) {
            $table->id();
            $table->string('personal_name');
            $table->string('personal_sex');
            $table->string('personal_type')->nullable();
            $table->string('personal_sub')->nullable();
            $table->date('personal_birthday');
            $table->string('personal_age')->nullable();
            $table->string('personal_underlying')->nullable();
            $table->text('personal_currentmed')->nullable();
            $table->string('personal_allergy')->nullable();
            $table->text('serious_lllness')->nullable();
            $table->text('serious_lnjury')->nullable();
            $table->text('previous_surgery')->nullable();
            $table->string('personal_img')->nullable();
            $table->boolean('personal_flag');
            $table->string('person_at');
            $table->string('personal_tel')->nullable();
            $table->string('personal_address')->nullable();
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
        Schema::dropIfExists('personal_data_lists');
    }
}
