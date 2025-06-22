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
        Schema::create('balans_histories', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('type');
            $table->decimal('amount', 15, 0)->default(0);
            $table->text('start_comment')->nullable();
            $table->unsignedBigInteger('start_user_id')->nullable();
            $table->text('end_comment')->nullable();
            $table->unsignedBigInteger('end_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balans_histories');
    }
};
