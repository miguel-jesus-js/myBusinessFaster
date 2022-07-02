<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadMedidasSeeder extends Seeder
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
                'unidad_medida' => 'CM'
            ],
            [
                'unidad_medida' => 'M'
            ],
            [
                'unidad_medida' => 'KM'
            ],
            [
                'unidad_medida' => 'LITRO'
            ],
            [
                'unidad_medida' => 'KG'
            ],
        ];
        DB::table('unidad_medidas')->insert($data);
    }
}
