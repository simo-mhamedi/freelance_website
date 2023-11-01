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
            $table->id();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('email3')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('name')->nullable();
            $table->string("image")->nullable();
            $table->string("companyName")->nullable();
            $table->string("companyRepresentative")->nullable();
            $table->string("rcCompany")->nullable();
            $table->string("city")->nullable();
            $table->string("country")->nullable();
            $table->string('role')->default('user');
            $table->string("tele")->nullable();
            $table->string("areaCode")->nullable();
            $table->boolean("has_Membership")->default(false);
            $table->boolean("isVerified")->default(false);
            $table->string("desc_Activity")->nullable();
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->foreign('membership_id')
            ->references('id')->on('memberships')->onDelete('cascade');
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
