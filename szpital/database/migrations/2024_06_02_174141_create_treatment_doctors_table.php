<?php

use App\Models\Doctor;
use App\Models\Procedure;
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
        Schema::create('treatment_doctors', function (Blueprint $table) {
            $table->foreignIdFor(Procedure::class)->constrained();
            $table->foreignIdFor(Doctor::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_doctors');
    }
};
