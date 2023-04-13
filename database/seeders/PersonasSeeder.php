<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasSeeder extends Seeder
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
                'nombres'   => 'Publico en general',
                'email'     => 'prueba@softcode.com.mx',
                'telefono'  => '(00) 0000-0000',
            ],
            [
                'nombres'   => 'Miguel López',
                'email'     => 'miguel@gmail.com',
                'telefono'  => '(91) 9151-3420',
            ],
            [
                'nombres'   => 'jesus López',
                'email'     => 'jesus@gmail.com',
                'telefono'  => '(91) 9151-3421',
            ],
            [
                'nombres'   => 'Jose López',
                'email'     => 'jose@gmail.com',
                'telefono'  => '(91) 9151-3422',
            ],
            [
                'nombres'   => 'Pedro López',
                'email'     => 'pedro@gmail.com',
                'telefono'  => '(91) 9151-3423',
            ],
            [
                'nombres'   => 'Esther López',
                'email'     => 'esther@gmail.com',
                'telefono'  => '(91) 9151-3424',
            ],
            [
                'nombres'   => 'Alejandro López',
                'email'     => 'alejandro@gmail.com',
                'telefono'  => '(91) 9151-3425',
            ],
        ];
        DB::table('personas')->insert($data);
    }
}
