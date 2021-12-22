<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable =  [
        'name',
        'description',
        'image',
        'language',
    ];

    public static function rules($id)
    {
        if ($id <= 0) {
            return [
                'name'      => 'required|min:3|max:50|string|unique:promotions',
                'imagex'     => 'required',
                'language'  => Rule::in(['es', 'en']),
                'language'  =>  'required',
            ];
        } else {
            return [
                'name' => "required|min:3|max:50|string|unique:promotions,name,{$id}",
                'imagex'     => 'required',
                'language'  =>  'required',
            ];
        }
    }

    public static $english_messages = [
        'name.required' => 'Name is Required',
        'name.max'      => 'Name lenght must be max of 50 characteres',
        'name.unique'   => 'Name of file exists in the ssystem',
        'language.in'   => 'Language must be Spanish or English',
        "imagex.required"=> 'Imagen is Required',
    ];

    public static $spanish_messages = [
        'name.required' => 'Nombre es requerido',
        'name.max'      => 'Nombre máximo 50 carácteres',
        'name.unique'   => 'Nombre de archivo ya existe',
        'language.required'   => 'Idioma debe Español o Inglés',
        "imagex.required"=> 'Imagen es requerida',
    ];


    public function scopeLanguage($query, $language) {
        if (trim($language) != "") {
            $query->where('language', $language);
        }
    }
}
