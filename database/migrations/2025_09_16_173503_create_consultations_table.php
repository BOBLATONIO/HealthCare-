<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->date('date');
            $table->string('diagnosis');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
