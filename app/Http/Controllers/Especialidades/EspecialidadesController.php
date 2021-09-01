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

    	return view('especialidades.especialidades', compact('especialidades', 'medicos'));
    
    }
}
