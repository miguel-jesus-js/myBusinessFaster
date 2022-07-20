<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCat extends Model
{
    use HasFactory;
    protected $table = 'detalle_cat';
    protected $fiallable = [
        'categoria_id',
        'producto_id',
    ];
}
