<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class DireccionesEntrega extends Model
{
    use HasFactory;
    protected $table = 'direcciones_entregas';
    protected $fillable = [
        'cliente_id',
        'ciudad',
        'estado',
        'municipio',
        'cp',
        'colonia',
        'calle',
        'n_exterior',
        'n_interior',
    ];
    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
