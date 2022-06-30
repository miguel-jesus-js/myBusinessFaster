<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCliente extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'tipo_clientes';
    protected $fillable = ['tipo_cliente'];
}
