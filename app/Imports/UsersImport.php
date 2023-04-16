<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\Persona;
use App\Models\Role;
use App\Models\User;

class UsersImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param Collection $collection
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
                $rol = Role::where('rol', 'LIKE', '%'.$row['rol'].'%')->get();
                User::create([
                    'persona_id'    => $persona->id,
                    'role_id'       => $rol[0]['id'],
                    'sucursale_id'  => Auth::user()->sucursal->id,
                    'password'      => $row['contrasena'],
                    'nom_user'      => $row['nombre_usuario'],
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
