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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique()->nullable();
            $table->date("date_of_birth")->nullable();
            $table->string("address")->nullable();
            $table->string('password');
            $table->string('token',20);
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->unsignedBigInteger('premium_id')->nullable();
            $table->foreign('premium_id')->references('id')->on('premiums');
            $table->date('premium_register_date')->nullable();
            $table->boolean('paymented')->default(true);
            $table->boolean('status')->default(0);
            $table->rememberToken();
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
