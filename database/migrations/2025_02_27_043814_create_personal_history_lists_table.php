<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalHistoryListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_history_lists', function (Blueprint $table) {
            $table->id();
            $table->text('serious_lllness')->nullable();
            $table->text('serious_lnjury')->nullable();
            $table->text('previous_surgery')->nullable();
            $table->boolean('flag');
            $table->string('person_at');
            $table->foreignId('personal_id')->references('id')->on('personal_data_lists')->onDelete('cascade');
            $table->date('history_date');
            $table->bigInteger('status_id');
            $table->string('temperature')->nullable();
            $table->string('pulse')->nullable();
            $table->string('breathe')->nullable();
            $table->string('pressure')->nullable();
            $table->string('mercury')->nullable();
            $table->string('pain')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->string('nature')->nullable();
            $table->string('severity')->nullable();
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
        Schema::dropIfExists('personal_history_lists');
    }
}
