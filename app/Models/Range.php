<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory;
    protected $table = 'ranges';
    public $timestamps = false;
    protected $fillable =  [
        'price_from',
        'price_to'
    ];

    /*+-----------------------------+
      | Relaciones entre tablas     |
      +-----------------------------+
    */


    /*+----------------------------------------------------------+
      | Mucho - Uno: Tiene a muchos en otra Tabla (Es Pader de)  |
      +----------------------------------------------------------+
    */

    // Socios <--- Préstamos:
    public function prestamos(){
        return $this->hasMany(Prestamo::class);
    }
}
