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
            $table->id();
            $table->bigInteger('id_patient');
            $table->bigInteger('id_medecin');
            $table->date('date_consultation');
            $table->foreign('date_consultation')->references('id_consultation')->on('factures');
            $table->char('motif');
            $table->foreign('motif')->references('id_consultation')->on('ordonnances');
            $table->string('diagnostic');
            $table->string('traitemement');
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
