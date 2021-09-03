<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    //
    public function index(){

    	return view('laboratorio.laboratorio', compact());
    
    }
}
