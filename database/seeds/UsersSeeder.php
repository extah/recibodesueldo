<?php

use Illuminate\Database\Seeder;
use App\Users;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = new Users();
        $p->nombreyApellido = 'Emmanuel Baleztena';
        $p->email = 'extah23@gmail.com';
        $p->telefono = 12345567;
        $p->dni = 36738451;
        $p->contrasena = '123';
        $p->fecha_nacimiento = date('Y-m-d', strtotime('1992-04-08'));
        $p->save();
    }
}
