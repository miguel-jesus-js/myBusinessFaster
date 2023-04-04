<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Support\Facades\Auth;

class ProductosSucursal extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'productos_sucursal';
    protected $fillable = [
        'sucursale_id',
        'producto_id',
        'stock',
        'pre_compra',
        'pre_venta',
        'pre_mayoreo',
        'utilidad',
    ];

    public function scopeProducto($query, $producto)
    {
        if($producto)
        {
            return $query->leftJoin('productos', 'productos_sucursal.producto_id', '=', 'productos.id')->where('productos.producto', 'LIKE', '%'.$producto.'%');
        }
    }
    public function scopeIsAdmin($query, $isAdmin)
    {
        if(!$isAdmin)
        {
            return $query->where('sucursale_id', Auth::user()->sucursal->id);
        }
    }
    public function scopeSucursal($query, $sucursal)
    {
        if($sucursal && is_numeric($sucursal))
        {
            return $query->where('sucursale_id', $sucursal);
        }
    }
    public function sucursales()
    {
        return $this->belongsTo(Sucursale::class, 'sucursale_id', 'id');
    }
    public function productos()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }
}
