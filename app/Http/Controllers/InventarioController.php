<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;
use App\Exports\InventarioExport;
use PDF;


class InventarioController extends Controller
{
    public function getInventario($tipo, $inventario, Request $request)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $salidas = Inventario::with(['producto'])->withTrashed()->producto($filtro)->when($inventario == 0 || $inventario == 1, function($query) use ($inventario){
                    return $query->with(['sucursal','user', 'user.persona', 'almacen'])->where('tipo', $inventario);
                })->when($inventario == 2, function($query){
                    return $query->select(
                        'inventarios.producto_id', 
                        DB::raw('SUM(CASE WHEN tipo = 0 THEN cantidad ELSE 0 END) as salidas'), 
                        DB::raw('SUM(CASE WHEN tipo = 1 THEN cantidad ELSE 0 END) as entradas'))
                        ->groupBy('inventarios.producto_id');
                })->get();
                break;
            case 1:
                $salidas = Inventario::with(['producto'])->onlyTrashed()->producto($filtro)->when($inventario == 0 || $inventario == 1, function($query) use ($inventario){
                    return $query->with(['sucursal','user', 'user.persona', 'almacen'])->where('tipo', $inventario);
                })->when($inventario == 2, function($query){
                    return $query->select( 
                        'inventarios.producto_id', 
                        DB::raw('SUM(CASE WHEN tipo = 0 THEN cantidad ELSE 0 END) as salidas)'), 
                        DB::raw('SUM(CASE WHEN tipo = 1 THEN cantidad ELSE 0 END) as entradas'))
                        ->groupBy('inventarios.producto_id');
                })->get();
                break;
            case 2:
                $salidas = Inventario::with(['producto'])->whereNull('inventarios.deleted_at')->producto($filtro)->when($inventario == 0 || $inventario == 1, function($query) use ($inventario){
                    return $query->with(['sucursal','user', 'user.persona', 'almacen'])->where('tipo', $inventario);
                })->when($inventario == 2, function($query){
                    return $query->select( 
                        DB::raw('MIN(inventarios.id) as id'), 
                        'inventarios.producto_id', 
                        DB::raw('SUM(CASE WHEN tipo = 0 THEN cantidad ELSE 0 END) as salidas'), 
                        DB::raw('SUM(CASE WHEN tipo = 1 THEN cantidad ELSE 0 END) as entradas'))
                        ->groupBy('inventarios.producto_id');
                })->get();
                break;
        }
        return json_encode($salidas);
    }
    public function exportarPDF($tipo)
    {
        $inventario = Inventario::when($tipo == 0 || $tipo == 1, function($query) use ($tipo){
            return $query->where('tipo', $tipo);
        })->when($tipo == 2, function($query){
            return $query->select(
                'inventarios.producto_id', 
                DB::raw('SUM(CASE WHEN tipo = 0 THEN cantidad ELSE 0 END) as salidas'), 
                DB::raw('SUM(CASE WHEN tipo = 1 THEN cantidad ELSE 0 END) as entradas'))
                ->groupBy('inventarios.producto_id');
        })->get();
        $pdf = Pdf::loadView('pdf.inventario_pdf', ['inventario' => $inventario, 'esExcel' => false, 'tipo' => $tipo]);
        return $pdf->download('Inventario.pdf');
    }
    public function exportarExcel($tipo)
    {
        return Excel::download(new InventarioExport($tipo), 'Inventario.xlsx');
    }
}
