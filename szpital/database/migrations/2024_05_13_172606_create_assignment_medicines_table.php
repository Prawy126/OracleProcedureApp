<?php

use App\Models\medicin;
use App\Models\patient;
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
        Schema::create('assignment_medicines', function (Blueprint $table) {
            $table->foreignIdFor(patient::class)->constrained();
            $table->foreignIdFor(medicin::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_medicines');
    }
};
