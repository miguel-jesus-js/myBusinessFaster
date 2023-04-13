<?php

namespace App\Imports;

use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ClientesImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
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
                    'nombres'   => $row['nombres'],
                    'email'     => $row['correo'],
                    'telefono'  => $row['telefono'],
                    'rfc'       => $row['rfc'],
                ]);
                Cliente::create([
                    'persona_id'        => $persona->id,
                    'tipo_cliente_id'   => 1,
                    'empresa'           => $row['empresa'],
                    'limite_credito'    => $row['limite_credito'],
                    'dias_credito'      => $row['dias_credito'],
                    'password'          => Hash::make($row['correo']),
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
