<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {


        Schema::create('medical_sheets', function (Blueprint $table) {

            $table->increments('id');

            $table->string('blood_type');

            $table->text('pharmaco_allergies');

            $table->text('food_allergies');

            $table->text('other_allergies');

            $table->boolean('varicella');

            $table->string('year_varicella',4);

            $table->boolean('rougeole');

            $table->string('year_rougeole', 4);

            $table->boolean('rubeole');

            $table->string('year_rubeole', 4);

            $table->boolean('meningite');

            $table->string('year_meningite', 4);

            $table->boolean('coqueluche');

            $table->string('year_coqueluche', 4);

            $table->boolean('oreillon');

            $table->string('year_oreillon', 4);

            $table->boolean('hepatite_abc');

            $table->string('year_hepatite_abc', 4);

            $table->boolean('asthme');

            $table->string('year_asthme', 4);

            $table->boolean('tetanie');

            $table->string('year_tetanie', 4);

            $table->boolean('polio');

            $table->string('year_polio', 4);

            $table->boolean('convulsion');

            $table->string('year_convulsion', 4);

            $table->boolean('drepanocytose');

            $table->boolean('epilepsie');

            $table->string('year_epilepsie', 4);

            $table->boolean('saignement_nez');

            $table->boolean('beguaiment');

            $table->boolean('dyslexie');

            $table->boolean('suivi_orthopedique');

            $table->boolean('suivi_psycho');

            $table->boolean('deficience_auditive');

            $table->string('defaut_vision');

            $table->boolean('port_lunette');

            $table->boolean('handicap');

            $table->text('autres_problemes');

            $table->integer('student_id');





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

        Schema::dropIfExists('medical_sheets');

    }


}
