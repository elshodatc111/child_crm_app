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
        Schema::create('vacancy_children', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('addres');
            $table->date('birthday');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['new', 'pedding', 'cancel', 'success'])->default('new');
            $table->unsignedBigInteger('menejer_id')->nullable();
            $table->foreign('menejer_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_children');
    }
};
