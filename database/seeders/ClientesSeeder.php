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
                'password'          =>'winalllpz@gmail.com'
            ]
        ];
        DB::table('clientes')->insert($data);
    }
}
