<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    protected $table = 'category';
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function productsCount()
    {
        return $this->products()->count();
    }
}
