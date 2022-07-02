<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
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
                'categoria' => 'Limpieza'
            ],
            [
                'categoria' => 'Cocina'
            ],
            [
                'categoria' => 'Abarrotes'
            ],
            [
                'categoria' => 'Papeleria'
            ],
        ];
        DB::table('categorias')->insert($data);
    }
}
