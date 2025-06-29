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
        Schema::create('group_children', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('child_id');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->text('start_comment')->nullable();
            $table->text('end_comment')->nullable();
            $table->string('paymart_type');
            $table->string('status');
            $table->unsignedBigInteger('start_manager_id')->nullable();
            $table->unsignedBigInteger('end_manager_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_children');
    }
};
