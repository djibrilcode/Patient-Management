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

        Schema::create('ordonnances', function (Blueprint $table) {
            $table->id();  // Clé primaire
            $table->foreignId('id_consultation')->constrained('consultations');  // Clé étrangère vers consultations
            $table->char('details_medicament');  // Détails du médicament
            $table->timestamps();  // Ajoute les colonnes created_at et updated_at
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordonnances');
    }
};
