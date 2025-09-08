<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'price',
        'description',
        'stock_quantity',
        'vendor_id',
        'category',
        'image_url',
        'model',
    ];
    protected $table = 'products';
}
