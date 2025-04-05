<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalLapListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_lap_lists', function (Blueprint $table) {
            $table->id();
            $table->string('personal_name');
            $table->string('personal_age')->nullable(); 
            $table->decimal('bh',18,2)->default(0);   
            $table->decimal('bw',18,2)->default(0);   
            $table->decimal('bmi',18,2)->default(0);     
            $table->decimal('rbc',18,2)->default(0);  
            $table->decimal('hb',18,2)->default(0);
            $table->decimal('hct',18,2)->default(0);
            $table->decimal('mvc',18,2)->default(0);
            $table->decimal('mch',18,2)->default(0);
            $table->decimal('mchc',18,2)->default(0);
            $table->decimal('rdw',18,2)->default(0);
            $table->decimal('wbc',18,2)->default(0);
            $table->decimal('plt',18,2)->default(0);
            $table->decimal('ferritin',18,2)->default(0);
            $table->decimal('cpk',18,2)->default(0);
            $table->decimal('bloodsugar',18,2)->default(0);
            $table->decimal('bun',18,2)->default(0);
            $table->decimal('cr',18,2)->default(0);
            $table->decimal('gf',18,2)->default(0);
            $table->decimal('ast',18,2)->default(0);
            $table->decimal('alt',18,2)->default(0);
            $table->decimal('alp',18,2)->default(0);
            $table->decimal('albumin',18,2)->default(0);
            $table->decimal('sp',20,4)->default(0);
            $table->decimal('ph',18,2)->default(0);
            $table->string('prot')->nullable(); 
            $table->string('glucose')->nullable();
            $table->string('ketone')->nullable();
            $table->string('wb')->nullable();
            $table->string('rb')->nullable();
            $table->string('epith')->nullable();
            $table->string('bac')->nullable();
            $table->string('mucous')->nullable();
            $table->boolean('flag');
            $table->string('person_at');
            $table->foreignId('personal_id')->references('id')->on('personal_data_lists')->onDelete('cascade');
            $table->bigInteger('lap_id');
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('personal_lap_lists');
    }
}
