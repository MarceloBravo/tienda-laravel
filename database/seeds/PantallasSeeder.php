<?php

use Illuminate\Database\Seeder;
use App\Pantalla;

class PantallasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pantalla::Insert([
            'nombre' => ' -- Sin pantalla asociada -- ',
            'permite_crear' => false,
            'permite_actualizar' => false,
            'permite_eliminar' => false,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);

        Pantalla::Insert([
            'nombre' => 'Home',
            'permite_crear' => true,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);

        Pantalla::Insert([
            'nombre' => 'Categorías',
            'permite_crear' => true,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);

        Pantalla::Insert([
            'nombre' => 'Marcas',
            'permite_crear' => true,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);

        Pantalla::Insert([
            'nombre' => 'Productos',
            'permite_crear' => true,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);

        Pantalla::Insert([
            'nombre' => 'Roles',
            'permite_crear' => true,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);

        Pantalla::Insert([
            'nombre' => 'Usuarios',
            'permite_crear' => true,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);

        Pantalla::Insert([
            'nombre' => 'Pantallas',
            'permite_crear' => true,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);   

        Pantalla::Insert([
            'nombre' => 'Menus',
            'permite_crear' => true,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);

        Pantalla::Insert([
            'nombre' => 'Permisos',
            'permite_crear' => false,
            'permite_actualizar' => true,
            'permite_eliminar' => true,
            'created_at' => Date('Y-m-d'),
            'Updated_at' => Date('Y-m-d'),
        ]);
    }
}
