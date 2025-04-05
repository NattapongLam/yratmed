<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalJointsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_joints_lists', function (Blueprint $table) {
            $table->id();
            $table->string('joint_name');
            $table->text('remark')->nullable();
            $table->integer('score');
            $table->boolean('flag');
            $table->string('person_at');
            $table->foreignId('personal_id')->references('id')->on('personal_data_lists')->onDelete('cascade');
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
        Schema::dropIfExists('personal_joints_lists');
    }
}
