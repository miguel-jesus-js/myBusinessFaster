<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
                'rol'   => 'Administrador'
            ],
            [
                'rol'   => 'Vendedor'
            ]
        ];
        DB::table('roles')->insert($data);
    }
}
