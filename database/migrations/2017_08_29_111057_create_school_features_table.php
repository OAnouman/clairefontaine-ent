<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // TODO : Implement this in student form

        Schema::create('school_features', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('student_id');

            $table->integer('school_year_id');

            $table->boolean('registered_canteen');

            $table->boolean('registered_transportation');

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
        Schema::dropIfExists('school_features');
    }
}
