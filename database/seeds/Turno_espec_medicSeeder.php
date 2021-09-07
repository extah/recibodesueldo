<?php

use Illuminate\Database\Seeder;
use App\Especialidades;
use App\Medico;
use App\Turno_espec_medic;

class Turno_espec_medicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 1)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 1)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes 12 hs, miércoles 13 hs y jueves 10 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 1)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 2)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes 16 hs y miércoles 8.30 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$800";
        $p->otros = 'Turnos a domicilio 4612427';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 1)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 3)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = '';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 2)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 4)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Jueves 13 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$700";
        $p->otros = 'Turnos al 2215934885';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 2)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 5)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y martes 8hs, miércoles 18 hs, viernes 9.30 hs y sábado 7 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$1000";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 2)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 6)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes 15 hs y viernes 14 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 2)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 7)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes y viernes 8.30 hs';
        $p->pami = 'NO';
        $p->obra_social = "No atiende por IOMA";
        $p->consulta_particular = "$900";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 2)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 8)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes, miércoles y viernes 9.30 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 2)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 9)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes, martes y jueves 16.20 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$1000";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 2)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 10)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes 9.30 hs y miércoles 13 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 3)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 11)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes 14 hs y viernes 15 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$1000";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 3)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 12)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes 13 hs, miércoles 11 hs y viernes 13 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$1000";
        $p->otros = '';
        $p->save();
        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 4)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 13)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles 12.30 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$1000";
        $p->otros = '';
        $p->save();
        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 4)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 14)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes y jueves 12 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();
                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 5)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 15)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Jueves 18 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "$2000";
        $p->otros = '';
        $p->save();
             
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 6)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 16)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y miércoles 17 hs, martes, viernes y sábado 8 hs';
        $p->pami = 'NO';
        $p->obra_social = "Obras sociales por reintegro";
        $p->consulta_particular = "$1300";
        $p->otros = '';
        $p->save();
                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 6)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 17)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y jueves 10 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA por cupo";
        $p->consulta_particular = "$900";
        $p->otros = '';
        $p->save();
          
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 7)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 18)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes 12 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$1400";
        $p->otros = '';
        $p->save();
          
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 8)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 19)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles 13.30 hs y viernes 17 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();
                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 9)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 20)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes 18 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 10)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 21)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes 12 hs, martes y miércoles 17 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$900";
        $p->otros = '';
        $p->save();
                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 11)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 22)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y jueves 14 hs, martes 8 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 12)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 23)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes 12 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();

        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 13)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 24)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Jueves 13 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();
                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 14)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 25)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes 14 hs, miércoles 17 hs y sábado 9 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$1000";
        $p->otros = '';
        $p->save();
                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 14)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 26)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Viernes 15 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();
                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 14)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 27)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles 18 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                              
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 15)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 28)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y martes 13 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 15)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 29)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles y jueves 14 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono C";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 15)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 30)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Sábados 9 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 15)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 31)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes 9 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$1000";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 15)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 32)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes, jueves y viernes 9.30 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$750";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 16)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 33)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes y jueves 13.30 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 17)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 34)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes y viernes 17 hs, miércoles 15 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 18)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 35)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes 9.30 hs y viernes 11 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 18)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 36)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y jueves 16 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$900";
        $p->otros = '';
        $p->save();
                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 19)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 37)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y jueves 18 hs, martes 15 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 19)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 38)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles 10.30 hs';
        $p->pami = 'SI';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 20)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 39)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes, martes, jueves y viernes 8 hs';
        $p->pami = '';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 20)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 40)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y jueves 16 hs';
        $p->pami = '';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 20)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 41)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes 16 hs y miércoles 8.30 hs';
        $p->pami = '';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 20)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 42)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles 8 hs y viernes 13.30 hs';
        $p->pami = '';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "$800";
        $p->otros = '';
        $p->save();
                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 20)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 43)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles 16 hs';
        $p->pami = '';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "$800";
        $p->otros = 'Turnos al 221 5658726';
        $p->save();
                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 20)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 44)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y miércoles 16 hs, jueves y viernes 15.30 hs';
        $p->pami = 'SI';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 20)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 45)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y miércoles de 7 a 11 hs, martes y jueves de 14 a 16.30 hs';
        $p->pami = 'SI';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 20)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 46)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes y jueves de 7 a 11 hs, martes de 9 a 14 hs';
        $p->pami = 'SI';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = 'Turnos al 4644546/5881 int 116';
        $p->save();
                                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 21)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 47)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'De lunes a viernes de 9.30 a 13 hs y de 16 a 19 hs';
        $p->pami = '';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 21)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 48)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'De lunes a viernes de 9.30 a 13 hs y de 16 a 19 hs';
        $p->pami = '';
        $p->obra_social = "IOMA bono B";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 21)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 31)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes de 13.30 a 15.30 hs';
        $p->pami = '';
        $p->obra_social = "IOMA bono A";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 22)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 49)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes 9 hs y jueves 15 hs.';
        $p->pami = 'SI';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 50)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes de 8 a 20 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 51)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes de 20 hs a martes 8 hs y Jueves de 20 hs a viernes 8 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 27)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes de 8 a 20 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 52)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes de 20 hs a miércoles 8 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 53)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles de 8 a 20 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 54)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércols de 20 hs a jueves 8 hs y Sábados de 8 hs a domingo 8 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 55)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Jueves de 8 a 20 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 56)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Viernes de 8 a 20 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                                
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 23)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 57)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Viernes de 20 hs a sábado 8 hs y Domingo de 8 hs a lunes 8 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 24)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 1)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes de 8 hs a martes 8 hs y Jueves 8 hs a 20 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 24)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 5)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Martes de 8 hs a miércoles 8 hs, Sábados de 8 hs a domingo 8 hs y Domingo 20 hs a lunes 8 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 24)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 58)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Miércoles 8 hs a jueves 8 hs, Viernes 8 hs a sábado 8 hs y Domingo 8 hs a 20 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                                        
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 24)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Medico::where('id', 51)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Jueves 20 hs a viernes 8 hs';
        $p->pami = '';
        $p->obra_social = "";
        $p->consulta_particular = "";
        $p->otros = '';
        $p->save();
                                                                
    }
}
