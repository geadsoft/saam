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
        Schema::table('tm_personas', function (Blueprint $table) {
            $table->string('tipo',2)->after('cuenta_banco')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_personas', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
};
