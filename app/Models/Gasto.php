<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Carbon\Carbon;

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

    public function scopeBetwwenDate($query)
    {
        $fecha = Carbon::now()->format('Y-m-d');
        return $query->whereBetween('fecha_hora', [$fecha.' 00:00:00', $fecha.' 23:59:59']);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function tipoGasto()
    {
        return $this->belongsTo(TipoGasto::class, 'tipo_gasto_id', 'id');
    }
}

