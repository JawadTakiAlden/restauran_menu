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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description' , 500);
            $table->string('logo');
            $table->string('cover');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('template_id')->references('id')->on('templates')->onDelete('cascade');
            $table->string('menu_link');
            $table->string('qr');
            $table->boolean('is_pending')->default(false);
            $table->boolean('is_offer_shown')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
