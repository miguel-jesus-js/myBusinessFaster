<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoClientesSeeder extends Seeder
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
                'tipo_cliente'  => 'General'
            ],
            [
                'tipo_cliente'  => 'Distinguido'
            ],
            [
                'tipo_cliente'  => 'Frecuente'
            ],
        ];
        DB::table('tipo_clientes')->insert($data);
    }
}
