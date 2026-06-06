<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->string('user_agent', 512)->nullable();
            $table->date('visited_date'); // untuk aggregasi per hari
            $table->timestamps();

            // Unik per IP per hari
            $table->unique(['ip_address', 'visited_date']);
            $table->index('visited_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_visits');
    }
};
