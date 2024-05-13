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
        Schema::create('medicins', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->text('instruction');
            $table->integer('warehouse_quantity');
            $table->string('drug_category',40);
            $table->decimal('price');
            $table->string('dose_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicins');
    }
};
