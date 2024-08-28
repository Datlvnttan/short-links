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
        Schema::create('route_list_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('group_route_id');
            $table->foreign('group_route_id')->references('id')->on('group_routes');
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id')->references('id')->on('routes');            
            $table->primary(['route_id','group_route_id']);            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_list_groups');
    }
};
