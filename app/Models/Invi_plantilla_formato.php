<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_plantilla_formato extends Model
{
    protected $table = 'invi_plantillas_formato';
    protected $primaryKey = 'id_plantilla';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_convocatoria',
        'codigo_formato',
        'nombre_formato',
        'version',
        'estado_aprobacion',
        'fecha_aprobacion',
        'plantilla_blade',

    ];
    protected $casts = [
        'fecha_aprobacion' => 'date',
    ];
    public function convocatoria()
    {
        return $this->belongsTo(Invi_convocatoria::class, 'id_convocatoria', 'id_convocatoria');
    } 
    public function invi_proyectos_formatos()
    {
        return $this->hasMany(Invi_proyectos_formatos::class, 'id_plantilla');
    }

}
