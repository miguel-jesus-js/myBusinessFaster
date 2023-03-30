<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\TipoCliente;

class TipoClientesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $tipoClientes = TipoCliente::all();
        return view('pdf.tipo_clientes_pdf', [
            'tipoClientes' => $tipoClientes,
            'esExcel' => true,
        ]);
    }
}
