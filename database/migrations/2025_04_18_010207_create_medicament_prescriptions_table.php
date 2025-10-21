<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentPrescriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('medicament_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained()->onDelete('cascade');
            $table->foreignId('medicament_id')->constrained()->onDelete('cascade');
            $table->string('dosage'); // Ex: 1 comprimé matin et soir
            $table->string('duree');  // Ex: 7 jours
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicament_prescriptions');
    }
}
