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
            $table->string('reference')->primary();
            $table->bigInteger('request_number')->notNull();
            $table->foreign('request_number')
            ->references('requestNumber')->on('requests')->onDelete('cascade');
            $table->string('user_mail')->notNull();
            $table->foreign('user_mail')
            ->references('email')->on('users')->onDelete('cascade');
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
