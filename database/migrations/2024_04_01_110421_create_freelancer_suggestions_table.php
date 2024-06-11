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
        Schema::create('freelancer_suggestions', function (Blueprint $table) {
            $table->id();
            $table->decimal('prix')->default(0);
            $table->string('note')->nullable();
            $table->unsignedBigInteger('article_id')->notNull();
            $table->foreign('article_id')
            ->references('id')->on('articles')->onDelete('cascade');
            $table->unsignedBigInteger('freelancer_id')->notNull();
            $table->foreign('freelancer_id')
            ->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_suggestions');
    }
};
