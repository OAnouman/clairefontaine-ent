<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {


            $table->increments('id');

            $table->string('name',100)->unique();

            $table->string('academic_grade');

            $table->timestamps();


        });


        // Pivot table level_subject

        Schema::create('level_subject', function (Blueprint $table) {


            $table->integer('level_id');

            $table->integer('subject_id');

            $table->index(['level_id', 'subject_id']);

            $table->double('coefficient')->default(1.0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::dropIfExists('levels');

        Schema::dropIfExists('level_subject');


    }
}
