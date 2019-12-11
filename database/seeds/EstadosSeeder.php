<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::insert([
            'nombre' => 'Pendiente',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Estado::insert([
            'nombre' => 'En preparación',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Estado::insert([
            'nombre' => 'Enviado',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        Estado::insert([
            'nombre' => 'Finalizada',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
    }
}
