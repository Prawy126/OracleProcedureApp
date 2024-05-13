<?php

use App\Models\room;
use App\Models\treatment_type;
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
            //$table->foreignIdFor(treatment_type::class)->constrained();
            //$table->foreignIdFor(room::class)->constrained();
            $table->timestamps('date');
            $table->time('time');
            $table->decimal('cost',10,2);
            $table->integer('status');
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
