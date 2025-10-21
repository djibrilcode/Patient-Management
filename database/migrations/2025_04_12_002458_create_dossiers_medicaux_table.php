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
        Schema::create('dossiers_medicaux', function (Blueprint $table) {
    $table->id();
    $table->foreignId('patient_id')->constrained()->onDelete('cascade');
    $table->text('antecedents_personnels')->nullable();
    $table->text('antecedents_familiaux')->nullable();
    $table->text('allergies')->nullable();
    $table->text('traitements_chroniques')->nullable();
    $table->text('habitudes')->nullable();
    $table->text('remarques')->nullable();
    $table->foreignId('medecin_id')->nullable()->constrained()->onDelete('set null');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers_medicauxes');
    }
};
