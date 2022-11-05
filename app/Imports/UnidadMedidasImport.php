<?php

namespace App\Imports;

use App\Models\UnidadMedida;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UnidadMedidasImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UnidadMedida([
            'unidad_medida' => $row['unidad_medida'],
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