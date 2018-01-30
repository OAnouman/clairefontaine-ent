<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('students', function (Blueprint $table) {



            $table->increments('id');

            $table->string('reg_number',180)->unique();

            $table->string('firstname');

            $table->string('lastname');

            $table->date('birth_date');

            $table->string('birth_place');

            $table->text('nationalities');

            $table->string('origin_school')->nullable();

            $table->string('father_name')->nullable();

            $table->string('father_job')->nullable();

            $table->string('father_phones')->nullable();

            $table->string('mother_name')->nullable();

            $table->string('mother_job')->nullable();

            $table->string('mother_phones')->nullable();

            $table->string('living_place')->nullable();

            $table->text('address')->nullable();

            $table->text('emails')->nullable();

            $table->string('resp_schooling');

            $table->string('guardian_name')->nullable();

            $table->string('guardian_phones')->nullable();

            $table->text('picture')->nullable();

            $table->string('sex');

            $table->date('subscription_date');

            $table->boolean('is_removed')->default(false);

            $table->string('cned_id')->nullable();

            $table->string('cned_password')->nullable();

            $table->string('second_living_language')->nullable();

            $table->boolean('gave_id_picture')->default(false);

            $table->boolean('gave_birth_act')->default(false);

            $table->boolean('gave_vaccination_notebook')->default(false);

            $table->boolean('gave_gradebook')->default(false);

            $table->boolean('gave_cancellation_certificate')->default(false);

            $table->boolean('is_image_right_allowed')->default(false);

            $table->boolean('is_special_program')->default(false);

            $table->string('username', 180 )->unique();

            $table->timestamps();


        });


        DB::statement('ALTER TABLE students ADD FULLTEXT search(lastname, firstname, reg_number, nationalities, sex)');


    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::dropIfExists('students');


    }
}
