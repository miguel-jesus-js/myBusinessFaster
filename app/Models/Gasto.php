<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Gasto extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'user_id',
        'tipo_gasto_id',
        'fecha_hora',
        'monto',
        'desc',
        'comprobante',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function tipoGasto()
    {
        return $this->belongsTo(TipoGasto::class, 'tipo_gasto_id', 'id');
    }
}

