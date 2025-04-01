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

        Schema::create('factures', function (Blueprint $table) {
            $table->id();  // Clé primaire
            $table->foreignId('id_consultation')->constrained('consultations');  // Clé étrangère vers consultations
            $table->double('montant');
            $table->char('statut_paiement');
            $table->char('mode_paiement');
            $table->date('date_paiement');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
