<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_campos_plantilla extends Model
{
    protected $table = 'invi_campos_plantilla';
    protected $primaryKey = 'id_campo_plantilla';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_plantilla',
        'etiqueta_campo',
        'clave_campo',
        'tipo_origen',
        'tabla_origen',
        'columna_origen',
        'tipo_dato_input',
        'es_requerido',
        'orden',

    ];
    public function plantilla()
    {
        return $this->belongsTo(Invi_plantilla_formato::class, 'id_plantilla', 'id_plantilla');
    }
    public function respuestas_manuales_formato()
    {
        return $this->hasMany(Invi_respuestas_manuales_formato::class, 'id_campo_plantilla');
    }

}
