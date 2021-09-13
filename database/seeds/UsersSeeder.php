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
        $p->cuit = 20367384515;
        $p->dni = 36738451;
        $p->contrasena = '123';
        $p->save();
    }
}
