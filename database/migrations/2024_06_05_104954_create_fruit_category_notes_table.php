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
        Schema::create('fruit_category_notes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fruit_category_id')->unsigned();
            $table->string('name');
            $table->enum('unit', ['kg', 'pcs', 'pack'])->default('kg');
            $table->bigInteger('price')->unsigned();
            $table->foreign('fruit_category_id')->references('id')->on('fruit_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruit_category_notes');
    }
};
