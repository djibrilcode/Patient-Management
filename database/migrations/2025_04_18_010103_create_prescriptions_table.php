<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medecin_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('consultation_id')->nullable()->constrained()->onDelete('set null');
            $table->date('date_prescription');
            $table->text('instructions')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}
