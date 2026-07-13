<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_proyectos extends Model
{
    protected $table = 'invi_proyectos';
    protected $primaryKey = 'proyect_id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'proyect_cod',
        'proyect_nombre',
        'proyect_titulo',
        'proyect_nombre_en',
        'proyect_titulo_en',
        'proyect_multidis',
        'fechainicio',
        'fechafin',
        'proyect_tipo',
        'id_convocatoria',
        'id_tip_invi_proy',
        'proyect_cobertura',
    ];
    public function invi_detalle_integrante()
    {
        return $this->hasMany(Invi_deta_inte::class, 'proyect_id');
    }
    public function invi_detalle_fac_proy()
    {
        return $this->hasMany(Invi_detalle_fac_proy::class, 'proyect_id');
    }
    public function invi_detalle_obj_pro_pei()
    {
        return $this->hasMany(Invi_detalle_obj_pei::class, 'proyect_id');
    }
    public function invi_detalle_obj_pol_proyect()
    {
        return $this->hasMany(Invi_detalle_obj_pol_proyect::class, 'proyect_id');
    }
    public function invi_detalle_ods_proyect()
    {
        return $this->hasMany(Invi_detalle_ods_proyect::class, 'proyect_id');
    }
    public function invi_detalle_carr_proy()
    {
        return $this->hasMany(Invi_detalle_carr_proy::class, 'proyect_id');
    }
    public function invi_detalle_dom_hum()
    {
        return $this->hasMany(Invi_detalle_dom_hum::class, 'proyect_id');
    }
    public function invi_convocatoria()
    {
        return $this->hasOne(Invi_convocatoria::class, 'id_convocatoria');
    }
    public function invi_detalle_lin_inves()
    {
        return $this->hasMany(Invi_detalle_lin_inves::class, 'proyect_id');
    }
    public function invi_detalle_area_unesco()
    {
        return $this->hasMany(Invi_detalle_area_unesco::class, 'proyect_id');
    }
    public function invi_tip_proyectos()
    {
        return $this->hasOne(Invi_tip_proyect::class, 'id_tip_invi_proy');
    }
    public function invi_detalle_cobe()
    {
        return $this->hasMany(Invi_detalle_cobe::class, 'proyect_id');
    }
    public function invi_obj_proyectos()
    {
        return $this->hasMany(Invi_Obj_Proy::class, 'proyect_id');
    }
}