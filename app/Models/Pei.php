<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pei extends Model
{
    protected $table = 'pei';
    protected $primaryKey = 'id_pei';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombre_pei',
        'anios_pei',
        'estado_pei',
        'archivo_pei'
    ];

}