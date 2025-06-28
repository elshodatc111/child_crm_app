<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('vacancy_child_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacancy_child_id');
            $table->text('description')->nullable();
            $table->string('meneger')->nullable();
            $table->timestamps();
            $table->foreign('vacancy_child_id')->references('id')->on('vacancy_children')->onDelete('cascade');
        });
    }
    public function down(): void{
        Schema::dropIfExists('vacancy_child_comments');
    }
};
