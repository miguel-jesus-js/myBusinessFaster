<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'ventas_id',
        'producto_id',
        'precio',
        'cantidad', 
        'importe',
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
