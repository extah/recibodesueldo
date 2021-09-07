<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
        //
        protected $fillable = [
            'nombreyApellido', 'email', 'telefono','dni', 'contrasena', 'fecha_nacimiento',
        ];
    
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'contrasena', 'remember_token',
        ];
}
