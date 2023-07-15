<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'sucursale_id',
        'almacene_id',
        'producto_id',
        'fecha',
        'cantidad',
        'tipo' // 0-Salida, 1-Entrada
    ];

    public function scopeProducto($query, $producto)
    {
        if($producto)
        {
            return $query->leftJoin('productos', 'inventarios.producto_id', '=', 'productos.id')->where('productos.producto', 'LIKE', '%'.$producto.'%');
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursale::class, 'sucursale_id', 'id');
    }
    public function almacen()
    {
        return $this->belongsTo(Almacene::class, 'almacene_id', 'id');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }
}
