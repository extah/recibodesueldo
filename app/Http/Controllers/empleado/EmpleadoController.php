<?php

namespace App\Http\Controllers\empleado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
use Response;
use PDFVillca;
use Barryvdh\DomPDF\Facade as PDF;
// use  Villca\TCPDF\Facades\TCPDF as PDFVillca;
// 'PDF' => Barryvdh\DomPDF\Facade::class,

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

    public function index(Request $request)
    {

        $inicio = "";
        $esEmp = true;
        $nombre = "Emmanuel Baleztena";
        $cuix = "20367384515";
        $datos =  DB::select("SELECT DISTINCT apellido, tipo, tipo_detalle, nombre, cuil, mes, mes_nom, anio, concepto FROM recibos where cuil = $cuix ORDER BY id ASC");
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
        $datos =  DB::select("SELECT DISTINCT  apellido, tipo, tipo_detalle, nombre, cuil, mes, mes_nom, anio, concepto FROM recibos where cuil = $cuix and mes BETWEEN $mes_desde AND $mes_hasta ORDER BY id ASC");
        
        return view('empleado.empleado', compact('inicio', 'esEmp', 'nombre', 'cuix', 'datos'));
    }


    public function descargarPDF()
    {
        # code...
        $pdf = new FPDI();

        $pdf->AddPage(); 
        
        $pdf->setSourceFile('app\public\pdf\recibo.pdf'); 
        // import page 1 
        $tplIdx = $this->pdf->importPage(1); 
        //use the imported page and place it at point 0,0; calculate width and height
        //automaticallay and ajust the page size to the size of the imported page 
        $this->pdf->useTemplate($tplIdx, 0, 0, 0, 0, true); 
        
        // now write some text above the imported page 
        $this->pdf->SetFont('Arial', '', '13'); 
        $this->pdf->SetTextColor(0,0,0);
        //set position in pdf document
        $this->pdf->SetXY(40, 20);
        //first parameter defines the line height
        $this->pdf->Write(0, 'gift code');
        //force the browser to download the output
        $this->pdf->Output('app\public\pdf\recibo_generated.pdf', 'D');

        $filename = 'recibo_generated.pdf';

        // $filename = 'recibo.pdf';
        return response()->download(storage_path('app\public\pdf\\' . $filename));
    }
    public function mostrarPDF($tipo, $mesParam, $anioParam, $cuix_param)
    {
        
        // dd($anio);
        # code...

    $datos =  DB::select("SELECT apellido, nombre, numero_documento, cuil, legajo, dependencia, antiguedad, categoria, regimen_horario, planta, fecha_ingreso, fecha_reingreso, mes, mes_nom, anio, concepto, descripcion FROM recibos where cuil = $cuix_param and mes = $mesParam and anio = $anioParam and tipo = '" . $tipo . "' ORDER BY id ASC");
        
        $apellido = $datos[0]->apellido;
        $nombre = $datos[0]->nombre;
        $numero_documento = $datos[0]->numero_documento;
        $cuil = $datos[0]->cuil;
        $mes = $datos[0]->mes;
        $mes_nom = $datos[0]->mes_nom;
        $anio = $datos[0]->anio;

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


                // dd($cantidad);
                for ($i=0; $i < $cantidad; $i++) { 
                    $concepto = $datos[$i]->concepto;
                    // dd($concepto);
                    $descripcion = $datos[$i]->descripcion;

                    $pdf->SetXY($xConcepto, $y);
                    $pdf->Write(8, $concepto . '-' . utf8_decode($descripcion));

                    $pdf->SetXY($xHaberes_con_descuento, $y);
                    $pdf->Write(8, "1023.55");
    
                    $pdf->SetXY($xHaberes_sin_descuento, $y);
                    $pdf->Write(8, "1023.55");
    
                    $pdf->SetXY($xDescuentos, $y);
                    $pdf->Write(8, "1023.55");

                    $y = $y + 4;
                }
            }
            


            // final de pdf, fecha y hora actual
            $ldate = date('Y-m-d H:i:s');
                      
            $pdf->SetXY(64, 231);
            $pdf->Write(8, 'Emitido con Fecha : ' . $ldate);
            // echo($pdf);
            $pdf->Output('recibo_generated.pdf', 'I');
            // return $pdf;
            // $pdf->Output('recibo_generated.pdf', 'D');
        }

        // $filename = 'recibo_generated.pdf';

        // return response()->file(storage_path('app\public\pdf\\' . $filename));
    }
    private function editarPDF()
    {
        # code...
        $pdf = new FPDI();

        $pdf->AddPage(); 
        
        $pdf->setSourceFile('pp\public\pdf\recibo.pdf'); 
        // import page 1 
        $tplIdx = $this->pdf->importPage(1); 
        //use the imported page and place it at point 0,0; calculate width and height
        //automaticallay and ajust the page size to the size of the imported page 
        $this->pdf->useTemplate($tplIdx, 0, 0, 0, 0, true); 
        
        // now write some text above the imported page 
        $this->pdf->SetFont('Arial', '', '13'); 
        $this->pdf->SetTextColor(0,0,0);
        //set position in pdf document
        $this->pdf->SetXY(20, 20);
        //first parameter defines the line height
        $this->pdf->Write(0, 'gift code');
        //force the browser to download the output
        $this->pdf->Output('C:\recibo_generated.pdf', 'D');
        
    }
}
