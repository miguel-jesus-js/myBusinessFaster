<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Almacene extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre',
        'desc',
    ];

    public function scopeAlmacen($query, $almacen)
    {
        if($almacen)
        {
            return $query->where('nombre', 'LIKE', '%'.$almacen.'%');
        }
    }
}
