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
            'precio_anterior' => 700000,
            'visible' => true,
            'color' => 'Negro',
            'marca_id' => 1,
            'nuevo' => true,
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
            'precio_anterior' => 900000,
            'visible' => true,
            'color' => 'Gris',
            'marca_id' => 2,
            'nuevo' => true,
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
            'precio_anterior' => 550000,
            'visible' => true,
            'color' => 'Negro',
            'marca_id' => 4,
            'nuevo' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Producto::insert([
            'categoria_id' => 1,
            'nombre' => 'Audifono Sony Sny-0101' ,
            'descripcion' => 'Audifono stero alámbrico con Sony con manos libres, aro para la cabeza, almoadillas de xx pulgadas, etc.',
            'resumen' => 'Audifonos Stero Sony con manos libres Sny-0101',
            'slug' => 'Sny-0101',
            'precio' => 15000,
            'precio_anterior' => 15000,
            'visible' => true,
            'color' => 'Negro',
            'marca_id' => 3,
            'nuevo' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        
        Producto::insert([
            'categoria_id' => 1,
            'nombre' => 'Notebook HP hp-0908K',
            'descripcion' => 'Notebook HP Core I7 8a generación, 1 TB Hdd, 6 GB Ram, 1 HDMI, 2 USB 3.0',
            'resumen' => 'Notebook HP Core I7, 1TB Hdd, 6GB Ram',
            'slug' => 'note-hp-0908K',            
            'precio' => 550000,
            'precio_anterior' => 650000,
            'visible' => true,
            'color' => 'Gris',
            'marca_id' => 5,
            'nuevo' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Producto::insert([
            'categoria_id' => 1,
            'nombre' => 'Macbook Pro mc-0123' ,
            'descripcion' => 'Macbook pro, 1 TB Hdd, 6 GB Ram, 1 HDMI, 2 USB 3.0',
            'resumen' => 'Maxkbook pro, 1 TB Hdd, 6 GB Ram, 1 HDMI, 2 USB 3.0',
            'slug' => 'mc-0123',
            'precio' => 600000,
            'precio_anterior' => 650000,
            'visible' => true,
            'color' => 'Negro',
            'marca_id' => 8,
            'nuevo' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        /* **** */
        Producto::insert([
            'categoria_id' => 1,
            'nombre' => 'Celular Lg x-cam LG-K580F' ,
            'descripcion' => 'Celular Lg X-Cam, camara frontal y doble cámara trasera, 16 GB de memoria + Micro SD de hasta 16 GB, liberado.',
            'resumen' => 'Celular Lg x-cam LG-K580F, 16 GB de almacenamiento +  camara frontal y trasera',
            'slug' => 'LG-K580F',
            'precio' => 150000,
            'precio_anterior' => 200000,
            'visible' => true,
            'color' => 'Negro',
            'marca_id' => 6,
            'nuevo' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Producto::insert([
            'categoria_id' => 1,
            'nombre' => 'Cámara fotgrafica LG ph-12345' ,
            'descripcion' => 'Cámara fotografica LG, con gran angular, menmoria de 32 GB, función nocturna, etc.',
            'resumen' => 'Cámara fotgrafica LG ph-12345, 32 Gb, Func. Nocturna',
            'slug' => 'LG-ph-12345',
            'precio' => 250000,
            'precio_anterior' => 300000,
            'visible' => true,
            'color' => 'Gris',
            'marca_id' => 6,
            'nuevo' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        
    }
}
