<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DireccionesEntregasSeeder extends Seeder
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
                'cliente_id'        => 1,
                'ciudad'            => 'México',
                'estado'            => 'Chiapas',
                'municipio'         => 'Ocosingo',
                'cp'                => 29950,
                'colonia'           => 'Bonampack',
                'calle'             => 'Yaxchilan',
                'n_exterior'        => 18,
            ],
            [
                'cliente_id'        => 1,
                'ciudad'            => 'México',
                'estado'            => 'Chiapas',
                'municipio'         => 'Ocosingo',
                'cp'                => 29950,
                'colonia'           => 'Norte',
                'calle'             => 'desc',
                'n_exterior'        => 18,
            ],
            [
                'cliente_id'        => 2,
                'ciudad'            => 'México',
                'estado'            => 'Chiapas',
                'municipio'         => 'Ocosingo',
                'cp'                => 29950,
                'colonia'           => 'Puerto arturo',
                'calle'             => 'desc',
                'n_exterior'        => 18,
            ],
        ];
        DB::table('direcciones_entregas')->insert($data);
    }
}
