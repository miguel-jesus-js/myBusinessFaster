<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\User;
use App\Models\Role;

class UsersImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            $rol = Role::where('rol', 'LIKE', '%'.$row['rol'].'%')->get();
            User::create([
                'role_id'   => $rol[0]['id'],
                'nombres'   => $row['nombre'],
                'app'       => $row['apellido_p'],
                'apm'       => $row['apellido_m'],
                'email'     => $row['correo'],
                'telefono'  => $row['telefono'],
                'rfc'       => $row['rfc'],
                'password'  => $row['contrasena'],
                'nom_user'  => $row['nombre_usuario'],
                'ciudad'    => $row['ciudad'],
                'estado'    => $row['estado'],
                'municipio' => $row['municipio'],
                'cp'        => $row['cp'],
                'colonia'   => $row['colonia'],
                'calle'     => $row['calle'],
                'n_exterior'=> $row['n_exterior'],
                'n_interior'=> $row['n_interior'],
            ]);
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
