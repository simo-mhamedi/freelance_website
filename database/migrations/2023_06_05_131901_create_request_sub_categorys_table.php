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
        Schema::create('Request_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id')->notNull();
            $table->foreign('request_id')
            ->references('id')->on('requests')->onDelete('cascade');
            $table->unsignedBigInteger('subCategory_id')->notNull();
            $table->foreign('subCategory_id')
            ->references('id')->on('sub_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requestSubCategorys');
    }
};
