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
        Schema::create('recette_cars', function (Blueprint $table) {
            $table->id();
            $table->string('annee');
            $table->unsignedBigInteger('user_id');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('pil');
            $table->bigInteger('peds');
            $table->bigInteger('ptc');
            $table->bigInteger('totalAnneeN2')->nullable();
            $table->bigInteger('totalAnneeN3')->nullable();
            $table->bigInteger('difference')->nullable();
            $table->decimal('totauxCommunes', 18, 2)->nullable();
            $table->decimal('tauxRepartition', 8, 2)->nullable();
            $table->string('etat')->nullable();
            $table->string('illigibilite')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recette_cars');
    }
};


