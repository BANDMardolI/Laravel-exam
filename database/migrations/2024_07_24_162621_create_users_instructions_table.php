<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_instructions', function (Blueprint $table) {
            $table->id();
            $table->string('summary', 100)->unique();
            $table->timestamps();
            $table->string('imagepath', 256)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_instructions');
    }
};
