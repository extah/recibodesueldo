<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    //
    protected $table = 'medico';
    protected $primaryKey = 'id';
    
    protected $fillable = ['id', 'numero_matricula', 'nombre', 'apellido', 'fecha_nacimiento', 'dni', 'cuit', 'telefono', 'email'];
    
    public $timestamps  = false;
}
