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
        Schema::disableForeignKeyConstraints();

        Schema::create('consultations', function (Blueprint $table) {
            $table->id();  // Clé primaire
            $table->foreignId('id_patient')->constrained('patients');  // Clé étrangère vers patients
            $table->foreignId('id_medecin')->constrained('medecins');  // Clé étrangère vers medecins
            $table->date('date_consultation');
            $table->string('motif');
            $table->string('diagnostic');
            $table->string('traitement');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
