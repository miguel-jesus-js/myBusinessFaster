<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Categoria;


class CategoriasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $categorias = Categoria::all();
        return view('excel.categorias', [
            'categorias' => $categorias,
            'esExcel' => true,
        ]);
    }
}
