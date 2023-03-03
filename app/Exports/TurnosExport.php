<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Turno;

class TurnosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $turnos = Turno::all();
        return view('pdf.turnos_pdf', [
            'turnos' => $turnos,
            'esExcel' => true,
        ]);
    }
}
