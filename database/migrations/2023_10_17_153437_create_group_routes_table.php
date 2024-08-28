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
        Schema::create('group_routes', function (Blueprint $table) {
            $table->id();
            $table->string('group_route_name',50)->unique();
            $table->string("group_route_title");    
            $table->boolean("default")->default(false);                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_routes');
    }
};
