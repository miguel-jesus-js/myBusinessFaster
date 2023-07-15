<?php

namespace App\Exports;

use App\Models\Inventario;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class InventarioExport implements FromView
{
    protected $tipo;
    public function __construct($tipo)
    {
        $this->tipo = $tipo;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $tipo = $this->tipo;
        $inventario = Inventario::when($tipo == 0 || $tipo == 1, function($query) use ($tipo){
            return $query->where('tipo', $tipo);
        })->when($tipo == 2, function($query){
            return $query->select(
                'inventarios.producto_id', 
                DB::raw('SUM(CASE WHEN tipo = 0 THEN cantidad ELSE 0 END) as salidas'), 
                DB::raw('SUM(CASE WHEN tipo = 1 THEN cantidad ELSE 0 END) as entradas'))
                ->groupBy('inventarios.producto_id');
        })->get();
        return view('pdf.inventario_pdf', [
            'inventario' => $inventario,
            'esExcel' => true,
            'tipo' => $this->tipo,
        ]);
    }
}
