<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {


        Schema::create('evalutaions', function (Blueprint $table) {

            $table->increments('id');

            $table->date('evaluation_date');

            $table->text('comment')->nullable();

            $table->integer('classroom_id');

            $table->integer('school_year_period_id');

            $table->integer('subject_id');

            $table->double('coefficient')->default( 1.0 );;

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


        Schema::dropIfExists('evaluations');


    }

}
