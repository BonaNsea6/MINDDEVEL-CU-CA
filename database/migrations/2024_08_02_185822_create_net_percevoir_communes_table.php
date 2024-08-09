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
        Schema::create('net_percevoir_communes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->string('annee');
            $table->decimal('partFixe',18,2)->nullable();
            $table->decimal('partVariable',18,2)->nullable();
            $table->decimal('total',18,2)->nullable();
            $table->decimal('tauxRepartition', 8, 2)->nullable();
            $table->decimal('totauxCommunes', 18, 2)->nullable();
            $table->decimal('totalTrimestriel', 18, 2)->nullable();
            $table->decimal('recetteParCommune', 18, 2)->nullable();
            $table->string('etat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('net_percevoir_communes');
    }
};
