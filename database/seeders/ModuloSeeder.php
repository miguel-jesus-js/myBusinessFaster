<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloSeeder extends Seeder
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
                'modulo'        => 'Productos',
                'icono'         => 'ti-brand-producthunt',
                'link'          => '/productos',
                'es_catalogo'   => true
            ],
            [
                'modulo'        => 'Clientes',
                'icono'         => 'ti-users',
                'link'          => '/clientes',
                'es_catalogo'   => true
            ],
            [
                'modulo'        => 'Proveedores',
                'icono'         => 'ti-truck',
                'link'          => '/proveedores',
                'es_catalogo'   => true
            ],
            [
                'modulo'        => 'Usuarios',
                'icono'         => 'ti-user',
                'link'          => '/usuarios',
                'es_catalogo'   => true
            ],
            [
                'modulo'        => 'Categorias',
                'icono'         => 'ti-box',
                'link'          => '/categorias',
                'es_catalogo'   => true
            ],
            [
                'modulo'        => 'Marcas',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'es_catalogo'   => true
            ],
            [
                'modulo'        => 'Unidades de medida',
                'icono'         => 'ti-ruler-2',
                'link'          => '/unidad-medidas',
                'es_catalogo'   => true
            ]
        ];
        DB::table('modulos')->insert($data);
    }
}
