<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'vin',
        'stock',
        'year',
        'make',
        'model',
        'exterior_color',
        'interior_color',
        'mileage',
        'transmission',
        'engine',
        'retail_price',
        'sales_price',
        'options',
        'images',
        'last_updated',
        'body',
        'trim'
    ];
}