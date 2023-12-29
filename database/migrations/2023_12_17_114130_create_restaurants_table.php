<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('api_id');
            $table->timestamps();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->float('rating', 2, 1);
            $table->float('price', 2, 1);
            $table->float('vegan');
            $table->float('vegetarian');
            $table->float('halal');
            $table->float('kosher');
            $table->float('glutenFree');
            $table->float('studentDiscount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
}
