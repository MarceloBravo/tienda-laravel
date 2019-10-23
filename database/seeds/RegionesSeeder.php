<?php

use Illuminate\Database\Seeder;
use \App\Region;

class RegionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::insert([
                'nombre' => 'Metropolitana',
                'id_pais' => 1,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
                ]);
            
        Region::insert([
                'nombre' => 'Tarapaca',
                'id_pais' => 1,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]);
        
        Region::insert([
            'nombre' => 'Antofagasta',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Atacama',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Coquimbo',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Valparaiso',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            "nombre" => "Libertador Bernardo O'Higgins",
            "id_pais" => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Maule',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Concepción',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Araucanía',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Los Lagos',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Aysen del General Carlos Ibañes del Campo',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Magallanes y de la Antártica Chilena',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Los Rios',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Arica y Parinacota',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Region::insert([
            'nombre' => 'Ñuble',
            'id_pais' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

    }
}
