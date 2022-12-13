<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Marca;

class MarcasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $marcas = Marca::all();
        return view('excel.marcas', [
            'marcas' => $marcas
        ]);
    }
}
