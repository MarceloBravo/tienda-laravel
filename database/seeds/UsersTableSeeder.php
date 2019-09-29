<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::insert([
            'nombre' => 'Marcelo',
            'a_paterno' => 'Bravo',
            'a_materno' => 'Castillo',
            'email' => 'mabc@live.cl',
            'nickname' => 'Marcelo Bravo',
            'password' => bcrypt('123456'),
            'activo' => true,
            'direccion' => '12 Norte 16 Oriente #2288, Talca',
            'rol_id' => 1
        ]);

        User::insert([
            'nombre' => 'Juana',
            'a_paterno' => 'Perez',
            'a_materno' => 'Pereira',
            'email' => 'juana@ejemplo.cl',
            'nickname' => 'Juana Perez',
            'password' => bcrypt('654321'),
            'activo' => true,
            'direccion' => '2 Sur 16 Oriente #1234, Talca',
            'rol_id' => 2
        ]);


    }
}
