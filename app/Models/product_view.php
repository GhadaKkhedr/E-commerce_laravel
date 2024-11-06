<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_view extends Model
{
    use HasFactory;
    protected $fillable = [
        'productName',
        'description',
        'CategoryName',
        'price',
        'sellerName',
        'quantityAvailable',
        'productImage',
        'SellerID'

    ];
    protected $table = 'product_view';
}
