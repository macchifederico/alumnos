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
        Schema::table('domicilios', function (Blueprint $table) {
            $table->string('piso')->nullable()->after('numero');
            $table->string('departamento')->nullable()->after('piso');
            $table->string('ciudad')->nullable()->after('departamento');
            $table->string('pais')->default('Argentina')->after('codigo_postal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domicilios', function (Blueprint $table) {
            $table->dropColumn(['piso', 'departamento', 'ciudad', 'pais']);
        });
    }
};
