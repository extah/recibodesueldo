<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibos_originales extends Model
{
    protected $fillable = [
        'apellido', 'nombre', 'legajo', 'fecha_ingreso','fecha_reingreso','tipo_documento','numero_documento','dependencia','antiguedad','categoria',
        'carrera','clase','regimen_horario','cuil','planta','dep','mes','mes_nom','anio','tipo','total_haberes','total_hasindto','total_dto','concepto',
        'cantidad','descripcion','importe',
    ];
    public $timestamps  = true;

     // metodos

     public static function get_registro($cuil)
     {
        //  $row = self::find($id_etapas);
         $row = Recibos_originales::where('cuil', '=', $cuil)->get();
         return $row;       
     }
}
