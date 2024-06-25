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
        Schema::create('cub_cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cubId');
            $table->foreign('cubId')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('carId');
            $table->foreign('carId')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cub_cars');
    }
};
