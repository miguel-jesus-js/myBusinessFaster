<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
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
                'modulo_id' => 1,
                'name' => 'ver_marcas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 1,
                'name' => 'agregar_marcas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 1,
                'name' => 'editar_marcas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 1,
                'name' => 'eliminar_marcas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 2,
                'name' => 'ver_empleados',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 2,
                'name' => 'agregar_empleados',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 2,
                'name' => 'editar_empleados',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 2,
                'name' => 'eliminar_empleados',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 3,
                'name' => 'ver_categorías',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 3,
                'name' => 'agregar_categorías',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 3,
                'name' => 'editar_categorías',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 3,
                'name' => 'eliminar_categorías',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 4,
                'name' => 'ver_tipo_clientes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 4,
                'name' => 'agregar_tipo_clientes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 4,
                'name' => 'editar_tipo_clientes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 4,
                'name' => 'eliminar_tipo_clientes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 5,
                'name' => 'ver_unidad_medidas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 5,
                'name' => 'agregar_unidad_medidas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 5,
                'name' => 'editar_unidad_medidas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 5,
                'name' => 'eliminar_unidad_medidas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 6,
                'name' => 'ver_proveedores',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 6,
                'name' => 'agregar_proveedores',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 6,
                'name' => 'editar_proveedores',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 6,
                'name' => 'eliminar_proveedores',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 7,
                'name' => 'ver_clientes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 7,
                'name' => 'agregar_clientes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 7,
                'name' => 'editar_clientes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 7,
                'name' => 'eliminar_clientes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 8,
                'name' => 'ver_productos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 8,
                'name' => 'agregar_productos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 8,
                'name' => 'editar_productos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 8,
                'name' => 'eliminar_productos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 9,
                'name' => 'ver_materiales',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 9,
                'name' => 'agregar_materiales',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 9,
                'name' => 'editar_materiales',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 9,
                'name' => 'eliminar_materiales',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 10,
                'name' => 'ver_almacenes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 10,
                'name' => 'agregar_almacenes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 10,
                'name' => 'editar_almacenes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 10,
                'name' => 'eliminar_almacenes',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 11,
                'name' => 'ver_turnos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 11,
                'name' => 'agregar_turnos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 11,
                'name' => 'editar_turnos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 11,
                'name' => 'eliminar_turnos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 12,
                'name' => 'ver_sucursales',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 12,
                'name' => 'agregar_sucursales',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 12,
                'name' => 'editar_sucursales',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 12,
                'name' => 'eliminar_sucursales',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 13,
                'name' => 'ver_tipo_gastos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 13,
                'name' => 'agregar_tipo_gastos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 13,
                'name' => 'editar_tipo_gastos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 13,
                'name' => 'eliminar_tipo_gastos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 14,
                'name' => 'ver_venta_menudeo',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 14,
                'name' => 'agregar_venta_menudeo',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 14,
                'name' => 'editar_venta_menudeo',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 14,
                'name' => 'eliminar_venta_menudeo',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 15,
                'name' => 'ver_venta_mayoreo',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 15,
                'name' => 'agregar_venta_mayoreo',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 15,
                'name' => 'editar_venta_mayoreo',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 15,
                'name' => 'eliminar_venta_mayoreo',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 16,
                'name' => 'ver_venta_credito',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 16,
                'name' => 'agregar_venta_credito',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 16,
                'name' => 'editar_venta_credito',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 16,
                'name' => 'eliminar_venta_credito',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 17,
                'name' => 'ver_historial',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 17,
                'name' => 'agregar_historial',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 17,
                'name' => 'editar_historial',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 17,
                'name' => 'eliminar_historial',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 18,
                'name' => 'ver_entradas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 18,
                'name' => 'agregar_entradas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 18,
                'name' => 'editar_entradas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 18,
                'name' => 'eliminar_entradas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 19,
                'name' => 'ver_salidas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 19,
                'name' => 'agregar_salidas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 19,
                'name' => 'editar_salidas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 19,
                'name' => 'eliminar_salidas',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 20,
                'name' => 'ver_inventario',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 20,
                'name' => 'agregar_inventario',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 20,
                'name' => 'editar_inventario',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 20,
                'name' => 'eliminar_inventario',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 21,
                'name' => 'ver_asignar_productos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 21,
                'name' => 'agregar_asignar_productos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 21,
                'name' => 'editar_asignar_productos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 21,
                'name' => 'eliminar_asignar_productos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 22,
                'name' => 'ver_gastos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 22,
                'name' => 'agregar_gastos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 22,
                'name' => 'editar_gastos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 22,
                'name' => 'eliminar_gastos',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 23,
                'name' => 'ver_corte_caja',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 23,
                'name' => 'agregar_corte_caja',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 23,
                'name' => 'editar_corte_caja',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 23,
                'name' => 'eliminar_corte_caja',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 24,
                'name' => 'ver_produccion',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 24,
                'name' => 'agregar_produccion',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 24,
                'name' => 'editar_produccion',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 24,
                'name' => 'eliminar_produccion',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 25,
                'name' => 'ver_cuentas_cobrar',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 25,
                'name' => 'agregar_cuentas_cobrar',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 25,
                'name' => 'editar_cuentas_cobrar',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 25,
                'name' => 'eliminar_cuentas_cobrar',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 26,
                'name' => 'ver_compras',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 26,
                'name' => 'agregar_compras',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 26,
                'name' => 'editar_compras',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 26,
                'name' => 'eliminar_compras',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 27,
                'name' => 'ver_configuracion',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 27,
                'name' => 'agregar_configuracion',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 27,
                'name' => 'editar_configuracion',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 27,
                'name' => 'eliminar_configuracion',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 28,
                'name' => 'ver_roles',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 28,
                'name' => 'agregar_roles',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 28,
                'name' => 'editar_roles',
                'guard_name' => 'web'
            ],
            [
                'modulo_id' => 28,
                'name' => 'eliminar_roles',
                'guard_name' => 'web'
            ],
            
        ];
        DB::table('permissions')->insert($data);
        $adminRole = Role::find(1);
        $permissions = Permission::all();
        $adminRole->syncPermissions($permissions);
        $user = User::find(1);
        $user->assignRole($adminRole);
    }
}
