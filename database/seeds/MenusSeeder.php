<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::Insert([
            'nombre' => 'Home',
            'icono_class' => 'fa fa-home',
            'menu_padre_id' => null,            
            'posicion' => 10,
            'pantalla_id' => 2,
            'url' => '/admin/home',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Mantenedores',
            'icono_class' => 'fa fa-home',
            'menu_padre_id' => null,
            'posicion' => 20,
            'pantalla_id' => 1,
            'url' => '/admin/mantenedores',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Administración',
            'icono_class' => 'fa fa-home',
            'menu_padre_id' => null,
            'pantalla_id' => 1,
            'posicion' => 30,
            'url' => '/admin/administracion',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Categorías',
            'icono_class' => 'fa fa-object-group',
            'menu_padre_id' => 2,
            'posicion' => 10,
            'pantalla_id' => 3,
            'url' => '/admin/categorias',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Marcas',
            'icono_class' => 'fa fa-registered',
            'menu_padre_id' => 2,
            'posicion' => 20,
            'pantalla_id' => 4,
            'url' => '/admin/marcas',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Productos',
            'icono_class' => 'fa fa-cubes',
            'menu_padre_id' => 2,
            'posicion' => 30,
            'pantalla_id' => 5,
            'url' => '/admin/productos',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Roles',
            'icono_class' => 'fa fa-group',
            'menu_padre_id' => 3,
            'posicion' => 10,
            'pantalla_id' => 6,
            'url' => '/admin/roles',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Usuarios',
            'icono_class' => 'fa fa-user',
            'menu_padre_id' => 3,
            'posicion' => 20,
            'pantalla_id' => 7,
            'url' => '/admin/usuarios',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Pantallas',
            'icono_class' => 'fa fa-windows-maximize',
            'menu_padre_id' => 3,
            'posicion' => 30,
            'pantalla_id' => 8,
            'url' => '/admin/pantallas',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Menus',
            'icono_class' => 'fa fa-navicon',
            'menu_padre_id' => 3,
            'posicion' => 40,
            'pantalla_id' => 9,
            'url' => '/admin/menus',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Menu::Insert([
            'nombre' => 'Permisos',
            'icono_class' => 'fa fa-user-plus',
            'menu_padre_id' => 3,
            'posicion' => 50,
            'pantalla_id' => 10,
            'url' => '/admin/permisos',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);
    }
}
