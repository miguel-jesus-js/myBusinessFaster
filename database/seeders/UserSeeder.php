<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'persona_id'    => 1,
                'sucursale_id'  => 1,
                'role_id'       => 1,
                'nom_user'      => 'User prueba',
                'password'      => Hash::make('prueba@softcode.com.mx'),
                'is_admin'      => true,
            ],
            [
                'persona_id'    => 2,
                'sucursale_id'  => 1,
                'role_id'       => 1,
                'nom_user'      => 'User prueba 2',
                'password'      => Hash::make('prueba2@softcode.com.mx'),
                'is_admin'      => false,
            ],
        ];
        DB::table('users')->insert($data);
        DB::table('sucursales')->where('id', 1)->update(['user_id' => 1]);
    }
}
