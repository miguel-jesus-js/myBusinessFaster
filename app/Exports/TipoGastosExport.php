<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\TipoGasto;  

class TipoGastosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $tipoGastos = TipoGasto::all();
        return view('pdf.tipo_gastos_pdf', [
            'tipoGastos' => $tipoGastos,
            'esExcel' => true,
        ]);
    }
}
