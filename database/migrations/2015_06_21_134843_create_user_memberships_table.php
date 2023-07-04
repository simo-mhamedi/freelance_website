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
        Schema::create('user_memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membership_id')->notNull();
            $table->foreign('membership_id')
            ->references('id')->on('memberships')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->notNull();
            $table->foreign('user_id')
            ->references('id')->on('users');
            $table->string('estimates_restNumber');
            $table->string('estimates_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userMembership');
    }
};
