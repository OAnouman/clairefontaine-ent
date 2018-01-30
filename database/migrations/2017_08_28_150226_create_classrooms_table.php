<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('classrooms', function (Blueprint $table) {


            $table->increments('id');

            $table->integer('level_id');

            $table->string('name');

            $table->integer('school_year_id');

            $table->integer('teacher_id');

            $table->timestamps();


        });


        //Pivot table classroom_teacher

        Schema::create('classroom_teacher', function (Blueprint $table) {


            $table->integer('classroom_id');

            $table->integer('teacher_id');

            $table->integer('subject_id');

            $table->primary(['classroom_id', 'teacher_id', 'subject_id']);


        });



        //Pivot table classroom_student

        Schema::create('classroom_student', function (Blueprint $table) {


            $table->integer('classroom_id');

            $table->integer('student_id');

            $table->primary(['classroom_id', 'student_id']);

            $table->boolean('redouble');

            $table->integer('school_year_id');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('classrooms');

        Schema::dropIfExists('classroom_teacher');

        Schema::dropIfExists('classroom_student');


    }
}
