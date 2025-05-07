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
        Schema::create('menu_relations', function (Blueprint $table) {
            $table->id();
            $table->integer('menuId');
            $table->string('GoodsType');
            $table->string('ProductType');
            $table->string('SparePartType')->nullable();
            $table->string('TransmissionSparePartType')->nullable();
            $table->string('TechnicSparePartType')->nullable();
            $table->string('EngineSparePartType')->nullable();
            $table->string('BodySparePartType')->nullable();
            $table->string('DeviceType')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_relations');
    }
};
