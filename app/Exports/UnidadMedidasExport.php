<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\UnidadMedida;

class UnidadMedidasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $unidadMedidas = UnidadMedida::all();
        return view('excel.unidad_medidas', [
            'unidadMedidas' => $unidadMedidas
        ]);
    }
}
