<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_Normativa extends Model
{
    protected $table = 'invi_normativas';
    protected $primaryKey = 'id_normativas';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_tipo_normativa',
        'cod_norma',
        'nombre_normativas',
        'elaboracion',
        'revision',
        'aprobacion',
        'fecha_aprobacion',
        'num_resolucion',
        'estado',
        'archivo',
        'id_departamento'

    ];
    public function invi_tipo_normativa()
    {
        return $this->belongsTo(Invi_tipos_normativas::class, 'id_tipo_normativa', 'id_tipo_normativa');
    }
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento', 'id_departamento');
    }

}
