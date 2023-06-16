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
use App\Http\Controllers\ProduccionController;

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
    Route::get('/settings', function () {
        return view('settings');
    });
    Route::get('/catalogos', function () {
        return view('catalogos');
    });
    Route::get('/empleados', function () {
        return view('usuarios');
    });
    Route::get('/marcas', function () {
        return view('marcas');
    });
    Route::get('/materiales', function () {
        return view('materiales');
    });
    Route::get('/categorias', function () {
        return view('categorias');
    });
    Route::get('/tipo_clientes', function () {
        return view('tipo_clientes');
    });
    Route::get('/unidad_medidas', function () {
        return view('unidad_medidas');
    });
    Route::get('/proveedores', function () {
        return view('proveedores');
    });
    Route::get('/clientes', function () {
        return view('clientes');
    });
    Route::get('/productos', function () {
        return view('productos');
    });
    Route::get('/almacenes', function () {
        return view('almacenes');
    });
    Route::get('/turnos', function () {
        return view('turnos');
    });
    Route::get('/sucursales', function () {
        return view('sucursales');
    });
    Route::get('/asignar_productos', function () {
        return view('asignar_productos');
    });
    Route::get('/historial', function () {
        return view('historial');
    });
    Route::get('/tipo_gastos', function () {
        return view('tipo_gastos');
    });
    Route::get('/gastos', function () {
        return view('gastos');
    });
    Route::get('/produccion', function () {
        return view('produccion');
    });

    Route::get('api/getRoles', [RolesController::class, 'index']);
    Route::get('api/getModulos', [ModulosController::class, 'index']);
    //apis usuarios
    Route::get('api/getUsuarios/{tipo}', [UsersController::class, 'index']);
    Route::post('api/addUsuarios', [UsersController::class, 'create']);
    Route::put('api/updateUsuarios', [UsersController::class, 'update']);
    Route::delete('api/deleteUsuarios/{id}', [UsersController::class, 'delete']);
    Route::get('api/downloadPlantillaUsuario', [UsersController::class, 'downloadPlantilla'])->name('downloadPlantillaUsuario');
    Route::post('api/uploadUsuario', [UsersController::class, 'uploadUsuario']);
    Route::get('api/exportarPdfUsuario', [UsersController::class, 'exportarPDF']);
    Route::get('api/exportarExcelUsuario', [UsersController::class, 'exportarExcel']);
    //apis almacenes
    Route::get('api/getAlmacenes/{tipo}', [AlmacenesController::class, 'index']);
    Route::post('api/addAlmacenes', [AlmacenesController::class, 'create']);
    Route::put('api/updateAlmacenes', [AlmacenesController::class, 'update']);
    Route::delete('api/deleteAlmacenes/{id}', [AlmacenesController::class, 'delete']);
    Route::get('api/downloadPlantillaAlmacen', [AlmacenesController::class, 'downloadPlantilla']);
    Route::post('api/uploadAlmacen', [AlmacenesController::class, 'uploadAlmacen']);
    Route::get('api/exportarPdfAlmacen', [AlmacenesController::class, 'exportarPDF']);
    Route::get('api/exportarExcelAlmacen', [AlmacenesController::class, 'exportarExcel']);
    //apis marcas
    Route::get('api/getMarcas/{tipo}', [MarcasController::class, 'index']);
    Route::post('api/addMarcas', [MarcasController::class, 'create']);
    Route::put('api/updateMarcas', [MarcasController::class, 'update']);
    Route::delete('api/deleteMarcas/{id}', [MarcasController::class, 'delete']);
    Route::get('api/downloadPlantillaMarca', [MarcasController::class, 'downloadPlantilla'])->name('downloadPlantillaMarca');
    Route::post('api/uploadMarca', [MarcasController::class, 'uploadMarca']);
    Route::get('api/exportarPdfMarca', [MarcasController::class, 'exportarPDF']);
    Route::get('api/exportarExcelMarca', [MarcasController::class, 'exportarExcel']);
    //apis materiales
    Route::get('api/getMateriales/{tipo}', [MaterialesController::class, 'index']);
    Route::post('api/addMateriales', [MaterialesController::class, 'create']);
    Route::put('api/updateMateriales', [MaterialesController::class, 'update']);
    Route::delete('api/deleteMateriales/{id}', [MaterialesController::class, 'delete']);
    Route::get('api/downloadPlantillaMaterial', [MaterialesController::class, 'downloadPlantilla'])->name('downloadPlantillaMaterial');
    Route::post('api/uploadMaterial', [MaterialesController::class, 'uploadMaterial']);
    Route::get('api/exportarPdfMaterial', [MaterialesController::class, 'exportarPDF']);
    Route::get('api/exportarExcelMaterial', [MaterialesController::class, 'exportarExcel']);
    //apis categorias
    Route::get('api/getCategorias/{tipo}', [CategoriasController::class, 'index']);
    Route::post('api/addCategorias', [CategoriasController::class, 'create']);
    Route::put('api/updateCategorias', [CategoriasController::class, 'update']);
    Route::delete('api/deleteCategorias/{id}', [CategoriasController::class, 'delete']);
    Route::get('api/downloadPlantillaCategoria', [CategoriasController::class, 'downloadPlantilla'])->name('downloadPlantillaCategoria');
    Route::post('api/uploadCategoria', [CategoriasController::class, 'uploadCategoria']);
    Route::get('api/exportarPdfCategoria', [CategoriasController::class, 'exportarPDF']);
    Route::get('api/exportarExcelCategoria', [CategoriasController::class, 'exportarExcel']);
    //apis tipo de clientes
    Route::get('api/getTipoClientes/{tipo}', [TipoClientesController::class, 'index']);
    Route::post('api/addTipoClientes', [TipoClientesController::class, 'create']);
    Route::put('api/updateTipoClientes', [TipoClientesController::class, 'update']);
    Route::delete('api/deleteTipoClientes/{id}', [TipoClientesController::class, 'delete']);
    Route::get('api/downloadPlantillaTipoCliente', [TipoClientesController::class, 'downloadPlantilla'])->name('downloadPlantillaTipoCliente');
    Route::post('api/uploadTipoCliente', [TipoClientesController::class, 'uploadTipoCliente']);
    Route::get('api/exportarPdfTipoCliente', [TipoClientesController::class, 'exportarPDF']);
    Route::get('api/exportarExcelTipoCliente', [TipoClientesController::class, 'exportarExcel']);
    //apis proveedores
    Route::get('api/getProveedores/{filtro}', [ProveedoresController::class, 'index']);
    Route::post('api/addProveedores', [ProveedoresController::class, 'create']);
    Route::put('api/updateProveedores', [ProveedoresController::class, 'update']);
    Route::delete('api/deleteProveedores/{id}', [ProveedoresController::class, 'delete']);
    Route::get('api/downloadPlantillaProveedor', [ProveedoresController::class, 'downloadPlantilla']);
    Route::post('api/uploadProveedor', [ProveedoresController::class, 'uploadProveedor']);
    Route::get('api/exportarPdfProveedor', [ProveedoresController::class, 'exportarPDF']);
    Route::get('api/exportarExcelProveedor', [ProveedoresController::class, 'exportarExcel']);
    //apis unida de medidas
    Route::get('api/getUnidadMedidas/{tipo}', [UnidadMedidasController::class, 'index']);
    Route::post('api/addUnidadMedidas', [UnidadMedidasController::class, 'create']);
    Route::put('api/updateUnidadMedidas', [UnidadMedidasController::class, 'update']);
    Route::delete('api/deleteUnidadMedidas/{id}', [UnidadMedidasController::class, 'delete']);
    Route::get('api/downloadPlantillaUnidadMedida', [UnidadMedidasController::class, 'downloadPlantilla'])->name('downloadPlantillaUnidadMedida');
    Route::post('api/uploadUnidadMedida', [UnidadMedidasController::class, 'uploadUnidadMedida']);
    Route::get('api/exportarPdfUnidadMedida', [UnidadMedidasController::class, 'exportarPDF']);
    Route::get('api/exportarExcelUnidadMedida', [UnidadMedidasController::class, 'exportarExcel']);
    //apis clientes
    Route::get('api/getClientes/{tipo}', [ClientesController::class, 'index']);
    Route::post('api/addClientes', [ClientesController::class, 'create']);
    Route::put('api/updateClientes', [ClientesController::class, 'update']);
    Route::delete('api/deleteClientes/{id}', [ClientesController::class, 'delete']);
    Route::get('api/downloadPlantillaCliente', [ClientesController::class, 'downloadPlantilla'])->name('downloadPlantillaCliente');
    Route::post('api/uploadCliente', [ClientesController::class, 'uploadCliente']);
    Route::get('api/exportarPdfCliente', [ClientesController::class, 'exportarPDF']);
    Route::get('api/exportarExcelCliente', [ClientesController::class, 'exportarExcel']);
    //apis productos
    Route::get('api/getProductos/{filtro}', [ProductosController::class, 'index']);
    Route::post('api/addProductos', [ProductosController::class, 'create']);
    Route::post('api/addInsumos', [ProductosController::class, 'createInsumo']);
    Route::put('api/updateProductos', [ProductosController::class, 'update']);
    Route::get('api/showProducto/{id}', [ProductosController::class, 'show'])->name('showProducto');
    Route::delete('api/deleteProductos/{id}', [ProductosController::class, 'delete']);
    Route::delete('api/deleteCaract/{id}', [ProductosController::class, 'deleteCaract']);
    Route::delete('api/deleteImg/{id}', [ProductosController::class, 'deleteImg']);
    Route::get('api/generateCodBarra', [ProductosController::class, 'generateCodBarra']);
    Route::get('api/generateCodSat', [ProductosController::class, 'generateCodSat']);
    Route::get('api/downloadPlantillaProducto', [ProductosController::class, 'downloadPlantilla'])->name('downloadPlantillaProducto');
    Route::post('api/uploadProducto', [ProductosController::class, 'uploadProducto']);
    Route::get('api/exportarPdfProducto', [ProductosController::class, 'exportarPDF']);
    Route::get('api/exportarExcelProducto', [ProductosController::class, 'exportarExcel']);
    Route::post('api/searchProductForSale', [ProductosController::class, 'searchProductForSale']);
    Route::get('api/getProductosBySucursal/{sucursaId}', [ProductosController::class, 'getProductosBySucursal']);
    Route::get('api/getInsumos/{parentId}', [ProductosController::class, 'getInsumos']);
    //apis turnos
    Route::get('api/getTurnos/{tipo}', [TurnosController::class, 'index']);
    Route::post('api/addTurnos', [TurnosController::class, 'create']);
    Route::put('api/updateTurnos', [TurnosController::class, 'update']);
    Route::delete('api/deleteTurnos/{id}', [TurnosController::class, 'delete']);
    Route::get('api/downloadPlantillaTurno', [TurnosController::class, 'downloadPlantilla']);
    Route::post('api/uploadTurno', [TurnosController::class, 'uploadTurno']);
    Route::get('api/exportarPdfTurno', [TurnosController::class, 'exportarPDF']);
    Route::get('api/exportarExcelTurno', [TurnosController::class, 'exportarExcel']);
    //apis sucursales
    Route::get('api/getSucursales/{tipo}', [SucursalesController::class, 'index']);
    Route::post('api/addSucursales', [SucursalesController::class, 'create']);
    Route::put('api/updateSucursales', [SucursalesController::class, 'update']);
    Route::delete('api/deleteSucursales/{id}', [SucursalesController::class, 'delete']);
    Route::get('api/downloadPlantillaSucursal', [SucursalesController::class, 'downloadPlantilla']);
    Route::post('api/uploadSucursal', [SucursalesController::class, 'uploadSucursal']);
    Route::get('api/exportarPdfSucursal', [SucursalesController::class, 'exportarPDF']);
    Route::get('api/exportarExcelSucursal', [SucursalesController::class, 'exportarExcel']);
    //apis prosuctos sucursal
    Route::get('api/getProductosSucursal/{tipo}', [ProductosSucursalController::class, 'index']);
    Route::post('api/addProductosSucursal', [ProductosSucursalController::class, 'create']);
    Route::put('api/updateProductosSucursal', [ProductosSucursalController::class, 'update']);
    Route::delete('api/deleteProductosSucursal/{id}', [ProductosSucursalController::class, 'delete']);
    Route::get('api/getProductosSucursalExist/{sucursal_id}', [ProductosSucursalController::class, 'getProductos']);
    Route::get('api/downloadPlantillaProductosSucursal', [ProductosSucursalController::class, 'downloadPlantilla']);
    Route::post('api/uploadProductosSucursal', [ProductosSucursalController::class, 'uploadProductosSucursal']);
    Route::get('api/exportarPdfProductosSucursal', [ProductosSucursalController::class, 'exportarPDF']);
    Route::get('api/exportarExcelProductosSucursal', [ProductosSucursalController::class, 'exportarExcel']);
    //apis direcciones de entrega
    Route::post('api/addDireccionesEntrega', [DireccionesEntregasController::class, 'create']);
    Route::post('api/addDireccionesEntregaTable', [DireccionesEntregasController::class, 'createTable']);
    //apis características
    Route::post('api/addCaracteristicas', [CaracteristicasController::class, 'create']);
    Route::post('api/addCaracteristicasTable', [CaracteristicasController::class, 'createTable']);
    //apis settings
    Route::get('api/settings', [ConfiguracionesController::class, 'settings']);
    Route::put('api/updateSettings', [ConfiguracionesController::class, 'update']);
    Route::put('api/updateSettingsUser', [ConfiguracionesController::class, 'updateSettingsUser']);
    //apis punto de venta
    Route::get('/punto-de-venta', [VentasController::class, 'puntoVenta']);
    Route::get('/dashboard', [VentasController::class, 'dashboard']);
    Route::post('api/addVenta', [VentasController::class, 'create']);
    Route::get('api/getVentas/{tipo}', [VentasController::class, 'index']);
    Route::get('api/detalle_venta/{id}', [VentasController::class, 'show']);
    Route::get('api/remision/{id}', [VentasController::class, 'remision']);    
    Route::get('api/ticket/{id}', [VentasController::class, 'ticket']);    
    Route::get('api/saleByEmployees', [VentasController::class, 'saleByEmployees']);
    Route::get('api/searchVenta/{folio}', [VentasController::class, 'searchVenta']);
    //apis tipo de gastos
    Route::get('api/getTipoGastos/{tipo}', [TipoGastosController::class, 'index']);
    Route::post('api/addTipoGastos', [TipoGastosController::class, 'create']);
    Route::put('api/updateTipoGastos', [TipoGastosController::class, 'update']);
    Route::delete('api/deleteTipoGastos/{id}', [TipoGastosController::class, 'delete']);
    Route::get('api/downloadPlantillaTipoGastos', [TipoGastosController::class, 'downloadPlantilla']);
    Route::post('api/uploadTipoGastos', [TipoGastosController::class, 'uploadTipoGastos']);
    Route::get('api/exportarPdfTipoGastos', [TipoGastosController::class, 'exportarPDF']);
    Route::get('api/exportarExcelTipoGastos', [TipoGastosController::class, 'exportarExcel']);
    //apis tipo de gastos
    Route::get('api/getGastos/{tipo}', [GastosController::class, 'index']);
    Route::post('api/addGastos', [GastosController::class, 'create']);
    Route::put('api/updateGastos', [GastosController::class, 'update']);
    Route::get('api/detalle_gasto/{id}', [GastosController::class, 'show']);
    Route::delete('api/deleteGastos/{id}', [GastosController::class, 'delete']);
    Route::get('api/exportarPdfGastos', [GastosController::class, 'exportarPDF']);
    Route::get('api/exportarExcelGastos', [GastosController::class, 'exportarExcel']);
    //apis corte de caja
    Route::get('corte_caja', [CortesController::class, 'index']);
    Route::get('printCorteCaja', [CortesController::class, 'print']);
    //api pagos
    Route::get('cuentas_por_cobrar', [PagosController::class, 'realizarPagos']);
    Route::put('api/add-pago', [PagosController::class, 'create']);
    Route::get('api/ticket-pago/{id}', [PagosController::class, 'ticketPago']);

    //api cerrar sessión
    Route::post('api/logout', [LoginController::class, 'logout']);
});