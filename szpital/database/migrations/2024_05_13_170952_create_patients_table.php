<?php

use App\Models\nurse;
use App\Models\room;
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
            //$table->foreignIdFor(nurse::class)->constrained();
            //$table->foreignIdFor(User::class)->constrained();
            $table->integer('time_visit');
            //$table->foreignIdFor(room::class)->constrained();

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
