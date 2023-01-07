<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracione extends Model
{
    use HasFactory;
    protected $fillable = [
        'logotipo',
        'razon_social',
        'telefono',
        'rfc',
        'direccion',
        'color',
        'mostrar_sidebar',
        'mostrar_banner',
        'mostrar_foto',
        'facebook',
        'twitter',
        'instagram',
        'tiktok',
        'whatsapp',
        'mensaje',
        'esta_configurado',
    ];
}
