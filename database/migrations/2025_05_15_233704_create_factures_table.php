<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained('consultations');
            $table->decimal('montant', 10, 2);
            $table->enum('statut_paiement', ['payé', 'impayé', 'partiel'])->default('impayé');
            $table->enum('mode_paiement', ['espèce', 'carte', 'chèque', 'virement', 'mynita', 'amanata'])->nullable();
            $table->date('date_paiement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};