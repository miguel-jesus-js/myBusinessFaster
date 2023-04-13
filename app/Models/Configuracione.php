<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracione extends Model
{
    use HasFactory;
    protected $fillable = [
        'logotipo',
        'razon_social',
        'color',
        'iva',
    ];
}
