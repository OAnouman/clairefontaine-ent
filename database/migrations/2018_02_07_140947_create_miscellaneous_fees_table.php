<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiscellaneousFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miscellaneous_fees', function (Blueprint $table) {


            $table->increments('id');

            $table->timestamps();

            $table->decimal('canteen_fees')->default(0.0);

            $table->decimal('canteen_subscription_fee')->default(0.0);

            $table->decimal('transportation_fees')->default(0.0);

            $table->decimal('transportation_subscription_fee')->default(0.0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('miscellaneous_fees');
    }
}
