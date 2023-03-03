<?php

namespace App\Imports;

use App\Models\Sucursale;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SucursalesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $responsable = User::where('nombres', 'LIKE', '%'.$row['responsable'].'%')
                            ->orWhere('app', 'LIKE', '%'.$row['responsable'].'%')
                            ->orWhere('apm', 'LIKE', '%'.$row['responsable'].'%')
                            ->get();
        return new Sucursale([
            'user_id'       => sizeof($responsable) > 0 ? $responsable[0]['id'] : null,
            'nombre'        => $row['nombre'],
            'correo'        => $row['correo'],
            'telefono'      => $row['telefono'],
            'rfc'           => $row['rfc'],
            'ciudad'        => $row['ciudad'],
            'estado'        => $row['estado'],
            'municipio'     => $row['municipio'],
            'cp'            => $row['cp'],
            'password'      => $row['correo'],
            'colonia'       => $row['colonia'],
            'calle'         => $row['calle'],
            'n_exterior'    => $row['n_exterior'],
            'facebook'      => $row['facebook'],
            'twitter'       => $row['twitter'],
            'instagram'     => $row['instagram'],
            'tiktok'        => $row['tiktok'],
            'whatsapp'      => $row['numero_whatsapp'],
            'mensaje'       => $row['mensaje'],
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
