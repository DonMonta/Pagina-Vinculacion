<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_proyectos_formatos extends Model
{
    protected $table = 'invi_proyectos_formatos';
    protected $primaryKey = 'id_proyecto_formato';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'proyect_id',
        'id_plantilla',
        'estado_llenado',
        'pdf_generado_path',
        'fecha_generacion',
    ];
    protected $casts = [
        'fecha_generacion' => 'datetime',
    ];
    public function proyecto()
    {
        return $this->belongsTo(Invi_proyectos::class, 'proyect_id', 'proyect_id');
    }
    public function plantilla()
    {
        return $this->belongsTo(Invi_plantilla_formato::class, 'id_plantilla', 'id_plantilla');
    }
    public function invi_informes()
    {
        return $this->hasMany(Invi_informes::class, 'id_proyecto_formato', 'id_proyecto_formato');
    }

}
