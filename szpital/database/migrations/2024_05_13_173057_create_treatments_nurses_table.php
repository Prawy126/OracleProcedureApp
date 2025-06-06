<?php

use App\Models\Nurse;
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
        Schema::create('treatments_nurses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Nurse::class)->constrained();
            $table->foreignIdFor(Procedure::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments_nurses');
    }
};
