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
                'role_id'       => 1,
                'nombres'       => 'Diana berenice',
                'app'           => 'Rodriguez',
                'apm'           => 'Aguilar',
                'email'         => 'dianaaguilarjunio@gmail.com',
                'telefono'      => '(91) 9159-5287',
                'rfc'           => 'QUMA470929F30',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18,
                'nom_user'      => 'dayana pez',
                'password'      => Hash::make('SoftCode-2022'),
            ],
            [
                'role_id'       => 1,
                'nombres'       => 'Miguel de Jesús',
                'app'           => 'López',
                'apm'           => 'López',
                'email'         => 'winalllpz@gmail.com',
                'telefono'      => '(91) 9151-3420',
                'rfc'           => 'QUMA470929F31',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18,
                'nom_user'      => 'miguel-js',
                'password'      => Hash::make('SoftCode-2022'),
            ],
            [
                'role_id'       => 2,
                'nombres'       => 'Jose Enrique',
                'app'           => 'López',
                'apm'           => 'López',
                'email'         => 'josedejesuslopezlopez@gmail.com',
                'telefono'      => '(91) 9151-3421',
                'rfc'           => 'QUMA470929F32',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18,
                'nom_user'      => 'jose-js',
                'password'      => Hash::make('SoftCode-2022'),
            ],
            [
                'role_id'       => 2,
                'nombres'       => 'Pedro alejandro',
                'app'           => 'López',
                'apm'           => 'López',
                'email'         => 'pedroalejandrolopez@gmail.com',
                'telefono'      => '(91) 9151-3423',
                'rfc'           => 'QUMA470929F33',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18,
                'nom_user'      => 'alex 2022',
                'password'      => Hash::make('SoftCode-2022'),
            ],
            [
                'role_id'       => 2,
                'nombres'       => 'Esther',
                'app'           => 'López',
                'apm'           => 'Cruz',
                'email'         => 'estherlopez@gmail.com',
                'telefono'      => '(91) 9151-3424',
                'rfc'           => 'QUMA470929F34',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18,
                'nom_user'      => 'esther 2022',
                'password'      => Hash::make('SoftCode-2022'),
            ],
            [
                'role_id'       => 2,
                'nombres'       => 'Pedro',
                'app'           => 'López',
                'apm'           => 'Gómez',
                'email'         => 'pedrogomez@gmail.com',
                'telefono'      => '(91) 9151-3425',
                'rfc'           => 'QUMA470929F35',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18,
                'nom_user'      => 'pedro gomez',
                'password'      => Hash::make('SoftCode-2022'),
            ],
            [
                'role_id'       => 2,
                'nombres'       => 'Jesus',
                'app'           => 'López',
                'apm'           => 'Gómez',
                'email'         => 'jesuslopez@gmail.com',
                'telefono'      => '(91) 9151-3426',
                'rfc'           => 'QUMA470929F36',
                'ciudad'        => 'México',
                'estado'        => 'Chiapas',
                'municipio'     => 'Ocosingo',
                'cp'            => 29950,
                'colonia'       => 'Bonampack',
                'calle'         => 'Yaxchilan',
                'n_exterior'    => 18,
                'nom_user'      => 'jesus lpz',
                'password'      => Hash::make('SoftCode-2022'),
            ],

        ];
        DB::table('users')->insert($data);
    }
}
