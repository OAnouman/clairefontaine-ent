<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolarships', function (Blueprint $table) {

            $table->increments('id');

            $table->timestamps();

            $table->decimal('price')->default(0.0);

            $table->decimal('registration_fees')->default(0.0);

            $table->integer('level_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('schoolarships');

    }
}
