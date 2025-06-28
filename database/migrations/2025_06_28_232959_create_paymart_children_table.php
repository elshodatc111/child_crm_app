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
        Schema::create('paymart_children', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->unsignedBigInteger('child_parent_id');
            $table->integer('amount');
            $table->enum('type', ['naqt', 'plastik', 'chegirma']);
            $table->text('description')->nullable();
            $table->enum('status', ['tulov', 'qaytar', 'chegirma'])->default('tulov');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymart_children');
    }
};
