<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['categoria'];

    public function scopeCategoria($query, $categoria)
    {
        if($categoria)
        {
            return $query->where('categoria', 'LIKE', '%'.$categoria.'%');
        }
    }
}
