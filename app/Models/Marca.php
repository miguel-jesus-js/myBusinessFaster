<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['marca'];

    public function scopeMarca($query, $marca)
    {
        if($marca)
        {
            return $query->where('marca', 'LIKE', '%'.$marca.'%');
        }
    }
}
