<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Almacene;

class AlmacenesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $almacenes = Almacene::all();
        return view('pdf.almacenes_pdf', [
            'almacenes' => $almacenes,
            'esExcel' => true,
        ]);
    }
}
