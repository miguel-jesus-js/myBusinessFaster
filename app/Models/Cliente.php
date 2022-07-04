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
    ];
    public function tipo_cliente(){
        return $this->belongsTo(TipoCliente::class);
    }
}
