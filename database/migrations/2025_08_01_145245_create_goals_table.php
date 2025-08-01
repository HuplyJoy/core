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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained('challenges');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->double('latitude')->default(0);
            $table->double('longitude')->default(0);
            $table->double('points')->default(0)->comment('goal points');
            $table->bigInteger('has_store_item',false,true)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
