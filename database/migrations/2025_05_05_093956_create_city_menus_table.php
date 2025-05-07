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
        Schema::create('city_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained(
                table: 'city_list', indexName: 'city_menus_city_list_id'
            );
            $table->string('menuId');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_menus');
    }
};
