<?php

use Illuminate\Database\Seeder;
use App\Producto;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Producto::insert([
            'categoria_id' => 1,
            'nombre' => 'Notebook Asus AS-456',
            'descripcion' => 'Notebook Asus Core I7 7a generación, 1 TB Hdd, 8 GB Ram, 1 HDMI, 1 VGA, 2 USB 2.0, 1 USB 3.0, DVD',
            'resumen' => 'Notebook Asus Core I7, 1TB Hdd, 8GB Ram',
            'slug' => 'note-as-456',
            'precio' => 600000,
            'imagen' => '',
            'visible' => true,
            'color' => 'Negro',
            'marca' => 'ASUS',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Producto::insert([
            'categoria_id' => 1,
            'nombre' => 'Notebook Lenovo LNV123' ,
            'descripcion' => 'Notebook Lenovo Core I7 8a generación, 1 TB Hdd, 8 GB Ram, 1 HDMI, 1 VGA, 2 USB 2.0, 1 USB 3.0',
            'resumen' => 'Notebook Lenovo Core I7, 1TB Hdd, 8GB Ram',
            'slug' => 'note-lnv-123',
            'precio' => 700000,
            'imagen' => '',
            'visible' => true,
            'color' => 'Gris',
            'marca' => 'LENOVO',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Producto::insert([
            'categoria_id' => 1,
            'nombre' => 'Notebook Samsung SS-123',
            'descripcion' => 'Notebook Samsung Core I7 8a generación, 1 TB Hdd, 6 GB Ram, 1 HDMI, 2 USB 3.0',
            'resumen' => 'Notebook Lenovo Core I7, 1TB Hdd, 6GB Ram',
            'slug' => 'note-ss-123',            
            'precio' => 450000,
            'imagen' => '',
            'visible' => true,
            'color' => 'Negro',
            'marca' => 'Samsung',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);
    }
}
