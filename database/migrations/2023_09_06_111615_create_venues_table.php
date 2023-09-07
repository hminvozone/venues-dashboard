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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['Private', 'Public']);
            $table->string('name');
            $table->string('type')->nullable();
            $table->boolean('is_activated')->default(false);
            $table->text('description')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address')->unique();
            $table->string('website')->nullable();
            $table->text('full_address');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->boolean('description_cleaned')->default(false);
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
