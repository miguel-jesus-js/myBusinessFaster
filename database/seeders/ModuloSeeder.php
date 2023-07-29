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
            //Catalogos
            [
                'modulo'        => 'Marcas',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Empleados',
                'icono'         => 'ti-user',
                'link'          => '/usuarios',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Categorias',
                'icono'         => 'ti-box',
                'link'          => '/categorias',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Tipo de clientes',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Unidades de medida',
                'icono'         => 'ti-ruler-2',
                'link'          => '/unidad-medidas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Proveedores',
                'icono'         => 'ti-truck',
                'link'          => '/proveedores',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Clientes',
                'icono'         => 'ti-users',
                'link'          => '/clientes',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Productos',
                'icono'         => 'ti-brand-producthunt',
                'link'          => '/productos',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Materiales',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Almacenes',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Turnos',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Sucursales',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Tipo de gastos',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            //ventas
            [
                'modulo'        => 'Venta a menudeo',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Venta a mayoreo',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Venta a crédito',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Historial de ventas',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            //Inventario
            [
                'modulo'        => 'Entradas',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Salidas',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Inventario',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            //
            [
                'modulo'        => 'Asignar productos',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Gastos',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Corte de caja',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Producción',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Cuentas por cobrar',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Compras',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Configuración',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/marcas',
                'is_accordion'   => true
            ],
            [
                'modulo'        => 'Roles',
                'icono'         => 'ti-brand-airtable',
                'link'          => '/roles',
                'is_accordion'   => true
            ],
        ];
        DB::table('modulos')->insert($data);
    }
}
