<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Proveedore extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'clave',
        'nombres',
        'app',
        'apm',
        'email',
        'telefono',
        'rfc',
        'empresa',
        'ciudad',
        'estado',
        'municipio',
        'cp',
        'colonia',
        'calle',
        'n_exterior',
        'n_interior'
    ];

    public function scopeProveedor($query, $proveedor)
    {
        if($proveedor)
        {
            return $query->where('nombres', 'like', '%'.$proveedor.'%')
                        ->orWhere('app', 'like', '%'.$proveedor.'%')
                        ->orWhere('apm', 'like', '%'.$proveedor.'%')
                        ->orWhere('telefono', 'like', '%'.$proveedor.'%')
                        ->orWhere('email', 'like', '%'.$proveedor.'%')
                        ->orWhere('clave', 'like', '%'.$proveedor.'%')
                        ->orWhere('empresa', 'like', '%'.$proveedor.'%');
        }
    }
}
