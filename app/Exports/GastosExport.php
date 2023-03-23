<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Gasto;

class GastosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $gastos = Gasto::all();
        return view('pdf.gastos_pdf', [
            'gastos' => $gastos,
            'esExcel' => true,
        ]);
    }
}
