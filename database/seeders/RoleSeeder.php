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
                'name'   => 'Administrador',
                'guard_name'   => 'web',
            ],
            [
                'name'   => 'Vendedor',
                'guard_name'   => 'web',
            ]
        ];
        DB::table('roles')->insert($data);
    }
}
