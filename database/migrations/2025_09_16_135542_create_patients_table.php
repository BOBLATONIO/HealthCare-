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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patient_id'); // primary key
            $table->string('first_name'); // required
            $table->string('middle_name'); // required
            $table->string('last_name'); // required
            $table->string('gender'); // required
            $table->string('contact'); // required
            $table->text('address'); // required
            $table->date('birthdate'); // required
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
