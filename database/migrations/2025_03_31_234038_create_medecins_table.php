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

        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
            $table->char('nom');
            $table->foreign('nom')->references('id_medecin')->on('rendez_vous');
            $table->char('prenom');
            $table->char('specialite');
            $table->bigInteger('telephone');
            $table->char('email');
            $table->foreign('email')->references('id_consultation')->on('consultations');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};
