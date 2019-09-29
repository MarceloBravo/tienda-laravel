<?php

use Illuminate\Database\Seeder;
use App\Marca;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Marca::insert([
            'nombre' => 'Asus',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Marca::insert([
            'nombre' => 'Lenovo',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Marca::insert([
            'nombre' => 'Sony',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Marca::insert([
            'nombre' => 'Samsung',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Marca::insert([
            'nombre' => 'Hp',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Marca::insert([
            'nombre' => 'Lg',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Marca::insert([
            'nombre' => 'Wawei',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

        Marca::insert([
            'nombre' => 'Mac',
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);

    }
}
