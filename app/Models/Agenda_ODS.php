<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda_ODS extends Model
{
    protected $table = 'agenda_ods';
    protected $primaryKey = 'id_ag_ods';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombre_ag_ods',
        'anio_ag_ods',
        'link_ag_ods',
        'estado_ag_ods'
    ];
    public function ods()
    {
        return $this->hasMany(ODS::class, 'id_ag_ods');
    }
    

}
