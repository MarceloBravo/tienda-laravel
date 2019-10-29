<?php

use Illuminate\Database\Seeder;
use App\Oferta;

class OfertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Oferta::insert([
            'src_imagen' => '../img/hotdeal.png',
            'texto1' => 'OFERTA DE LA SEMANA',
            'texto2' => 'NUEVA COLECCIÓN CON UN 50% DE DESCUENTO',
            'fecha_expiracion' => Date('Y-m-d'),
            'portada' => true,
            'created_at' => Date('Y-m-d'),
            'updated_at' => Date('Y-m-d')
        ]);
    }
}
