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
        Schema::create('reglements', function (Blueprint $table) {
    $table->id();
    $table->foreignId('facture_id')->constrained()->onDelete('cascade');
    $table->decimal('montant_regle', 10, 2);
    $table->enum('mode', ['espèce', 'carte', 'chèque', 'virement','mynita', 'amanata']);
    $table->date('date_reglement');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reglements');
    }
};
