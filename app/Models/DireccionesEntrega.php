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
        'd-cliente_id',
        'd-ciudad',
        'd-estado',
        'd-municipio',
        'd-cp',
        'd-colonia',
        'd-calle',
        'd-n_exterior',
        'd-n_interior',
    ];
    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
