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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->integer('reference');
            $table->unsignedBigInteger('request_id')->notNull();
            $table->foreign('request_id')
            ->references('id')->on('requests')->onDelete('cascade');
            $table->unsignedBigInteger('freelancer_id')->notNull();
            $table->foreign('freelancer_id')
            ->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('client_id')->notNull();
            $table->foreign('client_id')
            ->references('id')->on('users')->onDelete('cascade');
            $table->date('estimate_date');
            $table->string('rating');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
