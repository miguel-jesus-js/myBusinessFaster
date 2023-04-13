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
                'persona_id'        => 3,
                'tipo_cliente_id'   => 1,
                'password'          => 'cliente@softcode.com.mx'
            ],
            [
                'persona_id'        => 4,
                'tipo_cliente_id'   => 1,
                'password'          => 'cliente2@softcode.com.mx'
            ]
        ];
        DB::table('clientes')->insert($data);
    }
}
