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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id('menu_item_id');
            $table->string('menu_item_name');
            $table->text('menu_item_description')->nullable();
            $table->decimal('menu_item_price', 10, 2);
            $table->boolean('menu_item_available')->default(true);
            $table->string('menu_item_category')->nullable();
            $table->foreignId('restaurant_id')->references('restaurant_id')->on('restaurants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
