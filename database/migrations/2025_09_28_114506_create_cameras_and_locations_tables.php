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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->timestamps(); // otomatis bikin created_at & updated_at
        });

        Schema::create('cameras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_location')->constrained('locations')->onDelete('cascade');
            $table->string('name', 100)->nullable();
            $table->text('rtsp_url')->nullable();
            $table->string('slug', 50)->nullable();
            $table->text('lat');
            $table->text('lng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cameras_and_locations_tables');
    }
};
