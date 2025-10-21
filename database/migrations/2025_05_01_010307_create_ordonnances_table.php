<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdonnancesTable extends Migration
{
    public function up()
    {
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained()->onDelete('cascade');
            $table->string('numero')->unique();
            $table->date('date_emission');
            $table->date('date_validite')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordonnances');
    }
}
