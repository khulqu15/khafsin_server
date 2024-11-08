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
        Schema::create('imus', function (Blueprint $table) {
            $table->id();
            $table->double('x');
            $table->double('y');
            $table->double('z');
            $table->string('location')->nullable();
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
            $table->double('alt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imus');
    }
};
