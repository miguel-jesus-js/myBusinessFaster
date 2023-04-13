<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Persona extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'nombres',
        'email',
        'telefono',
        'rfc',
        'foto_perfil'
    ];

    public function direcciones(){
        return $this->hasMany(DireccionesEntrega::class, 'persona_id', 'id');
    }
}
