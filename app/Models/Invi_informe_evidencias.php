<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_informe_evidencias extends Model
{
    protected $table = 'invi_informe_evidencias';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'informe_id',
        'ruta_archivo',
        'tipo_archivo',
        'fecha_impronta_foto',
        'descripcion_pie_foto',
        'coordenadas_lat_lng',
    ];
    public function invi_informes()
    {
        return $this->belongsTo(Invi_informes::class, 'informe_id', 'id_informes');
    }

}
