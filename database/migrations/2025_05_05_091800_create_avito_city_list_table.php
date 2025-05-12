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
        Schema::create('avito_city_list', function (Blueprint $table) {
            $table->id();
            $table->string('counterparty')->nullable();
            $table->string('region');
            $table->string('token');
            $table->string('phone');
            $table->string('address');
            $table->string('prefix')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avito_city_list');
    }
};
