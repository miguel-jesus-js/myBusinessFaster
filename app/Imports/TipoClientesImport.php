<?php

namespace App\Imports;

use App\Models\TipoCliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TipoClientesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TipoCliente([
            'tipo_cliente' => $row['tipo_cliente'],
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
