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
        $query = "CREATE or replace VIEW Product_view AS
                SELECT product.id, product.name as productName, category.name as CategoryName , users.Fname as sellerName,
	            product.description , product.price , product.quantityAvailable , product.pImage as productImage ,
                product.sellerAddedIt as SellerID ,product.pImage as productImg
                FROM product , users , category
                WHERE product.categoryID = category.id and product.sellerAddedIt = users.id;
                order by `CategoryName`";

        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $query = "drop view Product_view";
        DB::statement($query);
    }
};
