<?php

namespace App\Imports;

use App\Models\TipoGasto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TipoGastosImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {
        return new TipoGasto([
            'tipo' => $row['tipo'],
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
