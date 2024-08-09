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
        Schema::table('recette_cars', function (Blueprint $table) {
            //
            $table->decimal('totauxCommunes', 18, 2)->nullable();
            $table->decimal('tauxRepartition', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recette_cars', function (Blueprint $table) {
            //
        });
    }
};
