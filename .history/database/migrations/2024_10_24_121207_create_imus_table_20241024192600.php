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
            $table->string('location')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->double('lat')->nullable()->default(null);
            $table->double('lon')->nullable()->default(null);
            $table->double('alt')->nullable()->default(null);
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
