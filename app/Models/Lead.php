<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'leads';
    protected $fillable =  [
        'campaign_name',
        'last_name',
        'name',
        'email',
        'phone',
        'sent_to_neo'
    ];

    // Marca como Enviado a NEO
    public function updateSent_To_Neo($sent = true){
        $this->sent_to_neo = $sent;
        $this->save();
    }


}
