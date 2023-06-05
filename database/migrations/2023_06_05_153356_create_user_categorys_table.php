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
        Schema::create('userCategorys', function (Blueprint $table) {
            $table->id();
            $table->string('user_mail')->notNull();
            $table->foreign('user_mail')
            ->references('email')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->notNull();
            $table->foreign('category_id')
            ->references('id')->on('categorys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userCategorys');
    }
};
