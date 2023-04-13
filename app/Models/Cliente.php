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
        'persona_id',
        'tipo_cliente_id',
        'empresa',
        'password',
        'limite_credito',
        'dias_credito',
    ];
    public function scopeCliente($query, $cliente)
    {
        if($cliente)
        {
            return $query->leftJoin('personas', 'clientes.persona_id', '=', 'personas.id')->where('nombres', 'like', '%'.$cliente.'%')
                        ->orWhere('telefono', 'like', '%'.$cliente.'%')
                        ->orWhere('email', 'like', '%'.$cliente.'%')
                        ->orWhere('empresa', 'like', '%'.$cliente.'%');
        }
    }
    public function persona(){
        return $this->hasOne(Persona::class, 'id', 'persona_id')->withTrashed();
    }
    public function tipo_cliente(){
        return $this->belongsTo(TipoCliente::class)->withTrashed();
    }

}
