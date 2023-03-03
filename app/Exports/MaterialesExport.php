<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Materiale;

class MaterialesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $materiales = Materiale::all();
        return view('excel.materiales', [
            'materiales' => $materiales,
            'esExcel' => true,
        ]);
    }
}
