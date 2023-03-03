<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cliente_id',
        'folio',
        'fecha',
        'importe',
        'iva',
        'descuento',
        'total',
        'paga_con',
        'tipo_pago',
        'estado',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalles', 'venta_id', 'producto_id')->withPivot('precio', 'cantidad', 'importe');
    }
}
