<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $table = 'visitante';
    protected $fillable =[
        'cedula', 
        'nombre',
        'tipo_usuario'
    ];

    public function logs(){
        return $this->hasMany(Log::class);
    }
}
