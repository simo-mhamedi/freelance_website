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
            $table->id();
            $table->bigInteger('requestNumber');
            $table->string('title');
            $table->string('description');
            $table->string('price_min');
            $table->string("price_max");
            $table->date("date_request");
            $table->date("date_deadline");
            $table->string("status");
            $table->integer("viewsNumber");
            $table->unsignedBigInteger('user_id')->notNull();
            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade');
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
