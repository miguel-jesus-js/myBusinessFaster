<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoGasto extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tipo_gastos';
    protected $fillable = [
        'tipo',
    ];

    public function scopeTipo($query, $filtro)
    {
        if($filtro)
        {
            return $this->where('tipo', 'LIKE', '%'.$filtro.'%');
        }
    }
}
