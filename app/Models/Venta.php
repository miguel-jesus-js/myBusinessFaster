<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cliente_id',
        'sucursale_id',
        'direcciones_entrega_id',
        'folio',
        'fecha',
        'importe',
        'iva',
        'descuento',
        'total',
        'paga_con',
        'pago_inicial',
        'tipo_pago', // 0-Efectivo, 1-Tarjeta
        'estado', //0-Pagado, 1-Pendiemte
        'tipo_venta',//1-Venta a menudeo, 2-Venta a mayoreo, 3-Venta a crédito
        'tipo_venta_pago',//0-Venta al contado, 1-Venta a crédito
        'periodo_pagos',
        'tipo'
    ];

    const TIPO_VENTA_MENUDEO = 1;
    const TIPO_VENTA_MAYOREO = 2;
    const TIPO_VENTA_CREDITO = 3;
    const TIPO_VENTA = [
        self::TIPO_VENTA_MENUDEO    => 'Venta a menudeo',
        self::TIPO_VENTA_MAYOREO    => 'Venta a mayoreo',
        self::TIPO_VENTA_CREDITO    => 'Venta a crédito',
    ];

    const PERIODO_PAGO_SEMANAL      = 1;
    const PERIODO_PAGO_QUINCENAL    = 2;
    const PERIODO_PAGO_MENSUAL      = 3;
    const PERIODO_PAGOS = [
        self::PERIODO_PAGO_SEMANAL      => 'Semanal',
        self::PERIODO_PAGO_QUINCENAL    => 'Quincenal',
        self::PERIODO_PAGO_MENSUAL      => 'Mensual',
    ];
    const PERIODO_PAGOS_DIAS = [
        self::PERIODO_PAGO_SEMANAL      => 7,
        self::PERIODO_PAGO_QUINCENAL    => 15,
        self::PERIODO_PAGO_MENSUAL      => 30,
    ];
    const ESTADO_PAGADO     = 1;
    const ESTADO_CANCELADO  = 2;
    const ESTADO_PENDIENTE  = 3;
    const ESTADO_PAGO = [
        self::ESTADO_PAGADO      => 'Pagado',
        self::ESTADO_CANCELADO   => 'Cancelado',
        self::ESTADO_PENDIENTE   => 'Pendiente',
    ];

    public function scopeFolio($query, $folio)
    {
        if($folio)
        {
            return $query->where('folio', $folio);
        }
    }
    public function scopeSucursal($query, $sucursale_id)
    {
        if($sucursale_id)
        {
            return $query->leftJoin('users', 'ventas.user_id', '=', 'users.id')->where('users.sucursale_id', $sucursale_id);
        }
    }
    public function scopeEmpleado($query, $user_id)
    {
        if($user_id)
        {
            return $query->where('user_id', $user_id);
        }
    }
    public function scopeCliente($query, $cliente_id)
    {
        if($cliente_id)
        {
            return $query->where('cliente_id', $cliente_id);
        }
    }
    public function scopeFechaIni($query, $fecha_ini)
    {
        if($fecha_ini)
        {
            return $query->whereDate('fecha', '>=', $fecha_ini.' 00:00:00');
        }
    }
    public function scopeFechaFin($query, $fecha_fin)
    {
        if($fecha_fin)
        {
            return $query->whereDate('fecha', '<=', $fecha_fin.' 23:59:59');
        }
    }
    public function scopeBetwwenDate($query)
    {
        $fecha = Carbon::now()->format('Y-m-d');
        return $query->whereBetween('fecha', [$fecha.' 00:00:00', $fecha.' 23:59:59']);
    }
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalles', 'venta_id', 'producto_id')->withPivot('precio', 'cantidad', 'importe');
    }
    public function empleado()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursale::class, 'sucursale_id', 'id');
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'venta_id', 'id');
    }
    public function direccion()
    {
        return $this->belongsTo(DireccionesEntrega::class, 'direcciones_entrega_id', 'id');
    }
}
