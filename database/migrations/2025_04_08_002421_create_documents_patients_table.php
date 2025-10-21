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
       Schema::create('documents_patients', function (Blueprint $table) {
    $table->id();
    $table->foreignId('patient_id')->constrained()->onDelete('cascade');
    $table->string('titre');
    $table->string('fichier'); // chemin vers le fichier (pdf, jpg…)
    $table->date('date');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_patients');
    }
};
