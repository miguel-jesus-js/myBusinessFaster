<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialesSeeder extends Seeder
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
                'material'  => 'Metal'
            ],
            [
                'material'  => 'Madera'
            ],
            [
                'material'  => 'Plastico'
            ],
            [
                'material'  => 'Unicel'
            ],
            [
                'material'  => 'Aluminio'
            ],
            [
                'material'  => 'Cobre'
            ],
        ];
        DB::table('materiales')->insert($data);
    }
}
