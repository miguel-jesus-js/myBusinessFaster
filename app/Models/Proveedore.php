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
}
