<?php

namespace App\Http\Controllers\Cooperativa;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CooperativaController extends Controller
{
    public function index(){

    	return view('cooperativa.cooperativa');
    
    }
}
