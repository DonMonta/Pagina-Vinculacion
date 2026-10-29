<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_informe_evaluaciones_rubrica extends Model
{
    protected $table = 'invi_informe_evaluaciones_rubrica';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'informe_id',
        'tipo_evaluacion',
        'evaluador_nombre',
        'evaluador_cargo',
        'categoria',
        'criterio_evaluado',
        'valoracion',
        'observaciones',
    ];
    public function invi_informes()
    {
        return $this->belongsTo(Invi_informes::class, 'informe_id', 'id_informes');
    }

}
