<?php

namespace App\Http\Controllers\empleado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class EmpleadoController extends Controller
{
    //
    public function index(Request $request)
    {

        $inicio = "";
        $esEmp = true;
        $nombre = "Emmanuel Baleztena";
        $cuix = "20367384515";
        $datos =  DB::select("SELECT DISTINCT apellido, nombre, cuil, mes, mes_nom, anio, concepto FROM recibos where cuil = $cuix ORDER BY id ASC");
        // dd( $datos);
        // $datos = [
        //     ['dow' => 1, 'mes' => 'Enero', 'anio' => '2021', 'nombre' => 'Emmanuel Baleztena'],
        //     ['dow' => 2, 'mes' => 'Febrero', 'anio' => '2021', 'nombre' => 'Emmanuel Baleztena'],
        //     ['dow' => 3, 'mes' => 'Marzo', 'anio' => '2021', 'nombre' => 'Emmanuel Baleztena'],
        //     ['dow' => 4, 'mes' => 'Abril', 'anio' => '2021', 'nombre' => 'Emmanuel Baleztena'],
        //     ['dow' => 5, 'mes' => 'Mayo', 'anio' => '2021', 'nombre' => 'Emmanuel Baleztena'],
        //     ['dow' => 6, 'mes' => 'Junio', 'anio' => '2021', 'nombre' => 'Emmanuel Baleztena'],
        //     ['dow' => 7, 'mes' => 'Julio', 'anio' => '2021', 'nombre' => 'Emmanuel Baleztena'],
        // ];
        //    dd($nombre);
        return view('empleado.empleado', compact('inicio', 'esEmp', 'nombre', 'cuix', 'datos'));
    }
    public function buscarPorMes(Request $request)
    {
        # code...
        $fecha_desde = $request->fecha_desde;
        $fecha_hasta = $request->fecha_hasta;

        $mes_desde = substr($fecha_desde, 0, -5);
        $anio_desde = substr($fecha_desde, 3);

        $mes_hasta = substr($fecha_hasta, 0, -5);
        $anio_hasta = substr($fecha_hasta, 3);

        // dd($anio);

        $inicio = "";
        $esEmp = true;
        $nombre = "Emmanuel Baleztena";
        $cuix = "20367384515";
        $datos =  DB::select("SELECT DISTINCT apellido, nombre, cuil, mes, mes_nom, anio, concepto FROM recibos where cuil = $cuix and mes BETWEEN $mes_desde AND $mes_hasta ORDER BY id ASC");
        
        return view('empleado.empleado', compact('inicio', 'esEmp', 'nombre', 'cuix', 'datos'));
    }


    public function descargarPDF()
    {
        # code...
        $filename = 'recibo.pdf';
        return response()->download(storage_path('app\public\pdf\\' . $filename));
    }
    public function mostrarPDF()
    {
        # code...
        $filename = 'recibo.pdf';
        return response()->file(storage_path('app\public\pdf\\' . $filename));
    }
}
