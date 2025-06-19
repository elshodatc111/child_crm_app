<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('fio');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->date('tkun')->nullable();
            $table->enum('type', ['bogbon', 'oshpaz', 'qarovul', 'farrosh', 'techer', 'tarbiyachi', 'meneger'])->default('meneger');
            $table->enum('status', ['new', 'pending', 'cancel', 'success'])->default('new');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('menejer_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('menejer_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('vacancies');
    }
};
