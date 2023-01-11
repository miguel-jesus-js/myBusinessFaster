<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\User;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $empleados = User::with('roles')->get();
        return view('pdf.empleados_pdf', [
            'empleados' => $empleados,
            'esExcel' => true,
        ]);
    }
}
