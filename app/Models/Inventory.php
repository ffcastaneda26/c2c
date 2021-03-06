<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
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

    // Nombre Completo
    public function scopeFullsearch($query,$valor)
    {
        if (trim($valor) != "") {
            $valor =str_replace(' ','%',$valor);
            $query->where(DB::raw("CONCAT(make,model,year, stock)"), 'LIKE', "%$valor%");
        }
    }
}