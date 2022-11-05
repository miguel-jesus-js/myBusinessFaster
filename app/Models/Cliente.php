<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TipoCliente;

class Cliente extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'tipo_cliente_id',
        'nombres',
        'app',
        'apm',
        'email',
        'telefono',
        'rfc',
        'empresa',
        'ciudad',
        'estado',
        'municipio',
        'cp',
        'colonia',
        'calle',
        'n_exterior',
        'n_interior',
        'password'
    ];
    public function tipo_cliente(){
        return $this->belongsTo(TipoCliente::class);
    }

    public function scopeCliente($query, $cliente)
    {
        if($cliente)
        {
            return $query->where('nombres', 'like', '%'.$cliente.'%')
                        ->orWhere('app', 'like', '%'.$cliente.'%')
                        ->orWhere('apm', 'like', '%'.$cliente.'%')
                        ->orWhere('telefono', 'like', '%'.$cliente.'%')
                        ->orWhere('email', 'like', '%'.$cliente.'%')
                        ->orWhere('empresa', 'like', '%'.$cliente.'%');
        }
    }
}
