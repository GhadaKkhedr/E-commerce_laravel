<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('CustomerID')->unsigned();
            $table->bigInteger('productID')->unsigned();
            $table->string('prdtName');
            $table->string('prdtImg');
            $table->decimal('price');
            $table->bigInteger('CountOfProductID')->unsigned(); //number of items from this product
            $table->boolean('Paid')->unsigned()->default(false); // didn't pay
            $table->timestamps();

            $table->foreign('productID')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('CustomerID')->references('id')->on('users')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE `cart` ADD UNIQUE(`CustomerID`, `productID`);");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
