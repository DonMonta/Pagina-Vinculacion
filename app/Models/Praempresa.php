<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Praempresa extends Model
{
    use HasFactory;
    protected $table = 'praempresa';
    protected $primaryKey = 'idempresa';
    protected $fillable = [
        'idempresa',
        'ruc',
        'empresa',
        'empresacorta',
        'lugar',
        'direccion',
        'telefono',
        'email',
        'url',
        'tipo',
        'titulo',
        'representante',
        'cargo',
        'actividad',
        'fechafin',
        'tipoinstitucion',
        'pais',
        'vision',
        'mision',
        'estado_empr',
        'imagen',
        'ciudad',
        'usuario_id',
        'archivo'
    ];
    protected $hidden = ['imagen'];

}
