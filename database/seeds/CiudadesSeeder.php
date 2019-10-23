<?php

use Illuminate\Database\Seeder;
use \App\Ciudad;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudad::insert([
            'nombre' => 'Santiago',
            'id_comuna' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Ciudad::insert([
            'nombre' => 'Talca',
            'id_comuna' => 2,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Ciudad::insert([
            'nombre' => 'Curico',
            'id_comuna' => 4,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
    }
}
