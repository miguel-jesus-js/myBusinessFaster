<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ClientesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cliente([
            'nombres'       => $row['nombre'],
            'app'           => $row['apellido_p'],
            'apm'           => $row['apellido_m'],
            'email'         => $row['correo'],
            'telefono'      => $row['telefono'],
            'rfc'           => $row['rfc'],
            'empresa'       => $row['empresa'],
            'ciudad'        => $row['ciudad'],
            'estado'        => $row['estado'],
            'municipio'     => $row['municipio'],
            'cp'            => $row['cp'],
            'password'      => $row['correo'],
            'colonia'       => $row['colonia'],
            'calle'         => $row['calle'],
            'n_exterior'    => $row['n_exterior'],
            'n_interior'    => $row['n_interior'],
            'limite_credito'=> $row['limite_credito'],
            'dias_credito'  => $row['dias_credito'],
        ]);
    }

    public function batchSize(): int
    {
        return 3000;
    }

    public function chunkSize(): int
    {
        return 3000;
    }
}
