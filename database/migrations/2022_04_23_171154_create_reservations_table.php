<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('ReservationDate');
            $table->unsignedBigInteger('Teacher_id');
            $table->unsignedBigInteger('Timing_id');
            $table->unsignedBigInteger('Room_id');
            $table->timestamps();
            $table->foreign('Teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('Timing_id')->references('id')->on('timings')->onDelete('cascade');
            $table->foreign('Room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
