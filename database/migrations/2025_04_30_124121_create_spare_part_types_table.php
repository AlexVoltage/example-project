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
        Schema::create('spare_part_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('product_types_id')->constrained(
                table: 'product_types', indexName: 'spare_types_product_types_id'
            );
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_part_types');
    }
};
