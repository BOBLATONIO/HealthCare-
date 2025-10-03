<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id(); // id (PK)

            // Foreign keys
            $table->unsignedBigInteger('consultation_id');
            $table->unsignedBigInteger('medicine_id');

            $table->integer('quantity'); // number prescribed

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
