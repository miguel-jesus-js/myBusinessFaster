<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modulo;

class Acceso extends Model
{
    use HasFactory;
    protected $table = 'accesos';
    protected $fillable = [
        'user_id',
        'modulo_id',
        'c',
        'r',
        'u',
        'd'
    ];
    
}
