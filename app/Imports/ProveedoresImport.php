<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Persona;
use App\Models\Proveedore;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class ProveedoresImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            try{
                $persona = Persona::create([
                    'nombres'   => $row['nombre'],
                    'email'     => $row['correo'],
                    'telefono'  => $row['telefono'],
                    'rfc'       => $row['rfc'],
                ]);
                Proveedore::create([
                    'persona_id'    => $persona->id,
                    'clave'         => $row['clave'],
                    'empresa'       => $row['empresa'],
                ]);
            }catch(\Exception $e){

            }
        }
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
