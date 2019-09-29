<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Categoria::insert([
            'nombre' => 'Computación',
            'slug' => 'computacion',
            'descripcion' => 'Artículos de computación',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d'),
        ]);

        Categoria::insert([
            'nombre' => 'Audio y video',
            'slug' => 'audio-video',
            'descripcion' => 'Artículos de video (televidores, pantallas, etc.) y audio (Equipos musicales, hgome teather, audífonos, etc.)',            
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d'),
        ]);
    }
}
