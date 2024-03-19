<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_room', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('topic');
            $table->integer('amount');
            $table->time('time');
            $table->unsignedBigInteger('id_emp');
            $table->unsignedBigInteger('id_room');
            $table->string('status');

            $table->foreign('id_emp')->references('id')->on('employee');
            $table->foreign('id_room')->references('id')->on('meeting_room');
        });

        Schema::create('booking_roomfail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_booking');
            $table->date('date');
            $table->string('topic');
            $table->integer('amount');
            $table->time('time');
            $table->unsignedBigInteger('id_emp');
            $table->unsignedBigInteger('id_room');
            $table->string('status');
            $table->longText('note');

            $table->foreign('id_booking')->references('id')->on('booking_room');
            $table->foreign('id_room')->references('id')->on('meeting_room');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_room');
        Schema::dropIfExists('booking_roomfail');
    }
};
