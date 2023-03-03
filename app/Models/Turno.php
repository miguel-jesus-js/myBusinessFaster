<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turno extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'turno',
        'hora',
    ];

    public function scopeTurno($query, $turno)
    {
        if($turno)
        {
            return $query->where('turno', 'LIKE', '%'.$turno.'%');
        }
    }
}
