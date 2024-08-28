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
        Schema::create('short_url', function (Blueprint $table) {
            $table->id();
            $table->string("shortened_link")->unique();
            $table->string("original_link");
            $table->string('title')->nullable();
            $table->dateTime('effective_time')->nullable();
            $table->dateTime("expired")->nullable();            
            $table->bigInteger('total_visits')->default(0);
            $table->bigInteger('limit_visits')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table__short_url');
    }
};
