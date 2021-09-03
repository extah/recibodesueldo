<?php

namespace App\Http\Controllers\Especialidades;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use DB;
use URL;
use Redirect; 


class EspecialidadesController extends Controller
{
    public function index(){
        
        $especialidades =  DB::select("SELECT especialidades.* FROM especialidades ORDER BY especialidades.id ASC");
        $medicos =  DB::select("SELECT medico.* FROM medico ORDER BY medico.id ASC");
        // dd($especialidades);
        $data = DB::select("SELECT turno_espec_medic.* FROM turno_espec_medic ORDER BY turno_espec_medic.id ASC");
        // return json_encode($data, JSON_UNESCAPED_UNICODE);
        // return datatables()->of($data)->toJson();
    	return view('especialidades.especialidades', compact('especialidades', 'medicos'));
    
    }
    public function turnosasignadosdatatable()
    {
        $data = DB::select("SELECT turno_espec_medic.* FROM turno_espec_medic ORDER BY turno_espec_medic.id ASC");
        // return json_encode($data, JSON_UNESCAPED_UNICODE);
        return datatables()->of($data)->toJson();
    }
}
