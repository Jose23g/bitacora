<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable =[
    'id_visitante',
    'actividad',
    'hora_entrada',
    'hora_salida'
    ];

    public function visitante(){
        return $this->belongsTo(Visitante::class, 'id_visitante');
    }
}
