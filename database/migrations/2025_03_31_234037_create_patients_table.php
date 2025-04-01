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

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->char('nom');
            $table->char('prenom');
            $table->foreign('prenom')->references('id_medecin')->on('rendez_vous');
            $table->date('date_naissance');
            $table->char('adresse');
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
        Schema::dropIfExists('patients');
    }
};
