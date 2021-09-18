<?php

namespace App\Http\Controllers\empleado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use PDFVillca;
use Barryvdh\DomPDF\Facade as PDF;

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
        $usuario = $request->username;
        $contrasena = $request->password;
        $no_hay_datos = false;
        $status_info = true;

        $login =  DB::select("SELECT * FROM users where cuit = '" . $usuario . "' OR dni = '" . $usuario . "'" );

        if(count($login) == 0)
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
                // dd($login[0]->cuit);
                session(['usuario'=>$login[0]->cuit, 'nombre'=>$login[0]->nombreyApellido]);
                $nombre = $login[0]->nombreyApellido;

                $datos =  DB::select("SELECT DISTINCT apellido, tipo, tipo_detalle, nombre, cuil, mes, mes_nom, anio FROM recibos where cuil = " . $usuario . " OR numero_documento = '" . $usuario . "'" . " ORDER BY anio, mes ASC");
                
                if(count( $datos) == 0)
                {
                    $no_hay_datos = true;
                }
                return view('empleado.empleado', compact('inicio', 'esEmp', 'nombre', 'usuario', 'datos', 'status_ok', 'message', 'no_hay_datos'));
            }
            else
            {
                $message = "usuario/contraseña ";
                $status_error = true;
                $status_info = false;
                $esEmp = false;

                // return redirect('inicio')->with(['status_error' => $status_error, 'message' => $message,]);

                return view('inicio.inicio', compact('status_error', 'esEmp', 'message', 'status_info'));
            }
        }
    }

    public function indexget(Request $request)
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
            $datos =  DB::select("SELECT DISTINCT apellido, tipo, tipo_detalle, nombre, cuil, mes, mes_nom, anio FROM recibos where cuil = " . $usuario . " OR numero_documento = " . $usuario . " ORDER BY anio, mes ASC");
            
            if(count($datos) == 0)
            {
                $no_hay_datos = true;
            }
            return view('empleado.empleado', compact('inicio', 'esEmp', 'nombre', 'usuario', 'datos', 'status_ok', 'message', 'no_hay_datos'));
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
        $cuit = $request->cuit;
        $fullname = $request->fullname;
        $numero_documento = $request->numero_documento;
        $contrasena = $request->password;
        $confirmpassword = $request->confirmpassword;

        if($cuit == null || $fullname == null || $numero_documento == null || $contrasena == null || $confirmpassword  == null)
        {
			$message = "Para Registrarse complete todos los datos del formulario";
			$status_error = true;
            $status_ok = false;
            $esEmp = false;
			
			// return view('inicio.inicio', compact('inicio', 'message', 'status_error', 'esEmp'));
            return redirect('inicio')->with(['status_info' => $status_error, 'message' => $message,]);
        }

        $existe =  DB::select("SELECT * FROM users where cuit = '" . $cuit . "' OR dni = '" . $numero_documento . "'" );

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

            $mes_desde = substr($fecha_desde, 0, -5);
            $anio_desde = substr($fecha_desde, 3);

            $mes_hasta = substr($fecha_hasta, 0, -5);
            $anio_hasta = substr($fecha_hasta, 3);

            $inicio = "";
            $esEmp = true;
            $status_ok = false;
            $message = "";
           
            // $persona = DB::select("SELECT cuit, dni, nombreyApellido FROM users where cuit = " . $usuario . " OR dni = '" . $usuario . "'" );
            // $cuil = $persona[0]->cuit;
            // $nombre = $persona[0]->nombreyApellido;

            $datos =  DB::select("SELECT DISTINCT apellido, tipo, tipo_detalle, nombre, cuil, mes, mes_nom, anio FROM recibos where cuil = " . $usuario . " AND mes BETWEEN $mes_desde AND $mes_hasta ORDER BY anio, mes ASC");

            if(count( $datos) == 0)
            {
                $no_hay_datos = true;
            }
            return view('empleado.empleado', compact('esEmp', 'nombre', 'usuario', 'datos', 'status_ok', 'message', 'no_hay_datos'));
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
            $datos =  DB::select("SELECT DISTINCT apellido, tipo, tipo_detalle, nombre, cuil, mes, mes_nom, anio FROM recibos where cuil = " . $usuario . " OR numero_documento = " . $usuario . " ORDER BY anio, mes ASC");
            
            if(count($datos) == 0)
            {
                $no_hay_datos = true;
            }
            return view('empleado.empleado', compact('inicio', 'esEmp', 'nombre', 'usuario', 'datos', 'status_ok', 'message', 'no_hay_datos'));
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

            $datos =  DB::select("SELECT apellido, nombre, numero_documento, cuil, legajo, dependencia, antiguedad, categoria, regimen_horario, planta, fecha_ingreso, fecha_reingreso, mes, mes_nom, anio, concepto, descripcion, importe, dep FROM recibos where cuil = $usuario and mes = $mesParam and anio = $anioParam and tipo = '" . $tipo . "' ORDER BY id ASC");
            
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
            if(is_null($fecha_reingreso))
            {
                $fecha_reingreso = "*";
            }
            
            
            $pdf = new FPDI();
            
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
                $pdf->SetXY(34, 14);
                $pdf->Write(8, $mes_nom . '/' . $anio);
                // nombre
                $pdf->SetXY(102, 14);
                $pdf->Write(8, $apellido . ' ' . $nombre);
                // legajo
                $pdf->SetXY(152, 14);
                $pdf->Write(8, $legajo);

                // fecha ingreso/reingreso
                $pdf->SetXY(27, 23);
                $pdf->Write(8, $fecha_ingreso . '/' . $fecha_reingreso);

                // documento
                $pdf->SetXY(66, 23);
                $pdf->Write(8, $numero_documento);

                // dependencia
                $pdf->SetXY(93, 23);
                $pdf->Write(8, $dependencia);

                // antiguedad
                $pdf->SetXY(30, 31);
                $pdf->Write(8, $antiguedad);

                // categoria/regimen horario
                $pdf->SetXY(64, 31);
                $pdf->Write(8, $categoria . '/' . $regimen_horario);

                // n° de cuil
                $pdf->SetXY(112, 31);
                $pdf->Write(8, $cuil);

                // planta
                $pdf->SetXY(146, 31);
                $pdf->Write(8, $planta);

                
                if(count($datos) > 0)
                {
                    $cantidad = count($datos);

                    $xConcepto = 28;
                    $xHaberes_con_descuento = 100;
                    $xHaberes_sin_descuento = 126;
                    $xDescuentos = 152;
                    $y = 46;

                    $importe_Haberes_con_descuento = 0.00;
                    $importe_Haberes_sin_descuento = 0.00;
                    $importe_descuento = 0.00;

                    for ($i=0; $i < $cantidad; $i++) { 
                        $concepto = $datos[$i]->concepto;
                        $descripcion = $datos[$i]->descripcion;
                        $importe = $datos[$i]->importe;

                        $pdf->SetXY($xConcepto, $y);
                        $pdf->Write(8, $concepto . '-' . utf8_decode($descripcion));

                        if ($concepto < 200) {
                            $importe_Haberes_con_descuento =  $importe_Haberes_con_descuento + $importe;
                            $pdf->SetXY($xHaberes_con_descuento, $y);
                            $pdf->Write(8, $importe);
                        }
                        elseif ($concepto < 300) {
                            $importe_Haberes_sin_descuento = $importe_Haberes_sin_descuento + $importe;
                            $pdf->SetXY($xHaberes_sin_descuento, $y);
                            $pdf->Write(8, $importe);
                        }
                        else {
                            $importe_descuento = $importe_descuento + $importe;
                            $pdf->SetXY($xDescuentos, $y);
                            $pdf->Write(8, $importe);
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
                $pdf->Output('recibo_' . $mes_nom . '-'. $anio . '.pdf', 'D');
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

            $datos =  DB::select("SELECT apellido, nombre, numero_documento, cuil, legajo, dependencia, antiguedad, categoria, regimen_horario, planta, fecha_ingreso, fecha_reingreso, mes, mes_nom, anio, concepto, descripcion, importe, dep FROM recibos where cuil = $usuario and mes = $mesParam and anio = $anioParam and tipo = '" . $tipo . "' ORDER BY id ASC");
            
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

            if(is_null($fecha_reingreso))
            {
                $fecha_reingreso = "*";
            }
            
            $pdf = new FPDI();
            
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
                $pdf->SetXY(34, 14);
                $pdf->Write(8, $mes_nom . '/' . $anio);
                // nombre
                $pdf->SetXY(102, 14);
                $pdf->Write(8, $apellido . ' ' . $nombre);
                // legajo
                $pdf->SetXY(152, 14);
                $pdf->Write(8, $legajo);

                // fecha ingreso/reingreso
                $pdf->SetXY(27, 23);
                $pdf->Write(8, $fecha_ingreso . '/' . $fecha_reingreso);

                // documento
                $pdf->SetXY(66, 23);
                $pdf->Write(8, $numero_documento);

                // dependencia
                $pdf->SetXY(93, 23);
                $pdf->Write(8, $dependencia);

                // antiguedad
                $pdf->SetXY(30, 31);
                $pdf->Write(8, $antiguedad);

                // categoria/regimen horario
                $pdf->SetXY(64, 31);
                $pdf->Write(8, $categoria . '/' . $regimen_horario);

                // n° de cuil
                $pdf->SetXY(112, 31);
                $pdf->Write(8, $cuil);

                // planta
                $pdf->SetXY(146, 31);
                $pdf->Write(8, $planta);
               
                if(count($datos) > 0)
                {
                    $cantidad = count($datos);

                    $xConcepto = 28;
                    $xHaberes_con_descuento = 100;
                    $xHaberes_sin_descuento = 126;
                    $xDescuentos = 152;
                    $y = 46;

                    $importe_Haberes_con_descuento = 0.00;
                    $importe_Haberes_sin_descuento = 0.00;
                    $importe_descuento = 0.00;

                    for ($i=0; $i < $cantidad; $i++) { 
                        $concepto = $datos[$i]->concepto;
                        $descripcion = $datos[$i]->descripcion;
                        $importe = $datos[$i]->importe;

                        $pdf->SetXY($xConcepto, $y);
                        $pdf->Write(8, $concepto . '-' . utf8_decode($descripcion));

                        if ($concepto < 200) {
                            $importe_Haberes_con_descuento =  $importe_Haberes_con_descuento + $importe;
                            $pdf->SetXY($xHaberes_con_descuento, $y);
                            $pdf->Write(8, $importe);
                        }
                        elseif ($concepto < 300) {
                            $importe_Haberes_sin_descuento = $importe_Haberes_sin_descuento + $importe;
                            $pdf->SetXY($xHaberes_sin_descuento, $y);
                            $pdf->Write(8, $importe);
                        }
                        else {
                            $importe_descuento = $importe_descuento + $importe;
                            $pdf->SetXY($xDescuentos, $y);
                            $pdf->Write(8, $importe);
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
                $pdf->Output('recibo_' . $mes_nom . '-'. $anio . '.pdf', 'I');
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
