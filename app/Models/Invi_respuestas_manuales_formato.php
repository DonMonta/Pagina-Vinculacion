<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_respuestas_manuales_formato extends Model
{
    protected $table = 'invi_respuestas_manuales_formato';
    protected $primaryKey = 'id_respuesta_manual';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'proyect_id',
        'id_campo_plantilla',
        'valor_texto',

    ];
    public function campo_plantilla()
    {
        return $this->belongsTo(Invi_campos_plantilla::class, 'id_campo_plantilla', 'id_campo_plantilla');
    }
    public function proyecto()
    {
        return $this->belongsTo(Invi_proyectos::class, 'proyect_id', 'proyect_id');
    }

}
