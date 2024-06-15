<?php

use App\Models\Patient;
use App\Models\Room;
use App\Models\TreatmentType;
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
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TreatmentType::class)->constrained();
            $table->foreignIdFor(Room::class)->constrained();
            $table->timestamp('date');
            $table->string('time');
            $table->decimal('cost',10,2);
            $table->integer('status');
            $table->foreignIdFor(Patient::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
