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
        Schema::create('check_room', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_booking');
            $table->unsignedBigInteger('id_emp');
            $table->date('date');
            $table->time('time');
            $table->string('status_check');
            $table->string('time_check');
            $table->longText('note');

            $table->foreign('id_emp')->references('id')->on('employee');
        });

        Schema::create('check_brokenroom', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_check');
            $table->date('date');
            $table->unsignedBigInteger('id_emp');
            $table->string('status_repair');


            $table->foreign('id_check')->references('id')->on('check_room');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_room');
        Schema::dropIfExists('check_brokenroom');
    }
};
