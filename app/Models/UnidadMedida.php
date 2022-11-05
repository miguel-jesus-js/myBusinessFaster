<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadMedida extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'unidad_medidas';
    protected $fillable = ['unidad_medida'];

    public function scopeUnidadMedida($query, $unidadMedida)
    {
        if($unidadMedida)
        {
            return $query->where('unidad_medida', 'LIKE', '%'.$unidadMedida.'%');
        }
    }
}
