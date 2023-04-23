<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
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
                'persona_id'    => 5,
                'clave'         => 2,
                'empresa'       => 'Sabritas',
            ],
        ];
        DB::table('proveedores')->insert($data);
    }
}
