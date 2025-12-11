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
        Schema::create('forecasts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('timestamp_dt');
            $table->string('city_name', 80)->unique();
            $table->float('min_tmp', 5);
            $table->float('max_tmp', 5);
            $table->float('wind_spd', 6);
            $table->dateTime('text_dt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecasts');
    }
};
