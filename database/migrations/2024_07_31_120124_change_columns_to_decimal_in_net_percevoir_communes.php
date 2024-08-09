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
        Schema::table('net_percevoir_communes', function (Blueprint $table) {
            $table->decimal('partFixe', 18, 2)->nullable()->change();
            $table->decimal('partVariable', 18, 2)->nullable()->change();
            $table->decimal('total', 18, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('net_percevoir_communes', function (Blueprint $table) {
            $table->bigInteger('partFixe')->nullable()->change();
            $table->bigInteger('partVariable')->nullable()->change();
            $table->bigInteger('total')->nullable()->change();
        });
    }
};
