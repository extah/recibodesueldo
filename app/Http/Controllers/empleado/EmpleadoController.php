<?php

namespace App\Http\Controllers\empleado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use PDFVillca;
use App\Recibos_originales;
use App\Users;
use Barryvdh\DomPDF\Facade as PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;
use setasign\FpdiProtection\FpdiProtection;

use DB;
// use Codedge\Fpdf\Fpdf;
use Fpdf;
// 'Fpdf' => Codedge\Fpdf\Facades\Fpdf::class,
// use setasign\Fpdi\Fpdi;
use setasign\Fpdi\Fpdi;

class EmpleadoController extends Controller
{
    //
    // private $fpdf;

    public function home(Request $request)
    {

        $inicio = "";
        $usuario = $request->email_inicio;
        $contrasena = $request->password_inicio;
        $no_hay_datos = false;
        $status_info = true;

        // $login[0] =  DB::select("SELECT * FROM users where email = '" . $usuario . "'" );
        $login = Users::get_registro($usuario);
        

        if($login->isEmpty())
		{
			$message = "usuario/contraseña ";
			$status_error = true;
            $status_ok = false;
            $esEmp = false;
			
			// return view('inicio.inicio', compact('inicio', 'message', 'status_error', 'esEmp'));
            return redirect('inicio')->with(['status_error' => $status_error, 'message' => $message,]);
		}
        else{
            
            $contrasenasql = $login[0]->contrasena;
            if(password_verify($contrasena, $contrasenasql))
            {
                $message = "Bienvenido/a ";
                $status_ok = true;
                $esEmp = true;

                // $request->session()->flush();
                // dd($login[0][0]->cuit);
                session(['usuario'=>$login[0]->cuit, 'nombre'=>$login[0]->nombreyApellido]);
                $nombre = $login[0]->nombreyApellido;
                $cuit = $login[0]->cuit;
                // $datos =  DB::select("SELECT DISTINCT apellido, tipo, nombre, cuil, mes, mes_nom, anio FROM recibos_originales where cuil = " . $usuario . " OR numero_documento = '" . $usuario . "'" . " ORDER BY anio, mes ASC");
                $datos =  DB::select("SELECT DISTINCT apellido, tipo, nombre, cuil, mes, mes_nom, anio FROM recibos_originales where cuil = '" . $cuit . "'". " ORDER BY anio, mes ASC");
                
                if(count( $datos) == 0)
                {
                    $no_hay_datos = true;
                }

                return view('empleado.empleado', compact('inicio', 'esEmp', 'login', 'datos', 'status_ok', 'message', 'no_hay_datos'));
                
            }
            else
            {
                $message = "usuario/contraseña ";
                $status_error = true;
                $status_ok = false;
                $esEmp = false;
                
                // return view('inicio.inicio', compact('inicio', 'message', 'status_error', 'esEmp'));
                return redirect('inicio')->with(['status_error' => $status_error, 'message' => $message,]);
                
            }
        }
    }

    public function indexget(Request $request)
    {
        //guardo el cuit
        $usuario = $request->session()->get('usuario');
        $nombre = $request->session()->get('nombre');
        $result = $this->isUsuario($usuario);

        if($result == "OK")
        {

            $no_hay_datos = false;
            $inicio = "";
            $esEmp = true;
            $status_ok = false;
            $message = "Bienvenido/a ";
            $datos =  DB::select("SELECT DISTINCT apellido, tipo, nombre, cuil, mes, mes_nom, anio FROM recibos_originales where cuil = " . $usuario . " OR numero_documento = " . $usuario . " ORDER BY anio, mes ASC");
            
            $login = Users::get_registro_cuit($usuario);

            if(count($datos) == 0)
            {
                $no_hay_datos = true;
            }
            return view('empleado.empleado', compact('inicio', 'esEmp', 'login', 'datos', 'status_ok', 'message', 'no_hay_datos'));
        }
        else
        {
			$message = "Inicie sesion";
			$status_error = false;
            $status_info = true;
            $esEmp = false;

            // return view('inicio.inicio', compact('status_error', 'esEmp', 'message', 'status_info'));
            return redirect('inicio')->with(['status_info' => $status_info, 'message' => $message,]);
        }
    }

    public function cerrarsesion(Request $request)
    {

        $id = session()->getId();

        $directory = 'C:\xampp\htdocs\recibodesueldo\storage\framework\sessions';
        $ignoreFiles = ['.gitignore', '.', '..'];
        $files = scandir($directory);
        
        foreach ($files as $file) {
            $var = $file;
            if($var == $id)
            {
                if(!in_array($file,$ignoreFiles)) unlink($directory . '/' . $file);
            }
            else {

            }
            // if(!in_array($file,$ignoreFiles)) unlink($directory . '/' . $file);
        }

        $usuario = $request->session()->get('usuario');
        $result = $this->isUsuario($usuario);

        if($result == "OK")
        {
            $request->session()->flush();
        }
        $inicio = "";    
        $esEmp = false;
        $status_error = false;
        $status_info = false;
        // return view('inicio.inicio', compact('inicio','status_error', 'esEmp', 'status_info'));
        return redirect('inicio');

    }

    public function registrarse(Request $request)
    {
        
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $email = $request->email;
        $cuit = $request->cuit;
        $dni = $request->dni;
        $contrasena = $request->password;
        $confirmpassword = $request->confirmpassword;

        if($nombre == null || $apellido == null || $email == null || $cuit == null || $dni == null || $contrasena == null || $confirmpassword  == null)
        {
			$message = "Para Registrarse, complete todos los datos del formulario";
			$status_error = true;
            $status_ok = false;
            $esEmp = false;
			
			// return view('inicio.inicio', compact('inicio', 'message', 'status_error', 'esEmp'));
            return redirect('inicio')->with(['status_info' => $status_error, 'message' => $message,]);
        }

        //validar con la tabla que exista el empleado en la tabla de usuarios con mail del municipio
        $existe =  DB::select("SELECT * FROM users where cuit = '" . $cuit . "' OR dni = '" . $dni . "' OR email = '" . $email . "';");
        
        if(count($existe) >= 1)
		{
			$message = "Usted ya posee una cuenta";
			$status_error = true;
            $status_ok = false;
            $esEmp = false;
			
            return redirect('inicio')->with(['status_info' => $status_error, 'message' => $message,]);
		}
        else {
            if ($contrasena == $confirmpassword) {
                $passhash = password_hash($contrasena, PASSWORD_DEFAULT);
                DB::insert("insert into users 
							(nombreyApellido, cuit, dni, contrasena)
							values('". $fullname . "', '". $cuit ."', '" . $numero_documento."', '" . $passhash ."')");

                            $message = "Cuentra creada con exito";
                            $status_error = true;
                            $status_ok = false;
                            $esEmp = false;

                            return redirect('inicio')->with(['status_info' => $status_error, 'message' => $message,]);
            }
            else {
                $message = "No coinciden las contraseñas";
                $status_error = true;
                $status_ok = false;
                $esEmp = false;
                
                return redirect('inicio')->with(['status_info' => $status_error, 'message' => $message,]);
            }
        }
    }

    public function buscarPorMes(Request $request)
    {

        $usuario = $request->session()->get('usuario');
        $nombre = $request->session()->get('nombre');

        $result = $this->isUsuario($usuario);
        $no_hay_datos = false;
        
        if($result == "OK")
        {
            $fecha_desde = $request->fecha_desde;
            $fecha_hasta = $request->fecha_hasta;

            // $mes_desde = substr($fecha_desde, 0, -5);
            // $anio_desde = substr($fecha_desde, 3);
            $anio_desde = $fecha_desde;
            $anio_hasta = $fecha_hasta;
            // $mes_hasta = substr($fecha_hasta, 0, -5);
            // $anio_hasta = substr($fecha_hasta, 3);

            // return $mes_desde;
            $inicio = "";
            $esEmp = true;
            $status_ok = false;
            $message = "";
           
            // $persona = DB::select("SELECT cuit, dni, nombreyApellido FROM users where cuit = " . $usuario . " OR dni = '" . $usuario . "'" );
            // $cuil = $persona[0]->cuit;
            // $nombre = $persona[0]->nombreyApellido;

            $datos =  DB::select("SELECT DISTINCT apellido, tipo, nombre, cuil, mes, mes_nom, anio FROM recibos_originales where cuil = " . $usuario . " AND anio BETWEEN $anio_desde AND $anio_hasta ORDER BY anio, mes ASC");
            $login = Users::get_registro_cuit($usuario);
            if(count( $datos) == 0)
            {
                $no_hay_datos = true;
            }
            return view('empleado.empleado', compact('esEmp', 'login','datos', 'status_ok', 'message', 'no_hay_datos'));
        }
        else
        {
            $message = "No coinciden las contraseñas";
            $status_error = true;
            $status_ok = false;
            $esEmp = false;
            return redirect('inicio')->with(['status_info' => $status_error, 'message' => $message,]);
        }
    }

    public function getBuscarPorMes(Request $request)
    {
        $usuario = $request->session()->get('usuario');
        $nombre = $request->session()->get('nombre');
        $result = $this->isUsuario($usuario);
        
        if($result == "OK")
        {

            $no_hay_datos = false;
            $inicio = "";
            $esEmp = true;
            $status_ok = false;
            $message = "Bienvenido/a ";
            $datos =  DB::select("SELECT DISTINCT apellido, tipo, nombre, cuil, mes, mes_nom, anio FROM recibos_originales where cuil = " . $usuario . " OR numero_documento = " . $usuario . " ORDER BY anio, mes ASC");
            $login = Users::get_registro_cuit($usuario);

            if(count($datos) == 0)
            {
                $no_hay_datos = true;
            }
            

            return view('empleado.empleado', compact('inicio', 'esEmp', 'login', 'datos', 'status_ok', 'message', 'no_hay_datos'));
        }
        else
        {
			$message = "Inicie sesion";
			$status_error = true;
            $status_ok = false;
            $esEmp = false;
			
            return redirect('inicio')->with(['status_info' => $status_error, 'message' => $message,]);
        }
    }
    public function descargarPDF($tipo, $mesParam, $anioParam, Request $request)
    {

        $usuario = $request->session()->get('usuario');
        
        $result = $this->isUsuario($usuario);
        
        if($result == "OK")
        {

            $datos =  DB::select("SELECT apellido, nombre, numero_documento, cuil, legajo, carrera, clase, dependencia, antiguedad, categoria, regimen_horario, planta, fecha_ingreso, fecha_reingreso, mes, mes_nom, anio, concepto, cantidad, descripcion, importe, dep FROM recibos_originales where cuil = $usuario and mes = $mesParam and anio = $anioParam and tipo = '" . $tipo . "' ORDER BY concepto ASC");
            
            // dd(count( $datos));
            if(count( $datos) == 0)
            {
                $message = "";
                $status_error = true;
                $status_ok = false;
                $esEmp = true;
                return redirect('empleado')->with(['status_info' => $status_error, 'message' => $message,]);
            }

            $apellido = $datos[0]->apellido;
            $nombre = $datos[0]->nombre;
            $numero_documento = $datos[0]->numero_documento;
            $cuil = $datos[0]->cuil;
            $mes = $datos[0]->mes;
            $mes_nom = $datos[0]->mes_nom;
            $anio = $datos[0]->anio;
            $dep = $datos[0]->dep;
            $legajo = $datos[0]->legajo;
            $dependencia = $datos[0]->dependencia;
            $antiguedad = $datos[0]->antiguedad;
            $categoria =  $datos[0]->categoria;
            $regimen_horario =  $datos[0]->regimen_horario;
            $planta = $datos[0]->planta;
            $fecha_ingreso = $datos[0]->fecha_ingreso;
            $fecha_reingreso = $datos[0]->fecha_reingreso;
            $carrera = $datos[0]->carrera;
            $clase = $datos[0]->clase;
            
            // $pdf = new FPDI();
            $pdf = new FpdiProtection();

            $pdfuserpass = '';
            // Mot de passe pour l'utilisateur final
            $pdfownerpass = NULL;
            $pdfrights = array('modify', 'copy');
            // Mot de passe du proprietaire, cree aleatoirement si pas defini
            $pdf->SetProtection($pdfrights, $pdfuserpass, $pdfownerpass);

            // $ownerPassword = $pdf->setProtection(
            //     FpdiProtection::PERM_PRINT | FpdiProtection::PERM_COPY,
            //     'berisso',
            //     'muni123'
            // );

            $pageCount = $pdf->setSourceFile('C:\xampp\htdocs\recibodesueldo\recibo.pdf', 'W'); 

            // import page 1 
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                // import a page
                $templateId = $pdf->importPage($pageNo);
                // get the size of the imported page
                $size = $pdf->getTemplateSize($templateId);
            
                // create a page (landscape or portrait depending on the imported page size)
                if ($size[0] > $size[1]) {
                    $pdf->AddPage('L', array($size[0], $size[1]));
                } else {
                    $pdf->AddPage('P', array($size[0], $size[1]));
                }
            
                // use the imported page
                $pdf->useTemplate($templateId);
                $pdf->SetFont('helvetica','',8);
                     
                // liquidacion correspondiente
                $pdf->SetXY(26, 14);
                $pdf->Write(8, $mes_nom . '/' . $anio);
                // nombre
                $pdf->SetXY(84, 14);
                $pdf->Write(8, $apellido . ' ' . $nombre);
                // legajo
                $pdf->SetXY(150, 14);
                $pdf->Write(8, $legajo);

                // fecha ingreso/reingreso
                $date=date_create($fecha_ingreso);
                $fecha_ingreso_formated = date_format($date,"d/m/Y");
                // dd($fecha_ingreso_formated);

                if(is_null($fecha_reingreso))
                {
                    $fecha_reingreso_formated = "*";
                }
                else {
                    $date=date_create($fecha_reingreso);
                    $fecha_reingreso_formated = date_format($date,"d/m/Y");
                }

                $pdf->SetXY(26, 23);
                $pdf->Write(8, $fecha_ingreso_formated . ' / ' . $fecha_reingreso_formated);

                // documento
                $pdf->SetXY(64, 23);
                $pdf->Write(8, $numero_documento);

                // dependencia
                $pdf->SetXY(93, 23);
                $pdf->Write(8, $dependencia);

                // antiguedad
                $pdf->SetXY(30, 31);
                $pdf->Write(8, $antiguedad);

                // categoria/regimen horario  categoria/carrera/ clase/regimen horario
                $pdf->SetXY(44, 31);
                $pdf->Write(8, $categoria . ' ' . $carrera . ' ' . $clase . ' ' . $regimen_horario . 'hs');

                // n° de cuil
                $pdf->SetXY(106, 31);
                $pdf->Write(8, $cuil);

                // planta
                $pdf->SetXY(140, 31);
                $pdf->Write(8, $planta);
             
               
                if(count($datos) > 0)
                {
                    $cantidad_datos = count($datos);

                    $xConcepto = 26;
                    $xHaberes_con_descuento = 120;
                    $xHaberes_sin_descuento = 146;
                    $xDescuentos = 171;
                    $y = 46;

                    $importe_Haberes_con_descuento = 0.00;
                    $importe_Haberes_sin_descuento = 0.00;
                    $importe_descuento = 0.00;

                    for ($i=0; $i < $cantidad_datos; $i++) { 
                        $concepto = $datos[$i]->concepto;
                        $descripcion = $datos[$i]->descripcion;
                        $importe = $datos[$i]->importe;
                        $cantidad = $datos[$i]->cantidad;

                        $pdf->SetXY($xConcepto, $y);
                        $pdf->Write(8, $concepto . '-' . utf8_decode($descripcion));

                        if ($concepto < 200) {
                            $importe_Haberes_con_descuento =  $importe_Haberes_con_descuento + $importe;

                            $myNumber = number_format($importe, 2, ',', '.'); // -> 5.678,90
                            $cantidad_hcd = strlen($myNumber);
                            // dd($myNumber);
                            if ($cantidad_hcd > 9) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -2.5;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 8) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -2;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 6) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -1.5;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 5) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -1.2;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 4) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -0.7;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }          
                        }
                        elseif ($concepto < 300) {
                            $importe_Haberes_sin_descuento = $importe_Haberes_sin_descuento + $importe;

                            $myNumber = number_format($importe, 2, ',', '.'); // -> 5.678,90
                            $cantidad_hsd = strlen($myNumber);
                            // dd($myNumber);
                            if ($cantidad_hsd > 9) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -2.5;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 8) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -2;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hsd > 6) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -1.5;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hsd > 5) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -1.2;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hsd > 4) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -0.7;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                        }
                        //mayores de 300 incluido
                        else {
                            
                            $importe_descuento = $importe_descuento + $importe;
 
                            $myNumber = number_format($importe, 2, ',', '.'); // -> 5.678,90
                            $cantidad_desc = strlen($myNumber);
                            // dd($myNumber);
                            if ($cantidad_desc > 9) {
                                $x_des = $xDescuentos - $cantidad_desc -2.5;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_desc > 8) {
                                $x_des = $xDescuentos - $cantidad_desc -2;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_desc > 6) {
                                $x_des = $xDescuentos - $cantidad_desc -1.5;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_desc > 5) {
                                $x_des = $xDescuentos - $cantidad_desc -1.2;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_desc > 4) {
                                $x_des = $xDescuentos - $cantidad_desc -0.7;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else {
                                $x_des = $xDescuentos - $cantidad_desc;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }

                            //cantidad
                            $cantidadDouble = number_format($cantidad, 2, ',', '.'); // -> 5.678,90
                            $cantidad_double = strlen($cantidadDouble);
                            $x_cantidad_double = 94;
                            if ($cantidad_double > 9) {
                                $x_cant = $x_cantidad_double - $cantidad_double -2.5;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else if ($cantidad_double > 8) {
                                $x_cant = $x_cantidad_double - $cantidad_double -2;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else if ($cantidad_double > 6) {
                                $x_cant = $x_cantidad_double - $cantidad_double -1.5;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else if ($cantidad_double > 5) {
                                $x_cant = $x_cantidad_double - $cantidad_double -1.2;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else if ($cantidad_double > 4) {
                                $x_cant = $x_cantidad_double - $cantidad_double -0.7;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else {
                                $x_cant = $x_cantidad_double - $cantidad_double;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                        }
                        $y = $y + 4;
                    }

                }
                $pdf->SetXY(35, 176);
                $pdf->Write(8, number_format($importe_Haberes_con_descuento, 2, ',', '.'));
                
                $pdf->SetXY(73, 176);
                $pdf->Write(8, number_format($importe_Haberes_sin_descuento, 2, ',', '.'));

                $pdf->SetXY(112, 176);
                $pdf->Write(8, number_format($importe_descuento, 2, ',', '.'));
                // $pdf->Write(8, number_format($importe_descuento, 2, '.', ','));

                $importe_neto = ($importe_Haberes_con_descuento + $importe_Haberes_sin_descuento) - $importe_descuento;

                $pdf->SetXY(150, 176);
                $pdf->Write(8, number_format($importe_neto, 2, ',', '.'));

                //lugar de pago
                $pdf->SetXY(60, 188);
                $pdf->Write(8, $dep);

                // final de pdf, fecha y hora actual
                $ldate = date('Y-m-d H:i:s');
                        
                $pdf->SetXY(64, 231);
                $pdf->Write(8, 'Emitido con Fecha : ' . $ldate);
                $pdf->Output($cuil . '_recibo_' . $mes_nom . '_'. $anio . '.pdf', 'D');
                // $pdf->Output('recibo_generated.pdf', 'D');
                
            }
        }
        else
        {
            $inicio = ""; 
            $status_error = false;
            $esEmp = false;

            return view('inicio.inicio', compact('inicio','status_error', 'esEmp'));
        }

    }
    public function mostrarPDF($tipo, $mesParam, $anioParam, Request $request)
    {
        $usuario = $request->session()->get('usuario');
        
        $result = $this->isUsuario($usuario);
        
        if($result == "OK")
        {

            $datos =  DB::select("SELECT apellido, nombre, numero_documento, cuil, legajo, carrera, clase, dependencia, antiguedad, categoria, regimen_horario, planta, fecha_ingreso, fecha_reingreso, mes, mes_nom, anio, concepto, cantidad, descripcion, importe, dep FROM recibos_originales where cuil = $usuario and mes = $mesParam and anio = $anioParam and tipo = '" . $tipo . "' ORDER BY concepto ASC");
            
            // dd(count( $datos));
            if(count( $datos) == 0)
            {
                $message = "";
                $status_error = true;
                $status_ok = false;
                $esEmp = true;
                return redirect('empleado')->with(['status_info' => $status_error, 'message' => $message,]);
            }

            $apellido = $datos[0]->apellido;
            $nombre = $datos[0]->nombre;
            $numero_documento = $datos[0]->numero_documento;
            $cuil = $datos[0]->cuil;
            $mes = $datos[0]->mes;
            $mes_nom = $datos[0]->mes_nom;
            $anio = $datos[0]->anio;
            $dep = $datos[0]->dep;
            $legajo = $datos[0]->legajo;
            $dependencia = $datos[0]->dependencia;
            $antiguedad = $datos[0]->antiguedad;
            $categoria =  $datos[0]->categoria;
            $regimen_horario =  $datos[0]->regimen_horario;
            $planta = $datos[0]->planta;
            $fecha_ingreso = $datos[0]->fecha_ingreso;
            $fecha_reingreso = $datos[0]->fecha_reingreso;
            $carrera = $datos[0]->carrera;
            $clase = $datos[0]->clase;
            
            // $pdf = new FPDI();
            $pdf = new FpdiProtection();

            $pdfuserpass = '';
            // Mot de passe pour l'utilisateur final
            $pdfownerpass = NULL;
            $pdfrights = array('modify', 'copy');
            // Mot de passe du proprietaire, cree aleatoirement si pas defini
            $pdf->SetProtection($pdfrights, $pdfuserpass, $pdfownerpass);
            
            $pageCount = $pdf->setSourceFile('C:\xampp\htdocs\recibodesueldo\recibo.pdf', 'W'); 
            // import page 1 
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                // import a page
                $templateId = $pdf->importPage($pageNo);
                // get the size of the imported page
                $size = $pdf->getTemplateSize($templateId);
            
                // create a page (landscape or portrait depending on the imported page size)
                if ($size[0] > $size[1]) {
                    $pdf->AddPage('L', array($size[0], $size[1]));
                } else {
                    $pdf->AddPage('P', array($size[0], $size[1]));
                }
            
                // use the imported page
                $pdf->useTemplate($templateId);
                $pdf->SetFont('helvetica','',8);
                     
                // liquidacion correspondiente
                $pdf->SetXY(26, 14);
                $pdf->Write(8, $mes_nom . '/' . $anio);
                // nombre
                $pdf->SetXY(84, 14);
                $pdf->Write(8, $apellido . ' ' . $nombre);
                // legajo
                $pdf->SetXY(150, 14);
                $pdf->Write(8, $legajo);

                // fecha ingreso/reingreso
                $date=date_create($fecha_ingreso);
                $fecha_ingreso_formated = date_format($date,"d/m/Y");
                // dd($fecha_ingreso_formated);

                if(is_null($fecha_reingreso))
                {
                    $fecha_reingreso_formated = "*";
                }
                else {
                    $date=date_create($fecha_reingreso);
                    $fecha_reingreso_formated = date_format($date,"d/m/Y");
                }

                $pdf->SetXY(26, 23);
                $pdf->Write(8, $fecha_ingreso_formated . ' / ' . $fecha_reingreso_formated);

                // documento
                $pdf->SetXY(64, 23);
                $pdf->Write(8, $numero_documento);

                // dependencia
                $pdf->SetXY(93, 23);
                $pdf->Write(8, $dependencia);

                // antiguedad
                $pdf->SetXY(30, 31);
                $pdf->Write(8, $antiguedad);

                // categoria/regimen horario  categoria/carrera/ clase/regimen horario
                $pdf->SetXY(44, 31);
                $pdf->Write(8, $categoria . ' ' . $carrera . ' ' . $clase . ' ' . $regimen_horario . 'hs');

                // n° de cuil
                $pdf->SetXY(106, 31);
                $pdf->Write(8, $cuil);

                // planta
                $pdf->SetXY(140, 31);
                $pdf->Write(8, $planta);
               
                if(count($datos) > 0)
                {
                    $cantidad_datos = count($datos);

                    $xConcepto = 26;
                    $xHaberes_con_descuento = 120;
                    $xHaberes_sin_descuento = 146;
                    $xDescuentos = 171;
                    $y = 46;

                    $importe_Haberes_con_descuento = 0.00;
                    $importe_Haberes_sin_descuento = 0.00;
                    $importe_descuento = 0.00;

                    for ($i=0; $i < $cantidad_datos; $i++) { 
                        $concepto = $datos[$i]->concepto;
                        $descripcion = $datos[$i]->descripcion;
                        $importe = $datos[$i]->importe;
                        $cantidad = $datos[$i]->cantidad;

                        $pdf->SetXY($xConcepto, $y);
                        $pdf->Write(8, $concepto . '-' . utf8_decode($descripcion));

                        if ($concepto < 200) {
                            $importe_Haberes_con_descuento =  $importe_Haberes_con_descuento + $importe;

                            $myNumber = number_format($importe, 2, ',', '.'); // -> 5.678,90
                            $cantidad_hcd = strlen($myNumber);
                            // dd($myNumber);
                            if ($cantidad_hcd > 9) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -2.5;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 8) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -2;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 6) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -1.5;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 5) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -1.2;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 4) {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd -0.7;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else {
                                $x_hcd = $xHaberes_con_descuento - $cantidad_hcd;
                                $pdf->SetXY($x_hcd, $y);
                                $pdf->Write(8, $myNumber);
                            }          
                        }
                        elseif ($concepto < 300) {
                            $importe_Haberes_sin_descuento = $importe_Haberes_sin_descuento + $importe;

                            $myNumber = number_format($importe, 2, ',', '.'); // -> 5.678,90
                            $cantidad_hsd = strlen($myNumber);
                            // dd($myNumber);
                            if ($cantidad_hsd > 9) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -2.5;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hcd > 8) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -2;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hsd > 6) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -1.5;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hsd > 5) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -1.2;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_hsd > 4) {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd -0.7;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else {
                                $x_hsd = $xHaberes_sin_descuento - $cantidad_hsd;
                                $pdf->SetXY($x_hsd, $y);
                                $pdf->Write(8, $myNumber);
                            }
                        }
                        //mayores de 300 incluido
                        else {
                            
                            $importe_descuento = $importe_descuento + $importe;
 
                            $myNumber = number_format($importe, 2, ',', '.'); // -> 5.678,90
                            $cantidad_desc = strlen($myNumber);
                            // dd($myNumber);
                            if ($cantidad_desc > 9) {
                                $x_des = $xDescuentos - $cantidad_desc -2.5;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_desc > 8) {
                                $x_des = $xDescuentos - $cantidad_desc -2;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_desc > 6) {
                                $x_des = $xDescuentos - $cantidad_desc -1.5;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_desc > 5) {
                                $x_des = $xDescuentos - $cantidad_desc -1.2;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else if ($cantidad_desc > 4) {
                                $x_des = $xDescuentos - $cantidad_desc -0.7;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }
                            else {
                                $x_des = $xDescuentos - $cantidad_desc;
                                $pdf->SetXY($x_des, $y);
                                $pdf->Write(8, $myNumber);
                            }

                            //cantidad
                            $cantidadDouble = number_format($cantidad, 2, ',', '.'); // -> 5.678,90
                            $cantidad_double = strlen($cantidadDouble);
                            $x_cantidad_double = 94;
                            if ($cantidad_double > 9) {
                                $x_cant = $x_cantidad_double - $cantidad_double -2.5;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else if ($cantidad_double > 8) {
                                $x_cant = $x_cantidad_double - $cantidad_double -2;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else if ($cantidad_double > 6) {
                                $x_cant = $x_cantidad_double - $cantidad_double -1.5;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else if ($cantidad_double > 5) {
                                $x_cant = $x_cantidad_double - $cantidad_double -1.2;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else if ($cantidad_double > 4) {
                                $x_cant = $x_cantidad_double - $cantidad_double -0.7;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                            else {
                                $x_cant = $x_cantidad_double - $cantidad_double;
                                $pdf->SetXY($x_cant, $y);
                                $pdf->Write(8, $cantidadDouble);
                            }
                        }
                        $y = $y + 4;
                    }

                }
                $pdf->SetXY(35, 176);
                $pdf->Write(8, number_format($importe_Haberes_con_descuento, 2, ',', '.'));
                
                $pdf->SetXY(73, 176);
                $pdf->Write(8, number_format($importe_Haberes_sin_descuento, 2, ',', '.'));

                $pdf->SetXY(112, 176);
                $pdf->Write(8, number_format($importe_descuento, 2, ',', '.'));
                // $pdf->Write(8, number_format($importe_descuento, 2, '.', ','));

                $importe_neto = ($importe_Haberes_con_descuento + $importe_Haberes_sin_descuento) - $importe_descuento;

                $pdf->SetXY(150, 176);
                $pdf->Write(8, number_format($importe_neto, 2, ',', '.'));

                //lugar de pago
                $pdf->SetXY(60, 188);
                $pdf->Write(8, $dep);

                // final de pdf, fecha y hora actual
                $ldate = date('Y-m-d H:i:s');
                        
                $pdf->SetXY(64, 231);
                $pdf->Write(8, 'Emitido con Fecha : ' . $ldate);
               
                $pdf->Output($cuil . '_recibo_' . $mes_nom . '_'. $anio . '_' . $cuil . '.pdf', 'I');

                // $pdf->Output('recibo_generated.pdf', 'D');
            }
        }
        else
        {
            $message = "La sesión se cerró automáticamente";
            $status_info = true;
            $status_ok = false;
            $esEmp = false;
            return redirect('inicio')->with(['status_info' => $status_info, 'message' => $message,]);
        }    

    }

    public function insertar_datos_recibo(Request $request){
        //obtener el id de la persona logueada
        // !session('cuix')
        $usuario = $request->session()->get('usuario');
	    $name = $request->archivo->getClientOriginalName();
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        
        if ($extension == 'xlsx') {
            $tmpfName = $_FILES['archivo']['tmp_name'];
            //Crear excel para leerlo
            $leerExcel = IOFactory::createReaderForFile($tmpfName);
            //Cargar el excel
            $excelObj = $leerExcel->load($tmpfName);

            //Cargar en que hoja trabajar
            $hoja = $excelObj->getSheet(0);
            $filas = $hoja->getHighestRow();

            for ($i = 2; $i <= $filas; $i++) {

                $id_fila = $i;
                
                $recibos = new Recibos_originales();

                $recibos->apellido = $hoja->getCell('A' . $i)->getValue();
                $recibos->nombre = $hoja->getCell('B' . $i)->getValue();
                $recibos->legajo = $hoja->getCell('C' . $i)->getValue();

                //pasar de datetime a date
                $datetime = $hoja->getCell('D' . $i)->getValue();
                $date =  date("Y-m-d", strtotime($datetime));
                $recibos->fecha_ingreso = $date;
                

                $fecha_reingreso = $hoja->getCell('E' . $i)->getValue();
                
                if ($fecha_reingreso != "NULL") {
                    $date =  date("Y-m-d", strtotime($fecha_reingreso));
                    $recibos->fecha_reingreso =  $date;
                }

                $recibos->tipo_documento = $hoja->getCell('F' . $i)->getValue(); 
                $recibos->numero_documento = $hoja->getCell('G' . $i)->getValue();
                $recibos->dependencia = $hoja->getCell('H' . $i)->getValue();
                $recibos->antiguedad = $hoja->getCell('I' . $i)->getValue();
                $recibos->categoria = $hoja->getCell('J' . $i)->getValue();
                $recibos->carrera = $hoja->getCell('K' . $i)->getValue();
                $recibos->clase = $hoja->getCell('L' . $i)->getValue();
                $recibos->regimen_horario = $hoja->getCell('M' . $i)->getValue();
                $recibos->cuil = $hoja->getCell('N' . $i)->getValue();
                $recibos->planta = $hoja->getCell('O' . $i)->getValue();
                $recibos->dep = $hoja->getCell('P' . $i)->getValue();
                $recibos->mes = $hoja->getCell('Q' . $i)->getValue();
                $recibos->mes_nom = $hoja->getCell('R' . $i)->getValue();
                $recibos->anio = $hoja->getCell('S' . $i)->getValue();
                $recibos->tipo = $hoja->getCell('T' . $i)->getValue();
                $recibos->total_haberes = $hoja->getCell('U' . $i)->getValue();
                $recibos->total_hasindto = $hoja->getCell('V' . $i)->getValue();
                $recibos->total_dto = $hoja->getCell('W' . $i)->getValue();
                $recibos->concepto = $hoja->getCell('X' . $i)->getValue();
                $recibos->cantidad = $hoja->getCell('Y' . $i)->getValue();
                $recibos->descripcion = $hoja->getCell('Z' . $i)->getValue();
                $recibos->importe = $hoja->getCell('AA' . $i)->getValue();
                
                $recibos->save();
                // return "OK";

            }

        } elseif ($extension == 'csv') {
            //dd($name);


            // $archivofp = fopen($_FILES['file']['tmp_name'], "r");
            // $linea = 0;
            // $i = 1;
            // while (($datos = fgetcsv($archivofp, ",")) == true) {
            //     $num = count($datos);

            //     //Recorremos las columnas de esa linea
            //     if ($linea != 0) {

            //         $campaniaId = $idCampania;
            //         $internoId = $idInterno; //BUSCAR DATO DE LA PERSONA LOGUEADA
            //         $id_lote = $i;
            //         $nombreP = $datos[0];
            //         $destinatario_cuix = $datos[1];
            //         $destinatario_nombre = $datos[2];
            //         $destinatario_apellido = $datos[3];
            //         $archivo = $datos[4];
            //         $fechaDisp = $datos[5]; //validar que sea mayor o igual a la actual
            //         $notificado_de_oficio = false;
            //         $carga_batch = true;
                    
            //         //LLAMAR A LA FUNCION insertarPieza
            //         $result = $this->insertarPiezaExcel($datosExcel);
                    
            //     }

            //     $linea++;
            //     $i++;
            // }
            //Cerramos el archivo
            // fclose($archivofp);

            //  echo "Archivo recorrido";
            
        }

        $message = "EXCEL CARGADO CON EXITO";
        $status_ok = true;
        $esEmp = true;
        $no_hay_datos = false;
        
        $datos =  DB::select("SELECT DISTINCT apellido, tipo, nombre, cuil, mes, mes_nom, anio FROM recibos_originales where cuil = '" . $usuario . "'". " ORDER BY anio, mes ASC");
        $login = Users::get_registro_cuit($usuario);

        if(count( $datos) == 0)
        {
            $no_hay_datos = true;
        }

        // return redirect('empleado/agregarrecibos')->with(['esEmp' => $esEmp, 'login' => $login,'datos' => $datos,'status_ok' => $status_ok,'message' => $message,'no_hay_datos' => $no_hay_datos,]);
        return view('empleado.agregarrecibos', compact('esEmp', 'login', 'status_ok', 'message', 'no_hay_datos'));
    }
    public function agregarrecibos(Request $request)
    {
        $usuario = $request->session()->get('usuario');
        $nombre = $request->session()->get('nombre');
        $result = $this->isUsuario($usuario);

        if($result == "OK")
        {

            $no_hay_datos = false;
            $inicio = "";
            $esEmp = true;
            $status_ok = false;
            $login = Users::get_registro_cuit($usuario);
            if($login[0]->admin)
            {
                return view('empleado.agregarrecibos', compact('inicio', 'esEmp', 'login', 'status_ok', 'no_hay_datos'));
            }
            else
            {
                $message = "Bienvenido/a";
                $status_ok = true;
                $esEmp = true;
                $no_hay_datos = false;
                
                $datos =  DB::select("SELECT DISTINCT apellido, tipo, nombre, cuil, mes, mes_nom, anio FROM recibos_originales where cuil = '" . $usuario . "'". " ORDER BY anio, mes ASC");
                
                if(count( $datos) == 0)
                {
                    $no_hay_datos = true;
                }

                return redirect('empleado')->with(['esEmp' => $esEmp, 'login' => $login,'datos' => $datos,'status_ok' => $status_ok,'message' => $message,'no_hay_datos' => $no_hay_datos,]);
            }
           
        }
        else
        {
			$message = "Inicie sesion";
			$status_error = false;
            $status_info = true;
            $esEmp = false;

            // return view('inicio.inicio', compact('status_error', 'esEmp', 'message', 'status_info'));
            return redirect('inicio')->with(['status_info' => $status_info, 'message' => $message,]);
        }
    }

    function isUsuario($usuario)
    {
        # code...
        // return "OK";
        if($usuario == null)
        {
            return "FALSE";
            // $inicio = ""; 
            // $status_error = false;
            // $esEmp = false;

            // return view('inicio.inicio', compact('inicio','status_error', 'esEmp'));
        }
 
        return "OK";

    }
}
