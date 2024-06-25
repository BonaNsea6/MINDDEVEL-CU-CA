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
        Schema::create('recette_c_u_c_a_r_s', function (Blueprint $table) {
            $table->id();
            $table->string('annee');
            $table->bigInteger('pic');
            $table->bigInteger('pcac');
            $table->bigInteger('ptc');
            $table->bigInteger('rdp');
            $table->bigInteger('rdpc');
            $table->bigInteger('rtps');
            $table->bigInteger('Total')->nullable();
            $table->bigInteger('tauxApplique')->nullable();
            $table->bigInteger('resteCUB')->nullable();
            $table->bigInteger('partFixe')->nullable();
            $table->bigInteger('partVariable')->nullable();
            $table->string('explication')->nullable();
            $table->string('etat')->nullable();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recette_c_u_c_a_r_s');
    }
};
