<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Sucursale;

class SucursalesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $sucursales = Sucursale::with('responsable')->get();
        return view('pdf.sucursales_pdf', [
            'sucursales' => $sucursales,
            'esExcel' => true,
        ]);
    }
}
