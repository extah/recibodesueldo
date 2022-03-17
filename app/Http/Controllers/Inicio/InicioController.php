<?php

namespace App\Http\Controllers\Inicio;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Users;
use App\Password_resets;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Auth;
use DB;
use URL;
use Redirect; 


class InicioController extends Controller
{

	public function index(Request $request){

		// $id = $request->session->id;
		// $id = $request->session()->get('id');
		
		// dd($id);
		// dd($request);
		// session(['session'=>$usuario]);
	    $inicio = "";
		$esEmp = false;
		$cuix = "";
		$status_info = "";
	   
    	return view('inicio.inicio', compact('inicio', 'esEmp', 'status_info'));
    }

	public function olvidocontraseña(Type $var = null)
	{
		$token = $this->generar_token_seguro(30);
		$inicio = "";
		$esEmp = "";
		// return $this->generar_token_seguro(30);
		return view('auth.passwords.email', compact('inicio', 'esEmp', 'token'));
	}

	function generar_token_seguro($longitud)
	{
		if ($longitud < 4) {
			$longitud = 4;
		}
	
		return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
	}

	//post disparo email
	// public function recuperarcontraseña(Request $request)
	// {
	//     $inicio = "";
	// 	$esEmp = false;
	// 	$cuix = "";
	// 	$status_info = "";

	// 	$existe_usuario = Users::get_registro($request->email);
	// 	if (count($existe_usuario)) {
	// 		$resets = new Password_resets();
	// 		$resets->email = $request->email;
	// 		$resets->token = $request->_token;
	// 		$resets->save();


	// 		return $existe_usuario;
	// 	}
	// 	return "no existe";
	   
    // 	return view('inicio.inicio', compact('inicio', 'esEmp', 'status_info'));
	// }

	//Genero y envío el enlace para restaurar la clave
	public function recuperarcontraseña(Request $request)
	{
		//Validación de email
        $request->validate([
            'email' => 'required|email|exists:Users',
        ]);

        //Generación de token y almacenado en la tabla password_resets
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        //Envío de email al usuario
        Mail::send('email.email', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Cambiar contraseña en CMS Laravel');
        });
	}



}