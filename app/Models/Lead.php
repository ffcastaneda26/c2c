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
        'name',
        'last_name',
        'phone',
        'email',
        'created_at',
        'sent_to_neo'
    ];

    // Marca como Enviado a NEO
    public function updateSent_To_Neo($sent = true){
        $this->sent_to_neo = $sent;
        $this->save();
    }

    // Los Leads que no se han enviado a neo
    public function scopePendingSendToNeo($query) {
        $query->where('sent_to_neo',0);
    }
}
