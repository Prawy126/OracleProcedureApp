<?php

use App\Models\doctor;
use App\Models\procedure;
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
        Schema::create('treatments_doctors', function (Blueprint $table) {
            $table->foreignIdFor(procedure::class)->constrained();
            $table->foreignIdFor(doctor::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments_doctors');
    }
};
