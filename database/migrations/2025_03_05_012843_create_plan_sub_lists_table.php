<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanSubListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_sub_lists', function (Blueprint $table) {
            $table->id();
            $table->date('sub_date');
            $table->text('sub_remark');        
            $table->string('plan_type')->nullable();   
            $table->string('plan_sub');   
            $table->string('person_at');
            $table->boolean('flag');
            $table->foreignId('plan_id')->references('id')->on('plan_data_lists')->onDelete('cascade');
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
        Schema::dropIfExists('plan_sub_lists');
    }
}
