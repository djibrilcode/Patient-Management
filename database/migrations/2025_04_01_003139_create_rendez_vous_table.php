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

        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_patient')->constrained('patients');  // Clé étrangère vers la table patients
            $table->foreignId('id_medecin')->constrained('medecins');  // Clé étrangère vers la table medecins
            $table->dateTime('date_heure');
            $table->string('statut');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};
