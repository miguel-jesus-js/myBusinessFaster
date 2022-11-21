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
                'd-cliente_id'        => 1,
                'd-ciudad'            => 'México',
                'd-estado'            => 'Chiapas',
                'd-municipio'         => 'Ocosingo',
                'd-cp'                => 29950,
                'd-colonia'           => 'Bonampack',
                'd-calle'             => 'Yaxchilan',
                'd-n_exterior'        => 18,
            ],
            [
                'd-cliente_id'        => 1,
                'd-ciudad'            => 'México',
                'd-estado'            => 'Chiapas',
                'd-municipio'         => 'Ocosingo',
                'd-cp'                => 29950,
                'd-colonia'           => 'Norte',
                'd-calle'             => 'desc',
                'd-n_exterior'        => 18,
            ],
            [
                'd-cliente_id'        => 2,
                'd-ciudad'            => 'México',
                'd-estado'            => 'Chiapas',
                'd-municipio'         => 'Ocosingo',
                'd-cp'                => 29950,
                'd-colonia'           => 'Puerto arturo',
                'd-calle'             => 'desc',
                'd-n_exterior'        => 18,
            ],
        ];
        DB::table('direcciones_entregas')->insert($data);
    }
}
