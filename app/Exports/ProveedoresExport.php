<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Proveedore;


class ProveedoresExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $proveedores = Proveedore::with('persona')->get();
        return view('pdf.proveedores_pdf', [
            'proveedores' => $proveedores,
            'esExcel' => true,
        ]);
    }
}
