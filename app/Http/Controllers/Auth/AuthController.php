<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Users;
use App\Password_resets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Mail;
use App\Mail\SendDemoMail;

class AuthController extends Controller
{
    //Muestra la vista de acceso o login
    public function acceder()
    {
        return view('auth.inicio');
    }

    //Autentica al usuario
    public function autenticar(Request $request)
    {
        //Validación de datos (incluyendo la de activo)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'contraseña' => ['required']
        ]);
        $credentials['activo'] = 1;

        //Si es correcto, inicio sesión y login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin')->with('success','Bienvenido al panel de Administración');
        }

        //Si no, muestro mensaje de error
        return back()->withErrors([
            'email' => 'El email no está registrado.',
        ]);
    }

    //Muestra la vista de registro
    public function registro()
    {
        return view('auth.registro');
    }

    //Registra al usuario
    public function registrarse(Request $request)
    {
        //Validación y recopilación de datos
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:Users',
            'contraseña' => 'required|confirmed|min:6',
        ]);
        $data = $request->all();

        //Creación de nuevo usuario
        $usuario = Usuario::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'contraseña' => Hash::make($data['contraseña'])
        ]);

        //Login de usuario
        Auth::login($usuario);

        //Redirección
        return redirect("admin")->with('success','Te has registrado correctamente. Bienvenido');
    }

    //Salir del panel de administración
    public function salir(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('acceder')->with('success','Hasta pronto');
    }

    //Muestro el formulario para introducir el email
    public function email()
    {
        return view('auth.email');
    }

    //Genero y envío el enlace para restaurar la clave
    public function enlace(Request $request)
    {
        //Validación de email
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        //Generación de token y almacenado en la tabla contraseña_resets
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        //Envío de email al usuario
        // Mail::send('emails.users.confirmation', ['token' => $token], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Reinicio de contraseña');
            
        // });

        $email = $request->email;
   
        $maildata = [
            'title' => 'Reinicio de la clave',
            'url' => 'http://localhost/recibodesueldo/public/clave/' . $token
        ];
  
        Mail::to($email)->send(new SendDemoMail($maildata));
   
        // dd("Mail ha sido enviado con exito");
        

        //Retorno
        $inicio = "";
		$esEmp = false;
		$cuix = "";
		$status_info = "";
	   
    	return view('auth.verify', compact('inicio', 'esEmp', 'status_info'));

    }

    //Muestro el formulario para cambiar la clave
    public function clave($token)
    {
        // return $token;
        $esEmp = false;
        $contraseña_resets = Password_resets::get_registro_token($token);
        $email = "";
        if (count($contraseña_resets) > 0) {
            $email = $contraseña_resets[0]->email;
        }
        // return $email;
        return view('auth.passwords.reset', compact('esEmp', 'token', 'email'));
        // return view('empleado.agregarrecibos', compact('esEmp', 'login', 'status_ok', 'message', 'no_hay_datos'));
    }

    //cambio la clave
    public function cambiar(Request $request)
    {
        //Valido datos
        $request->validate([
            'email' => 'required|email|exists:Users',
            'contraseña' => 'required|min:8|max:16|confirmed',
            'contraseña_confirmation' => 'required'
        ]);

        //Compruebo token válido
        $comprobarToken = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        if(!$comprobarToken){
            return back()->withInput()->with('danger','El enlace no es válido');
        }

        //Actualizo contraseña
        Users::where('email', $request->email)->update(['contrasena' => Hash::make($request->contraseña)]);

        //Borro token para que no se pueda volver a usar
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        //Retorno
        $esEmp = false;
        $email = $request->email;
        $message = "Contraseña cambiada con éxito";
        $status_info = true;
        $status_ok = false;
        $esEmp = false;

        // return view('inicio.inicio', compact('message', 'status_info', 'esEmp','email'));
        return redirect('inicio')->with(['esEmp' => $esEmp, 'email' => $email,'status_info' => $status_info, 'message' => $message,]);

    }

}