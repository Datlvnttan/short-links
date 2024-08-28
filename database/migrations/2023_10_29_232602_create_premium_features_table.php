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
        Schema::create('premium_features', function (Blueprint $table) {
            $table->unsignedBigInteger('feature_id');
            $table->foreign('feature_id')->references('id')->on('features');  
            $table->unsignedBigInteger('premium_id');
            $table->foreign('premium_id')->references('id')->on('premiums'); 
            $table->boolean("status")->default(false);                 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premium_features');
    }
};
