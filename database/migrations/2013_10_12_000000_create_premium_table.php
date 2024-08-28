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
        Schema::create('premiums', function (Blueprint $table) {
            $table->id();
            $table->string('premium_name')->unique();
            $table->string('premium_title');            
            $table->string('premium_icon')->nullable();            
            $table->integer('level');
            $table->integer('billing_cycle');
            $table->bigInteger("upgrade_costs")->nullable();  
            $table->bigInteger("limit_create_custom_link")->nullable();
            $table->bigInteger("limit_create_qrcode")->nullable();
            $table->bigInteger("link_lifespan")->nullable();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premia');
    }
};
