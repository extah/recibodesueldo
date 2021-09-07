<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Especialidades;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('especialidades')->insert([
        //     'nombre' => Str::random(10),
        //     'descripcion' => Str::random(10).'@gmail.com',
        // ]);
        $p = new Especialidades();
        $p->nombre = "Clínica";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Traumatología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Urología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Oncología";
        $p->descripcion = "";
        $p->save();


        $p = new Especialidades();
        $p->nombre = "Psiquiatría";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Psicología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Neurología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Neumonología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Nefrología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Oftalmología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Otorrinolaringología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Flebología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Diabetología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Gastroenterología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Ginecología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Hematología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Dermatología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Cardiología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Cirugía";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Pediatria";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Imágenes";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Kinesiología";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Servicio de Guardia";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "Guardia Unidad Terapia Intensiva";
        $p->descripcion = "";
        $p->save();

    }
}
