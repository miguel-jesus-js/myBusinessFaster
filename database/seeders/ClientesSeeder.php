<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
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
                'tipo_cliente_id'   => 3,
                'nombres'           => 'Diana berenice',
                'app'               => 'Rodriguez',
                'apm'               => 'Aguilar',
                'email'             => 'dianaaguilarjunio@gmail.com',
                'telefono'          => '(91) 9159-5287',
                'rfc'               => 'QUMA470929F30',
                'empresa'           => 'jsjsjjs',
                'ciudad'            => 'México',
                'estado'            => 'Chiapas',
                'municipio'         => 'Ocosingo',
                'cp'                => 29950,
                'colonia'           => 'Bonampack',
                'calle'             => 'Yaxchilan',
                'n_exterior'        => 18,
                'password'          =>'$2y$10$yjizh1J7lNMYGW4mYCeqR.nTcP2B7CCA29LmFcNrsPUN6bUvEOQPO'
            ],
            [
                'tipo_cliente_id'   => 1,
                'nombres'           => 'Miguel de Jesús',
                'app'               => 'López',
                'apm'               => 'López',
                'email'             => 'winalllpz@gmail.com',
                'telefono'          => '(91) 9151-3420',
                'rfc'               => 'QUMA470929F31',
                'empresa'           => 'nose',
                'ciudad'            => 'México',
                'estado'            => 'Chiapas',
                'municipio'         => 'Ocosingo',
                'cp'                => 29950,
                'colonia'           => 'Bonampack',
                'calle'             => 'Yaxchilan',
                'n_exterior'        => 18,
                'password'          =>'$2y$10$yjizh1J7lNMYGW4mYCeqR.nTcP2B7CCA29LmFcNrsPUN6bUvEOQPO'
            ]
        ];
        DB::table('clientes')->insert($data);
    }
}
