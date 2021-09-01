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
        $p->nombre = "ALERGIA E INMUNOLOGIA";
        $p->descripcion = "tratamiento tanto de enfermedades alérgicas como fallas en nuestro sistema de defensas";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "CARDIOLOGIA";
        $p->descripcion = "diagnóstico y tratamiento de enfermedades del corazón, los vasos sanguíneos y el sistema circulatorio";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "CIRUGIA PLASTICA Y REPARADORA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "CIRUGIA TORACICA";
        $p->descripcion = "";
        $p->save();


        $p = new Especialidades();
        $p->nombre = "CIRUGIA GENERAL";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "CIRUGIA CARDIOVASCULAR";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "CIRUGIA TORACICA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "CLINICA MEDICA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "DERMATOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "DIAGNOSTICO POR IMAGENES";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "ENDOCRINOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "INFECTOLOGIA PEDIÁTRICA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "GASTROENTEROLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "GINECOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "NEONATOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "NEUMONOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "NEUROCIRUGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "NEUROLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "NUTRICION";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "OBSTETRICIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "OFTALMOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "ONCOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "OTORRINOLARINGOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "PEDIATRIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "PSIQUIATRIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "RADIOTERAPIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "TERAPIA INTENSIVA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "TISIONEUMONOLOGIA";
        $p->descripcion = "";
        $p->save();

        $p = new Especialidades();
        $p->nombre = "TOCOGINECOLOGIA";
        $p->descripcion = "";
        $p->save();


    }
}
