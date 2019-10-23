<?php

use Illuminate\Database\Seeder;
use \App\Pais;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::insert([
            'nombre' => 'chile',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
            ]);

        Pais::insert([
            'nombre' => 'Argentina',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
            ]);

    }
}
