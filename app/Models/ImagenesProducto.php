<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesProducto extends Model
{
    use HasFactory;
    protected $table = 'imagenes_productos';
    protected $fillable = [
        'producto_id',
        'imagen',
    ];
}
