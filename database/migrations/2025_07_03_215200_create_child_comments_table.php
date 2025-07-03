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
        Schema::create('child_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_comments');
    }
};
