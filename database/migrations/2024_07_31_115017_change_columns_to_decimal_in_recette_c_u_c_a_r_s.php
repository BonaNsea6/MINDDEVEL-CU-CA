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
        Schema::table('recette_c_u_c_a_r_s', function (Blueprint $table) {
            $table->decimal('pic', 18, 2)->change();
            $table->decimal('pcac', 18, 2)->change();
            $table->decimal('ptc', 18, 2)->change();
            $table->decimal('rdp', 18, 2)->change();
            $table->decimal('rdpc', 18, 2)->change();
            $table->decimal('rtps', 18, 2)->change();
            $table->decimal('Total', 18, 2)->change();
            $table->decimal('tauxApplique', 18, 2)->change();
            $table->decimal('resteCUB', 18, 2)->change();
            $table->decimal('partFixe', 18, 2)->change();
            $table->decimal('partVariable', 18, 2)->change();
            $table->decimal('partCommune', 18, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recette_c_u_c_a_r_s', function (Blueprint $table) {
            $table->bigInteger('pic')->change();
            $table->bigInteger('pcac')->change();
            $table->bigInteger('ptc')->change();
            $table->bigInteger('rdp')->change();
            $table->bigInteger('rdpc')->change();
            $table->bigInteger('rtps')->change();
            $table->bigInteger('Total')->change();
            $table->bigInteger('tauxApplique')->change();
            $table->bigInteger('resteCUB')->change();
            $table->bigInteger('partFixe')->change();
            $table->bigInteger('partVariable')->change();
            $table->bigInteger('partCommune')->nullable()->change();
        });
    }
};
