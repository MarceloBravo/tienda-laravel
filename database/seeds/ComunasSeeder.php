<?php

use Illuminate\Database\Seeder;
use \App\Comuna;

class ComunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comuna::insert([
            'nombre' => 'Santiago',
            'id_region' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Comuna::insert([
            'nombre' => 'Talca',
            'id_region' => 8,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Comuna::insert([
            'nombre' => 'Maule',
            'id_region' => 8,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Comuna::insert([
            'nombre' => 'Curico',
            'id_region' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
    }
}
