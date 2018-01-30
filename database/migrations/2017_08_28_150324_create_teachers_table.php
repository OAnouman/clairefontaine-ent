<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('teachers', function (Blueprint $table) {

            $table->increments('id');

            $table->string('lastname');

            $table->string('firstname');

            $table->date('birth_date')->nullable();

            $table->string('email', 180);

            $table->text('adress')->nullable();

            $table->string('mobile')->nullable();

            $table->text('other_phoone')->nullable();

            $table->date('hire_date')->nullable();

            $table->date('leaving_date')->nullable();

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
        Schema::dropIfExists('teachers');
    }
}
