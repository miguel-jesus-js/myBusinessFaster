<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materiale extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['material'];

    public function scopeMaterial($query, $material)
    {
        if($material)
        {
            return $query->where('material', 'LIKE', '%'.$material.'%');
        }
    }
}
