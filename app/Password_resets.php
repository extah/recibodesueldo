<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password_resets extends Model
{
    //get_registro_token
    protected $fillable = [
        'email', 'token',
    ];

    public static function get_registro_token($token)
    {
       //  $row = self::find($id_etapas);
        $row = Password_resets::where('token', '=', $token)->get();
        return $row;       
    }
}
