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
        Schema::create('smartphones', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('model_name');
            $table->integer('ram');               // GB
            $table->integer('front_camera');      // MP
            $table->integer('back_camera');       // MP
            $table->integer('battery_capacity');  // mAh
            $table->float('screen_size');         // inch
            $table->integer('price_usa');          // USD
            $table->year('launched_year');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smartphones');
    }
};
// cuihhh