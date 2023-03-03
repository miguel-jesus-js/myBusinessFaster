<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Almacene extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sucursale_id',
        'nombre',
        'desc',
    ];

    public function scopeAlmacen($query, $almacen)
    {
        if($almacen)
        {
            return $query->where('nombre', 'LIKE', '%'.$almacen.'%')->orWhere('desc', 'LIKE', '%'.$almacen.'%');
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
    public function sucursal()
    {
        return $this->belongsTo(Sucursale::class, 'sucursale_id', 'id');
    }
}
