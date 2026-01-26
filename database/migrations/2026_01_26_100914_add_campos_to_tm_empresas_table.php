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
        Schema::table('tm_empresas', function (Blueprint $table) {
            $table->bigInteger('extra25')->after('decimo_cuarto')->default(0);
            $table->bigInteger('extra50')->after('extra25')->default(0);
            $table->bigInteger('extra100')->after('extra50')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_empresas', function (Blueprint $table) {
            $table->dropColumn('extra25');
            $table->dropColumn('extra50');
            $table->dropColumn('extra100');
        });
    }
};
