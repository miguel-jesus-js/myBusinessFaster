<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'clave'       => 1,
                'nombres'       => 'Diana berenice',
                'app'           => 'Rodriguez',
                'apm'           => 'Aguilar',
                'email'         => 'dianaaguilarjunio@gmail.com',
                'telefono'      => '(91) 9159-5287',
                'rfc'           => 'QUMA470929F30',
                'empresa'       => 'Bimbo',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18
            ],
            [
                'clave'       => 1,
                'nombres'       => 'Miguel de Jesús',
                'app'           => 'López',
                'apm'           => 'López',
                'email'         => 'winalllpz@gmail.com',
                'telefono'      => '(91) 9151-3420',
                'rfc'           => 'QUMA470929F31',
                'empresa'       => 'Sabritas',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18
            ],
            [
                'clave'       => 2,
                'nombres'       => 'Jose Enrique',
                'app'           => 'López',
                'apm'           => 'López',
                'email'         => 'josedejesuslopezlopez@gmail.com',
                'telefono'      => '(91) 9151-3421',
                'rfc'           => 'QUMA470929F32',
                'empresa'       => 'Talkis',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18,
            ],
            [
                'clave'       => 2,
                'nombres'       => 'Pedro alejandro',
                'app'           => 'López',
                'apm'           => 'López',
                'email'         => 'pedroalejandrolopez@gmail.com',
                'telefono'      => '(91) 9151-3423',
                'rfc'           => 'QUMA470929F33',
                'empresa'       => 'Gamesa',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18
            ],
            [
                'clave'       => 2,
                'nombres'       => 'Esther',
                'app'           => 'López',
                'apm'           => 'Cruz',
                'email'         => 'estherlopez@gmail.com',
                'telefono'      => '(91) 9151-3424',
                'rfc'           => 'QUMA470929F34',
                'empresa'       => 'Food',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18
            ],
            [
                'clave'       => 2,
                'nombres'       => 'Pedro',
                'app'           => 'López',
                'apm'           => 'Gómez',
                'email'         => 'pedrogomez@gmail.com',
                'telefono'      => '(91) 9151-3425',
                'rfc'           => 'QUMA470929F35',
                'empresa'       => 'Nike',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18
            ],
            [
                'clave'       => 2,
                'nombres'       => 'Jesus',
                'app'           => 'López',
                'apm'           => 'Gómez',
                'email'         => 'jesuslopez@gmail.com',
                'telefono'      => '(91) 9151-3426',
                'rfc'           => 'QUMA470929F36',
                'empresa'       => 'Adidas',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18
            ],

        ];
        DB::table('proveedores')->insert($data);
    }
}
