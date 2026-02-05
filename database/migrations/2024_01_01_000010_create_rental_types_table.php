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
        Schema::create('rental_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Lepas Kunci, Mobil + Driver, etc
            $table->text('description'); // Full description
            $table->string('icon'); // Font awesome icon class: fa-key, fa-car-side, etc
            $table->integer('order')->default(0); // For sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_types');
    }
};
