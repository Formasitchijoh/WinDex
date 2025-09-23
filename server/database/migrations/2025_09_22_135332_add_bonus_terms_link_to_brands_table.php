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
        Schema::table('brands', function (Blueprint $table) {
            $table->string('bonus')->nullable();  // e.g., "300% up to €3,000"
            $table->text('terms')->nullable();    // e.g., "Wagering ×30, min deposit €20"
            $table->string('link')->nullable();   // e.g., "https://example.com/mad-casino"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn(['bonus', 'terms', 'link']);
        });
    }
};
