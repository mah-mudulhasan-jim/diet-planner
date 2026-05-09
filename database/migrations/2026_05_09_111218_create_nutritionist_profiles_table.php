<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('nutritionist_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to the main users table
            $table->string('specialty'); // e.g., "Sports Nutrition", "Weight Loss"
            $table->text('bio')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->integer('consultation_fee')->default(0); // Optional: if they charge a fee
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutritionist_profiles');
    }
};
