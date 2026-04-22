<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionPersonalD extends Model
{
    protected $table = 'informacionpersonal_d';
    protected $primaryKey = 'CIInfPer';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'CIInfPer',
        'cedula_pasaporte',
        'TipoDocInfPer',
        'ApellInfPer',
        'ApellMatInfPer',
        'NombInfPer',
        'NacionalidadPer',
        'EtniaPer',
        'FechNacimPer',
        'LugarNacimientoPer',
        'GeneroPer',
        'EstadoCivilPer',
        'CiudadPer',
        'DirecDomicilioPer',
        'Telf1InfPer',
        'Telf2InfPer',
        'CelularInfPer',
        'TipoInfPer',
        'StatusPer',
        'mailPer',
        'mailInst',
        'GrupoSanguineo',
        'tipo_discapacidad',
        'carnet_conadis',
        'num_carnet_conadis',
        'porcentaje_discapacidad',
        'fotografia',
        'codigo_dactilar',
        'huella_dactilar',
        'ultima_actualizacion',
        'LoginUsu',
        'ClaveUsu',
        'StatusUsu',
        'idcarr',
        'usa_biometrico',
        'fecha_reg',
        'fecha_ultimo_acceso',
        'usu_registra',
        'usu_modifica',
        'fecha_ultima_modif',
        'usu_modifica_clave',
        'fecha_ultima_modif_clave',
        'actualizoDP',
        'idprovincia',
        'idcanton',
        'idparroquia',
        'direccion2',
        'numerocasa',
        'idprovinciacasa',
        'idcantoncasa',
        'idparroquiacasa',
        'referenciacasa',
        'sectorcasa',
        'barriocasa',
        'viviendapropia',
        'padre',
        'madre',
        'conyuge',
        'nacionalidadetnia',
        'fechaingreso',
        'fechasalida',
        'hd_posicion',
        'tipoaccion',
        'denominacion',
        'area',
        'cargo',
    ];

    protected $casts = [
        'FechNacimPer' => 'date',
        'fechaingreso' => 'date',
        'fechasalida' => 'date',
        'ultima_actualizacion' => 'datetime',
        'fecha_reg' => 'datetime',
        'fecha_ultimo_acceso' => 'datetime',
        'fecha_ultima_modif' => 'datetime',
        'fecha_ultima_modif_clave' => 'datetime',
        'fotografia' => 'binary',
        'huella_dactilar' => 'binary',
    ];

    // Relaciones con otras tablas (ejemplo: carrera)
    public function carrera()
    {
        return $this->belongsTo(Carreras::class, 'idcarr', 'idCarr');
    }
}