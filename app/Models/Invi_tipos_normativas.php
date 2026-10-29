<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invi_tipos_normativas extends Model
{
    protected $table = 'invi_tipos_normativas';
    protected $primaryKey = 'id_tipo_normativa';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
       'nombre_tipo',
        'estado'

    ];
    public function normativas()
    {
        return $this->hasMany(Invi_Normativa::class, 'id_tipo_normativa', 'id_tipo_normativa');
    } 

}
