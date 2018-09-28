<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first', 25);
            $table->string('last', 25);
            $table->string('phone', 14);
            $table->string('email', 50);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users'); 
            $table->string('tattoo_size', 65);
            $table->string('description');
            $table->string('location', 65);
            $table->string('color_preference', 25);
            $table->string('tattoo_style', 45);
            $table->string('budget', 25);  
            $table->dateTime('date_booked')->nullable();
            $table->date('date')->nullable();
            $table->string('time', 8)->nullable();
            $table->softDeletes();         
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
        Schema::dropIfExists('bookings');
    }
}
