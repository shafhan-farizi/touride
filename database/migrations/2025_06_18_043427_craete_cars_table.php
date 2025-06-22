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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default('https://picsum.photos/200/300');
            $table->string('description');
            $table->string('name');
            $table->string('type');
            $table->string('plate_number')->unique();
            $table->bigInteger('rental_price');
            $table->bigInteger('insurance')->default(0);
            $table->bigInteger('service_fee')->default(0);
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->date('maintenance_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
