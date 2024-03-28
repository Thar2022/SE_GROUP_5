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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('username');
            $table->string('phone');
            $table->string('email');
        });

        Schema::create('employee_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_emp');
            $table->unsignedBigInteger('id_role');

            $table->foreign('id_emp')->references('id')->on('employee');
            $table->foreign('id_role')->references('id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
        Schema::dropIfExists('employee_role');
    }
};
