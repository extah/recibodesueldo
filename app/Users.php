<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
        //
        protected $fillable = [
            'nombreyApellido', 'email', 'cuit', 'dni','contrasena', 'admin',
        ];
    
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'contrasena', 'remember_token',
        ];

        public static function get_registro($email)
        {
           //  $row = self::find($id_etapas);
            $row = Users::where('email', '=', $email)->get();
            return $row;       
        }
        public static function get_registro_cuit($cuit)
        {
           //  $row = self::find($id_etapas);
            $row = Users::where('cuit', '=', $cuit)->get();
            return $row;       
        }

        
}
