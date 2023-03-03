<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlmacenesSeeder extends Seeder
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
                'sucursale_id'  => 1,
                'nombre'        => 'Estante 1',
                'desc'          => 'Estante 1 color azul',
            ],
            [
                'sucursale_id'  => 1,
                'nombre'        => 'Estante 2',
                'desc'          => 'Estante 1 color azul'
            ]
        ];
        DB::table('almacenes')->insert($data);
    }
}
