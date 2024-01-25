<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Persona extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
       'primer_nombre',
       'segundo_nombre',
       'tercer_nombre',
       'primer_apellido',
       'segundo_apellido',
       'apellido_casada',
       'nombre_completo',
       'foto',
       'telefono',
    ];

    public function getNombreCompletoAttribute()
    {
        return "{$this['primer_nombre']} {$this['primer_apellido']}";
    }
}
