<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateGradesTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create( 'grades', function ( Blueprint $table )
        {


            $table->increments( 'id' );

            $table->double( 'value' )

                  ->default( 0.00 );

            $table->text( 'teacher_assessment' );

            $table->integer( 'student_id' );

            $table->integer('evaluation_id');

            $table->timestamps();


        } );


    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::dropIfExists( 'grades' );
    }
}
