<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::insert([
            'nombre' => 'Administrador',
            'descripcion' => 'Rol para el usuario encargado de ingresar productos y configurar precios',            
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Rol::insert([
            'nombre' => 'Cliente',
            'descripcion' => 'Rol para usuarios que solo puede efectuar compras, pero no ingresar y/o actualizar productos',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);
    }
}
