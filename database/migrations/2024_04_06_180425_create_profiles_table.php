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
        Schema::create('profiles', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('email')->unique();
          $table->string('phoneNumber')->nullable();
          $table->string('alternateNumber')->nullable();
          $table->string('address')->nullable();
          $table->string('state')->nullable();
          $table->string('zipCode')->nullable();
          $table->string('country')->nullable();
          $table->string('language')->nullable();
          $table->timestamp('email_verified_at')->nullable();
          $table->rememberToken();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};