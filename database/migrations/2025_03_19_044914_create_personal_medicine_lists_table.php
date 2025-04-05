<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalMedicineListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_medicine_lists', function (Blueprint $table) {
            $table->id();
            $table->date('medicine_date');
            $table->string('medicine_name');
            $table->string('medicine_age');
            $table->string('medicine_type');
            $table->text('medicine_remark');
            $table->text('medicine_result');
            $table->string('medicine_nameqty');
            $table->integer('medicine_qty');
            $table->string('medicine_group');
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
        Schema::dropIfExists('personal_medicine_lists');
    }
}
