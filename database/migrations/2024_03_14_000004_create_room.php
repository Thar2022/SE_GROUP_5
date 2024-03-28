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
        Schema::create('meeting_room', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('topic');
            $table->string('status');
        });

        Schema::create('close_room', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_check');
            $table->date('date_close');
            $table->date('date_open');
            $table->unsignedBigInteger('id_room');

            $table->foreign('id_check')->references('id')->on('check_room');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_room');
        Schema::dropIfExists('close_room');
    }
};
