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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->enum('vehicle_type', ['Compact', 'Sedan', 'SUV', 'MPV', 'Truck']);
            $table->enum('transmission', ['Manual', 'Automatic']);
            $table->integer('engine_cc');
            $table->enum('fuel_type', ['Petrol', 'Diesel', 'Hybrid']);
            $table->integer('seat_capacity');
            $table->decimal('price_per_day', 12, 2);
            $table->decimal('price_per_week', 12, 2)->nullable();
            $table->decimal('price_per_month', 12, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
