<?php

use Illuminate\Database\Seeder;
use App\ImagenesProducto;

class ImagenesProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagenesProducto::insert([
            'producto_id' => 1,
            'url' => 'img/product01.png',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 1,
            'url' => 'img/product06.png',
            'default' => false,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 1,
            'url' => 'img/product07.png',
            'default' => false,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 1,
            'url' => 'img/product08.png',
            'default' => false,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 1,
            'url' => 'img/product09.png',
            'default' => false,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 2,
            'url' => 'img/product04.png',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 3,
            'url' => 'img/product03.png',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 4,
            'url' => 'img/product05.png',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 5,
            'url' => 'img/product03.png',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);
           
        ImagenesProducto::insert([
            'producto_id' => 6,
            'url' => 'img/product06.png',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 7,
            'url' => 'img/product07.png',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 8,
            'url' => 'img/product09.png',
            'default' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        ImagenesProducto::insert([
            'producto_id' => 8,
            'url' => 'img/shop02.png',
            'default' => false,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);
    }
}
