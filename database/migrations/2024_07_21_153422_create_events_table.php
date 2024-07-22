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
            $table->string('event_name');
            $table->string('location');
            $table->foreignId('province_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->text('description');
            $table->text('information');
            $table->string('image');
            $table->datetime('start_date');
            $table->datetime('end_date');
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
