<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\TipoClientesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\UnidadMedidasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\DireccionesEntregasController;
use App\Http\Controllers\AlmacenesController;
use App\Http\Controllers\CaracteristicasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ConfiguracionesController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\ProductosSucursalController;
use App\Http\Controllers\TipoGastosController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\CortesController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\InventarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function(){
    //app/Http/Middleware/RedirectIfAuthenticated.php
    Route::get('/', function () {
        return view('welcome');
    })->name('login');
    Route::post('api/session', [LoginController::class, 'session']);
});

Route::get('/token', function () {
    return csrf_token(); 
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/marcas', function () {
        return view('marcas');
    })->middleware('permission:ver_marcas');

    Route::get('/empleados', function () {
        return view('usuarios')->middleware('permission:ver_empleados');
    });
    Route::get('/categorias', function () {
        return view('categorias')->middleware('permission:ver_categorias');
    });
    Route::get('/tipo_clientes', function () {
        return view('tipo_clientes')->middleware('permission:ver_tipo_clientes');
    });
    Route::get('/unidad_medidas', function () {
        return view('unidad_medidas');
    })->middleware('permission:ver_unidad_medidas');
    Route::get('/proveedores', function () {
        return view('proveedores');
    })->middleware('permission:ver_proveedores');
    Route::get('/clientes', function () {
        return view('clientes');
    })->middleware('permission:ver_clientes');
    Route::get('/productos', function () {
        return view('productos');
    })->middleware('permission:ver_productos');
    Route::get('/almacenes', function () {
        return view('almacenes');
    })->middleware('permission:ver_almacenes');
    Route::get('/turnos', function () {
        return view('turnos');
    })->middleware('permission:ver_turnos');
    Route::get('/sucursales', function () {
        return view('sucursales');
    })->middleware('permission:ver_sucursales');
    Route::get('/tipo_gastos', function () {
        return view('tipo_gastos');
    })->middleware('permission:ver_tipo_gastos');
    Route::get('/punto-de-venta', [VentasController::class, 'puntoVenta'])->middleware('permission:ver_venta_menudeo|permission:ver_venta_mayoreo|ver_venta_credito');
    Route::get('/historial', function () {
        return view('historial');
    })->middleware('permission:ver_historial');
    Route::get('/entradas', function () {
        return view('entradas');
    })->middleware('permission:ver_entradas');
    Route::get('/salidas', function () {
        return view('salidas');
    })->middleware('permission:ver_salidas');
    Route::get('/inventario', function () {
        return view('inventario');
    })->middleware('permission:ver_inventario');
    Route::get('/asignar_productos', function () {
        return view('asignar_productos');
    })->middleware('permission:ver_asignar_productos');
    Route::get('/gastos', function () {
        return view('gastos');
    })->middleware('permission:ver_gastos');
    Route::get('corte_caja', [CortesController::class, 'index'])->middleware('permission:ver_corte_caja');
    Route::get('/produccion', function () {
        return view('produccion');
    })->middleware('permission:ver_produccion');
    Route::get('cuentas_por_cobrar', [PagosController::class, 'realizarPagos'])->middleware('permission:ver_cuentas_cobrar');
    Route::get('/compras', function () {
        return view('compras');
    })->middleware('permission:ver_compras');
    Route::get('/settings', function () {
        return view('settings');
    })->middleware('permission:ver_configuración');
    Route::get('/roles', function () {
        return view('roles');
    })->middleware('permission:ver_roles');    

    Route::get('/catalogos', function () {
        return view('catalogos');
    });
    //apis marcas
    Route::get('api/getMarcas/{tipo}', [MarcasController::class, 'index'])->middleware('permission:ver_marcas');
    Route::post('api/addMarcas', [MarcasController::class, 'create'])->middleware('permission:agregar_marcas');
    Route::put('api/updateMarcas', [MarcasController::class, 'update'])->middleware('permission:editar_marcas');
    Route::delete('api/deleteMarcas/{id}', [MarcasController::class, 'delete'])->middleware('permission:eliminar_marcas');
    Route::get('api/downloadPlantillaMarca', [MarcasController::class, 'downloadPlantilla'])->middleware('permission:agregar_marcas');
    Route::post('api/uploadMarca', [MarcasController::class, 'uploadMarca'])->middleware('permission:agregar_marcas');
    Route::get('api/exportarPdfMarca', [MarcasController::class, 'exportarPDF'])->middleware('permission:ver_marcas');
    Route::get('api/exportarExcelMarca', [MarcasController::class, 'exportarExcel'])->middleware('permission:ver_marcas');
    //apis usuarios
    Route::get('api/getUsuarios/{tipo}', [UsersController::class, 'index'])->middleware('permission:ver_empleados');
    Route::post('api/addUsuarios', [UsersController::class, 'create'])->middleware('permission:agregar_empleados');
    Route::put('api/updateUsuarios', [UsersController::class, 'update'])->middleware('permission:editar_empleados');
    Route::delete('api/deleteUsuarios/{id}', [UsersController::class, 'delete'])->middleware('permission:eliminar_empleados');
    Route::get('api/downloadPlantillaUsuario', [UsersController::class, 'downloadPlantilla'])->middleware('permission:agregar_empleados');
    Route::post('api/uploadUsuario', [UsersController::class, 'uploadUsuario'])->middleware('permission:agregar_empleados');
    Route::get('api/exportarPdfUsuario', [UsersController::class, 'exportarPDF'])->middleware('permission:ver_empleados');
    Route::get('api/exportarExcelUsuario', [UsersController::class, 'exportarExcel'])->middleware('permission:ver_empleados');
    //apis categorias
    Route::get('api/getCategorias/{tipo}', [CategoriasController::class, 'index'])->middleware('permission:ver_categorias');
    Route::post('api/addCategorias', [CategoriasController::class, 'create'])->middleware('permission:agregar_categorias');
    Route::put('api/updateCategorias', [CategoriasController::class, 'update'])->middleware('permission:editar_categorias');
    Route::delete('api/deleteCategorias/{id}', [CategoriasController::class, 'delete'])->middleware('permission:eliminar_categorias');
    Route::get('api/downloadPlantillaCategoria', [CategoriasController::class, 'downloadPlantilla'])->middleware('permission:agregar_categorias');
    Route::post('api/uploadCategoria', [CategoriasController::class, 'uploadCategoria'])->middleware('permission:agregar_categorias');
    Route::get('api/exportarPdfCategoria', [CategoriasController::class, 'exportarPDF'])->middleware('permission:ver_categorias');
    Route::get('api/exportarExcelCategoria', [CategoriasController::class, 'exportarExcel'])->middleware('permission:ver_categorias');
    //apis tipo de clientes
    Route::get('api/getTipoClientes/{tipo}', [TipoClientesController::class, 'index'])->middleware('permission:ver_tipo_clientes');
    Route::post('api/addTipoClientes', [TipoClientesController::class, 'create'])->middleware('permission:agregar_tipo_clientes');
    Route::put('api/updateTipoClientes', [TipoClientesController::class, 'update'])->middleware('permission:editar_tipo_clientes');
    Route::delete('api/deleteTipoClientes/{id}', [TipoClientesController::class, 'delete'])->middleware('permission:eliminar_tipo_clientes');
    Route::get('api/downloadPlantillaTipoCliente', [TipoClientesController::class, 'downloadPlantilla'])->middleware('permission:agregar_tipo_clientes');
    Route::post('api/uploadTipoCliente', [TipoClientesController::class, 'uploadTipoCliente'])->middleware('permission:agregar_tipo_clientes');
    Route::get('api/exportarPdfTipoCliente', [TipoClientesController::class, 'exportarPDF'])->middleware('permission:ver_tipo_clientes');
    Route::get('api/exportarExcelTipoCliente', [TipoClientesController::class, 'exportarExcel'])->middleware('permission:ver_tipo_clientes');
    //apis unida de medidas
    Route::get('api/getUnidadMedidas/{tipo}', [UnidadMedidasController::class, 'index'])->middleware('permission:ver_unidad_medidas');
    Route::post('api/addUnidadMedidas', [UnidadMedidasController::class, 'create'])->middleware('permission:agregar_unidad_medidas');
    Route::put('api/updateUnidadMedidas', [UnidadMedidasController::class, 'update'])->middleware('permission:editar_unidad_medidas');
    Route::delete('api/deleteUnidadMedidas/{id}', [UnidadMedidasController::class, 'delete'])->middleware('permission:eliminar_unidad_medidas');
    Route::get('api/downloadPlantillaUnidadMedida', [UnidadMedidasController::class, 'downloadPlantilla'])->middleware('permission:agregar_unidad_medidas');
    Route::post('api/uploadUnidadMedida', [UnidadMedidasController::class, 'uploadUnidadMedida'])->middleware('permission:agregar_unidad_medidas');
    Route::get('api/exportarPdfUnidadMedida', [UnidadMedidasController::class, 'exportarPDF'])->middleware('permission:ver_unidad_medidas');
    Route::get('api/exportarExcelUnidadMedida', [UnidadMedidasController::class, 'exportarExcel'])->middleware('permission:ver_unidad_medidas');
    //apis proveedores
    Route::get('api/getProveedores/{filtro}', [ProveedoresController::class, 'index'])->middleware('permission:ver_proveedores');
    Route::post('api/addProveedores', [ProveedoresController::class, 'create'])->middleware('permission:agregar_proveedores');
    Route::put('api/updateProveedores', [ProveedoresController::class, 'update'])->middleware('permission:editar_proveedores');
    Route::delete('api/deleteProveedores/{id}', [ProveedoresController::class, 'delete'])->middleware('permission:eliminar_proveedores');
    Route::get('api/downloadPlantillaProveedor', [ProveedoresController::class, 'downloadPlantilla'])->middleware('permission:agregar_proveedores');
    Route::post('api/uploadProveedor', [ProveedoresController::class, 'uploadProveedor'])->middleware('permission:agregar_proveedores');
    Route::get('api/exportarPdfProveedor', [ProveedoresController::class, 'exportarPDF'])->middleware('permission:ver_proveedores');
    Route::get('api/exportarExcelProveedor', [ProveedoresController::class, 'exportarExcel'])->middleware('permission:ver_proveedores');
    //apis clientes
    Route::get('api/getClientes/{tipo}', [ClientesController::class, 'index'])->middleware('permission:ver_clientes');
    Route::post('api/addClientes', [ClientesController::class, 'create'])->middleware('permission:agregar_clientes');
    Route::put('api/updateClientes', [ClientesController::class, 'update'])->middleware('permission:editar_clientes');
    Route::delete('api/deleteClientes/{id}', [ClientesController::class, 'delete'])->middleware('permission:eliminar_clientes');
    Route::get('api/downloadPlantillaCliente', [ClientesController::class, 'downloadPlantilla'])->middleware('permission:agregar_clientes');
    Route::post('api/uploadCliente', [ClientesController::class, 'uploadCliente'])->middleware('permission:agregar_clientes');
    Route::get('api/exportarPdfCliente', [ClientesController::class, 'exportarPDF'])->middleware('permission:ver_clientes');
    Route::get('api/exportarExcelCliente', [ClientesController::class, 'exportarExcel'])->middleware('permission:ver_clientes');
    //apis productos
    Route::get('api/getProductos/{filtro}', [ProductosController::class, 'index'])->middleware('permission:ver_productos');
    Route::post('api/addProductos', [ProductosController::class, 'create'])->middleware('permission:agregar_productos');
    Route::put('api/updateProductos', [ProductosController::class, 'update'])->middleware('permission:editar_productos');
    Route::get('api/showProducto/{id}', [ProductosController::class, 'show'])->middleware('permission:ver_productos')->name('showProducto');
    Route::delete('api/deleteProductos/{id}', [ProductosController::class, 'delete'])->middleware('permission:eliminar_productos');
    Route::delete('api/deleteCaract/{id}', [ProductosController::class, 'deleteCaract'])->middleware('permission:editar_productos');
    Route::delete('api/deleteImg/{id}', [ProductosController::class, 'deleteImg'])->middleware('permission:editar_productos');
    Route::get('api/generateCodBarra', [ProductosController::class, 'generateCodBarra'])->middleware('permission:agregar_productos');
    Route::get('api/generateCodSat', [ProductosController::class, 'generateCodSat'])->middleware('permission:agregar_productos');
    Route::get('api/downloadPlantillaProducto', [ProductosController::class, 'downloadPlantilla'])->middleware('permission:agregar_productos');
    Route::post('api/uploadProducto', [ProductosController::class, 'uploadProducto'])->middleware('permission:ver_productos');
    Route::get('api/exportarPdfProducto', [ProductosController::class, 'exportarPDF'])->middleware('permission:ver_productos');
    Route::get('api/exportarExcelProducto', [ProductosController::class, 'exportarExcel'])->middleware('permission:ver_productos');
    //apis características
    Route::post('api/addCaracteristicas', [CaracteristicasController::class, 'create'])->middleware('permission:agregar_productos|permission:editar_productos');
    Route::post('api/addCaracteristicasTable', [CaracteristicasController::class, 'createTable'])->middleware('permission:agregar_productos|permission:editar_productos');
    //apis almacenes
    Route::get('api/getAlmacenes/{tipo}', [AlmacenesController::class, 'index'])->middleware('permission:ver_almacenes');
    Route::post('api/addAlmacenes', [AlmacenesController::class, 'create'])->middleware('permission:agregar_almacenes');
    Route::put('api/updateAlmacenes', [AlmacenesController::class, 'update'])->middleware('permission:editar_almacenes');
    Route::delete('api/deleteAlmacenes/{id}', [AlmacenesController::class, 'delete'])->middleware('permission:eliminar_almacenes');
    Route::get('api/downloadPlantillaAlmacen', [AlmacenesController::class, 'downloadPlantilla'])->middleware('permission:agregar_almacenes');
    Route::post('api/uploadAlmacen', [AlmacenesController::class, 'uploadAlmacen'])->middleware('permission:agregar_almacenes');
    Route::get('api/exportarPdfAlmacen', [AlmacenesController::class, 'exportarPDF'])->middleware('permission:ver_almacenes');
    Route::get('api/exportarExcelAlmacen', [AlmacenesController::class, 'exportarExcel'])->middleware('permission:ver_almacenes');
    //apis turnos
    Route::get('api/getTurnos/{tipo}', [TurnosController::class, 'index'])->middleware('permission:ver_turnos');
    Route::post('api/addTurnos', [TurnosController::class, 'create'])->middleware('permission:agregar_turnos');
    Route::put('api/updateTurnos', [TurnosController::class, 'update'])->middleware('permission:editar_turnos');
    Route::delete('api/deleteTurnos/{id}', [TurnosController::class, 'delete'])->middleware('permission:eliminar_turnos');
    Route::get('api/downloadPlantillaTurno', [TurnosController::class, 'downloadPlantilla'])->middleware('permission:agregar_turnos');
    Route::post('api/uploadTurno', [TurnosController::class, 'uploadTurno'])->middleware('permission:agregar_turnos');
    Route::get('api/exportarPdfTurno', [TurnosController::class, 'exportarPDF'])->middleware('permission:ver_turnos');
    Route::get('api/exportarExcelTurno', [TurnosController::class, 'exportarExcel'])->middleware('permission:ver_turnos');
    //apis sucursales
    Route::get('api/getSucursales/{tipo}', [SucursalesController::class, 'index'])->middleware('permission:ver_sucursales');
    Route::post('api/addSucursales', [SucursalesController::class, 'create'])->middleware('permission:agregar_sucursales');
    Route::put('api/updateSucursales', [SucursalesController::class, 'update'])->middleware('permission:editar_sucursales');
    Route::delete('api/deleteSucursales/{id}', [SucursalesController::class, 'delete'])->middleware('permission:eliminar_sucursales');
    Route::get('api/downloadPlantillaSucursal', [SucursalesController::class, 'downloadPlantilla'])->middleware('permission:agregar_sucursales');
    Route::post('api/uploadSucursal', [SucursalesController::class, 'uploadSucursal'])->middleware('permission:agregar_sucursales');
    Route::get('api/exportarPdfSucursal', [SucursalesController::class, 'exportarPDF'])->middleware('permission:ver_sucursales');
    Route::get('api/exportarExcelSucursal', [SucursalesController::class, 'exportarExcel'])->middleware('permission:ver_sucursales');
    //apis tipo de gastos
    Route::get('api/getTipoGastos/{tipo}', [TipoGastosController::class, 'index'])->middleware('permission:ver_tipo_gastos');
    Route::post('api/addTipoGastos', [TipoGastosController::class, 'create'])->middleware('permission:agregar_tipo_gastos');
    Route::put('api/updateTipoGastos', [TipoGastosController::class, 'update'])->middleware('permission:editar_tipo_gastos');
    Route::delete('api/deleteTipoGastos/{id}', [TipoGastosController::class, 'delete'])->middleware('permission:eliminar_tipo_gastos');
    Route::get('api/downloadPlantillaTipoGastos', [TipoGastosController::class, 'downloadPlantilla'])->middleware('permission:agregar_tipo_gastos');
    Route::post('api/uploadTipoGastos', [TipoGastosController::class, 'uploadTipoGastos'])->middleware('permission:agregar_tipo_gastos');
    Route::get('api/exportarPdfTipoGastos', [TipoGastosController::class, 'exportarPDF'])->middleware('permission:ver_tipo_gastos');
    Route::get('api/exportarExcelTipoGastos', [TipoGastosController::class, 'exportarExcel'])->middleware('permission:ver_tipo_gastos');
    //apis punto de venta
    Route::post('api/addVenta', [VentasController::class, 'create'])->middleware('permission:agregar_venta_menudeo|permission:agregar_venta_mayoreo|agregar_venta_credito|permission:agregar_compras');
    Route::post('api/searchProductForSale', [ProductosController::class, 'searchProductForSale'])->middleware('permission:ver_venta_menudeo|permission:ver_venta_mayoreo|ver_venta_credito');
    //apis historial
    Route::get('api/getVentas/{tipo}', [VentasController::class, 'index'])->middleware('permission:ver_historial');
    Route::get('detalle/{id}', [VentasController::class, 'show'])->middleware('permission:ver_historial');
    Route::get('api/remision/{id}', [VentasController::class, 'remision'])->middleware('permission:ver_historial');    
    Route::get('api/ticket/{id}', [VentasController::class, 'ticket'])->middleware('permission:ver_historial');    
    Route::get('api/searchVenta/{folio}', [VentasController::class, 'searchVenta'])->middleware('permission:ver_historial');
    //apis inventario
    Route::get('api/getInventario/{tipo}/{inventario}', [InventarioController::class, 'getInventario'])->middleware('permission:ver_entradas|permission:ver_salidas|permission:ver_inventario');
    Route::get('api/exportarPdfIventario/{tipo}', [InventarioController::class, 'exportarPDF'])->middleware('permission:ver_entradas|permission:ver_salidas|permission:ver_inventario');
    Route::get('api/exportarExcelIventario/{tipo}', [InventarioController::class, 'exportarExcel'])->middleware('permission:ver_entradas|permission:ver_salidas|permission:ver_inventario');
    //apis prosuctos sucursal
    Route::get('api/getProductosSucursal/{tipo}', [ProductosSucursalController::class, 'index'])->middleware('permission:ver_asignar_productos');
    Route::post('api/addProductosSucursal', [ProductosSucursalController::class, 'create'])->middleware('permission:agregar_asignar_productos');
    Route::put('api/updateProductosSucursal', [ProductosSucursalController::class, 'update'])->middleware('permission:editar_asignar_productos');
    Route::delete('api/deleteProductosSucursal/{id}', [ProductosSucursalController::class, 'delete'])->middleware('permission:eliminar_asignar_productos');
    Route::get('api/getProductosSucursalExist/{sucursal_id}', [ProductosSucursalController::class, 'getProductos'])->middleware('permission:ver_asignar_productos');
    Route::get('api/downloadPlantillaProductosSucursal', [ProductosSucursalController::class, 'downloadPlantilla'])->middleware('permission:agregar_asignar_productos');
    Route::post('api/uploadProductosSucursal', [ProductosSucursalController::class, 'uploadProductosSucursal'])->middleware('permission:agregar_asignar_productos');
    Route::get('api/exportarPdfProductosSucursal', [ProductosSucursalController::class, 'exportarPDF'])->middleware('permission:ver_asignar_productos');
    Route::get('api/exportarExcelProductosSucursal', [ProductosSucursalController::class, 'exportarExcel'])->middleware('permission:ver_asignar_productos');
    //apis tipo de gastos
    Route::get('api/getGastos/{tipo}', [GastosController::class, 'index'])->middleware('permission:ver_gastos');
    Route::post('api/addGastos', [GastosController::class, 'create'])->middleware('permission:agregar_gastos');
    Route::put('api/updateGastos', [GastosController::class, 'update'])->middleware('permission:editar_gastos');
    Route::get('api/detalle_gasto/{id}', [GastosController::class, 'show'])->middleware('permission:ver_gastos');
    Route::delete('api/deleteGastos/{id}', [GastosController::class, 'delete'])->middleware('permission:eliminar_gastos');
    Route::get('api/exportarPdfGastos', [GastosController::class, 'exportarPDF'])->middleware('permission:ver_gastos');
    Route::get('api/exportarExcelGastos', [GastosController::class, 'exportarExcel'])->middleware('permission:ver_gastos');
    //apis corte de caja
    Route::get('printCorteCaja', [CortesController::class, 'print'])->middleware('permission:agregar_corte_caja');
    //apis producción
    Route::get('api/getInsumos/{parentId}', [ProductosController::class, 'getInsumos'])->middleware('permission:ver_produccion');
    Route::post('api/addInsumos', [ProductosController::class, 'createInsumo'])->middleware('permission:agregar_produccion');
    //apis pagos
    Route::put('api/add-pago', [PagosController::class, 'create'])->middleware('permission:agregar_cuentas_cobrar');
    Route::get('api/ticket-pago/{id}', [PagosController::class, 'ticketPago'])->middleware('permission:agregar_cuentas_cobrar');
    //apis settings
    Route::get('api/settings', [ConfiguracionesController::class, 'settings']);
    Route::put('api/updateSettings', [ConfiguracionesController::class, 'update'])->middleware('permission:editar_configuracion');
    Route::put('api/updateSettingsUser', [ConfiguracionesController::class, 'updateSettingsUser']);
    //apis direcciones de entrega
    Route::post('api/addDireccionesEntrega', [DireccionesEntregasController::class, 'create'])->middleware('permission:agregar_empleados|permission:agregar_clientes|permission:agregar_proveedores|permission:editar_empleados|permission:editar_clientes|permission:editar_proveedores');
    Route::post('api/addDireccionesEntregaTable', [DireccionesEntregasController::class, 'createTable'])->middleware('permission:agregar_empleados|permission:agregar_clientes|permission:agregar_proveedores|permission:editar_empleados|permission:editar_clientes|permission:editar_proveedores');
    //apis roles
    Route::get('api/getRoles/', [RolesController::class, 'index'])->middleware('permission:ver_roles');
    Route::post('api/addRoles', [RolesController::class, 'create'])->middleware('permission:agregar_roles');
    Route::get('api/getModulos', [ModulosController::class, 'index'])->middleware('permission:ver_roles');
    //apis dashboard
    Route::get('api/saleByEmployees', [VentasController::class, 'saleByEmployees']);
    Route::get('/dashboard', [VentasController::class, 'dashboard']);
    //api cerrar sessión
    Route::post('api/logout', [LoginController::class, 'logout']);
});