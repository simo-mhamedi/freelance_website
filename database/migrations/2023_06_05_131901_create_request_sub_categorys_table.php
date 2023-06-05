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
        Schema::create('requestSubCategorys', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_number')->notNull();
            $table->foreign('request_number')
            ->references('requestNumber')->on('requests')->onDelete('cascade');
            $table->unsignedBigInteger('subCategory_id')->notNull();
            $table->foreign('subCategory_id')
            ->references('id')->on('subCategorys');
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
