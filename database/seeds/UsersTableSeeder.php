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
            'rut' => '11.111.111-1',
            'nombre' => 'Marcelo',
            'a_paterno' => 'Bravo',
            'a_materno' => 'Castillo',
            'email' => 'mabc@live.cl',
            'nickname' => 'Marcelo Bravo',
            'password' => bcrypt('123456'),
            'activo' => true,
            'direccion' => '12 Norte 16 Oriente #2288, Talca',
            'id_ciudad' => 2,
            'fono' => '974331085',
            'rol_id' => 1
        ]);

        User::insert([
            'rut' => '22.222.222-2',
            'nombre' => 'Juana',
            'a_paterno' => 'Perez',
            'a_materno' => 'Pereira',
            'email' => 'juana@ejemplo.cl',
            'nickname' => 'Juana Perez',
            'password' => bcrypt('654321'),
            'activo' => true,
            'direccion' => '2 Sur 16 Oriente #1234, Talca',
            'id_ciudad' => 1,
            'fono' => '0987654321',
            'rol_id' => 2
        ]);


    }
}
