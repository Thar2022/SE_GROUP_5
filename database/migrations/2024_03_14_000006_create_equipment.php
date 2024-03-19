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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('equipment_room', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_equipment');
            $table->unsignedBigInteger('id_room');
            $table->integer('amount');

            $table->foreign('id_equipment')->references('id')->on('equipment');
            $table->foreign('id_room')->references('id')->on('meeting_room');
        });

        Schema::create('brokenequipment_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_check');
            $table->unsignedBigInteger('id_equipmentroom');
            $table->date('date_finish');
            $table->integer('amount');

            $table->foreign('id_check')->references('id')->on('check_room');
            $table->foreign('id_equipmentroom')->references('id')->on('equipment_room');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
        Schema::dropIfExists('equipment_room');
        Schema::dropIfExists('brokenequipment_list');
    }
};
