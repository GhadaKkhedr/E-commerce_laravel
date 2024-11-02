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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->bigInteger('categoryID');
            $table->bigInteger('price');
            $table->bigInteger('sellerAddedIt');
            $table->bigInteger('quantityAvailable');
            $table->timestamps();

            $table->foreign('categoryID')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('sellerID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
