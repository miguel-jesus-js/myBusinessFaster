<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursale extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'nombre',
        'telefono',
        'correo',
        'rfc',
        'ciudad',
        'estado',
        'municipio',
        'cp',
        'colonia',
        'calle',
        'n_exterior',
        'n_interior',
        'facebook',
        'twitter',
        'instagram',
        'tiktok',
        'whatsapp',
        'mensaje'
    ];
    public function scopeSucursal($query, $sucursal)
    {
        if($sucursal)
        {
            return $query->where('nombre', 'LIKE', '%'.$sucursal.'%');
        }
    }
    public function responsable()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'productos_sucursal', 'sucursale_id', 'producto_id');
    }
}
