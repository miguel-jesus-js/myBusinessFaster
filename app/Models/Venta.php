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
}
