<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\ProductosSucursal;
use Illuminate\Support\Facades\Auth;

class ProductosSucursalExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $isAdmin = Auth::user()->isAdmin;
        $productos = ProductosSucursal::with(['sucursales', 'productos'])->isAdmin($isAdmin)->get();
        return view('pdf.productos_sucursal_pdf', [
            'productos' => $productos,
            'esExcel' => true,
        ]);
    }
}
