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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50);
            $table->string('title', 100);
            $table->string('status', 10);
            $table->decimal('price', 8, 2);
            $table->decimal('promotional_price', 8, 2)->nullable();
            $table->dateTime('promotion_starts_on')->nullable();
            $table->dateTime('promotion_ends_on')->nullable();
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
