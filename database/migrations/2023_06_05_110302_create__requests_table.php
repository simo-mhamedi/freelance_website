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
        Schema::create('requests', function (Blueprint $table) {
            $table->bigInteger('requestNumber')->primary();
            $table->string('title');
            $table->string('description');
            $table->string('price_min');
            $table->string("price_max");
            $table->date("date_request");
            $table->string("date_deadline");
            $table->string("status");
            $table->string('user_mail')->notNull();
            $table->timestamps();
            $table->foreign('user_mail')
            ->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Request');
    }
};
