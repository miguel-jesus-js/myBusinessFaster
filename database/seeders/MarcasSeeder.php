<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasSeeder extends Seeder
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
                'marca' => 'Nike'
            ],
            [
                'marca' => 'Adidas'
            ],
            [
                'marca' => 'Bimbo'
            ],
            [
                'marca' => 'Sabritas'
            ],
            [
                'marca' => 'Takis'
            ],
            [
                'marca' => 'CK'
            ],
            [
                'marca' => 'Gucci'
            ],
        ];
        DB::table('marcas')->insert($data);
    }
}
