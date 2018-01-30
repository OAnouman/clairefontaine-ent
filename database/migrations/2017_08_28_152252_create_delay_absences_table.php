<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelayAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('delay_absences', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('student_id');

            $table->string('from');

            $table->string('to');

            $table->date('date');

            $table->boolean('send_sms');

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
        Schema::dropIfExists('delay_absences');
    }
}
