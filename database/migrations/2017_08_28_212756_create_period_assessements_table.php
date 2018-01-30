<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodAssessementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('period_assessements', function (Blueprint $table) {


            $table->increments('id');

            $table->text('body');

            $table->integer('student_id');

            $table->integer('school_year_period_id');

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
        Schema::dropIfExists('period_assessements');
    }
}
