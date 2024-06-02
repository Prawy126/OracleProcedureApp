<?php

use App\Models\Nurse;
use App\Models\Room;
use App\Models\User;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name',20);
            $table->string('surname',25);
            $table->foreignIdFor(Nurse::class)->constrained();
            $table->foreignIdFor(User::class)->unique()->constrained()->onDelete('cascade');
            $table->integer('time_visit');
            $table->foreignIdFor(Room::class)->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
