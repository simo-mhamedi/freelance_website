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
        Schema::create('users', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("image");
            $table->string("companyName");
            $table->string("companyRepresentative");
            $table->string("rcCompany");
            $table->string("city");
            $table->string("country");
            $table->string("tele");
            $table->string("desc_Activity");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
