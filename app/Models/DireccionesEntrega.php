<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DireccionesEntrega extends Model
{
    use HasFactory;
    protected $table = 'direcciones_entregas';
    protected $fillable = [
        'persona_id',
        'ciudad',
        'estado',
        'municipio',
        'cp',
        'colonia',
        'calle',
        'n_exterior',
        'n_interior',
        'activo',
    ];
    public function persona()
    {
        return $this->hasMany(Persona::class, 'id', 'persona_id');
    }
}
