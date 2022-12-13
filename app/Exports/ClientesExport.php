<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Cliente;

class ClientesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $clientes = Cliente::all();
        return view('excel.clientes', [
            'clientes' => $clientes
        ]);
    }
}
