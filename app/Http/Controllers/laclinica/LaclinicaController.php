<?php

namespace App\Http\Controllers\Laclinica;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LaclinicaController extends Controller
{
    public function index(){

    	return view('la-clinica.la-clinica');
    
    }
}
