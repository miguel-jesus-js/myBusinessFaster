<?php

namespace App\Imports;

use App\Models\Marca;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MarcasImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Marca([
            'marca' => $row['marca'],
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
