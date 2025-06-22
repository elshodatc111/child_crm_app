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
        Schema::create('balans', function (Blueprint $table) {
            $table->id();
            $table->integer('naqt')->default(0);
            $table->integer('plastik')->default(0);
            $table->integer('exson_naqt')->default(0);
            $table->integer('exson_plastik')->default(0);
            $table->integer('exson_foiz')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balans');
    }
};
