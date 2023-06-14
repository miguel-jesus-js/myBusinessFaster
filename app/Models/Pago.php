<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = [
        'venta_id',
        'user_id',
        'fecha_estimada',
        'fecha_hora',
        'anticipo',
        'monto',
        'paga_con',
        'cambio',
        'estado',
        'tipo_pago'
    ];

    const ESTADO_PAGADO = 1;
    const ESTADO_PENDIENTE = 2;
    const ESTADO_CANCELADO = 3;

    const ARRAY_ESTADOS = [
        self::ESTADO_PAGADO => 'Pagado',
        self::ESTADO_PENDIENTE => 'Pendiente',
        self::ESTADO_CANCELADO => 'Cancelado',
    ];
    const ARRAY_ESTADOS_COLOR = [
        self::ESTADO_PAGADO => 'bg-teal',
        self::ESTADO_PENDIENTE => 'bg-yellow',
        self::ESTADO_CANCELADO => 'bg-red',
    ];

    public function venta()
    {
        return $this->hasOne(Venta::class, 'id', 'venta_id');
    }
    public function empleado()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
