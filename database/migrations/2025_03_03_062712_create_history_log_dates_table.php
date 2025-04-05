<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryLogDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_log_dates', function (Blueprint $table) {
            $table->id();
            $table->text('remark')->nullable();
            $table->boolean('flag');
            $table->string('person_at');
            $table->foreignId('history_id')->references('id')->on('personal_history_lists')->onDelete('cascade');
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
        Schema::dropIfExists('history_log_dates');
    }
}
