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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum("type", ["GOAL", "SELF_GOAL", "YELLOW_CARD", "RED_CARD"]);
            $table->integer("minute");
            $table->foreignId("team_id")->constrained()->onDelete("CASCADE");
            $table->foreignId("game_id")->constrained()->onDelete("CASCADE");
            $table->foreignId("player_id")->constrained()->onDelete("CASCADE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
