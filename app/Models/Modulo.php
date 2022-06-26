<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Modulo extends Model
{
    use HasFactory;
    protected $table = 'modulos';
    public $timestamps = false;
    protected $fillable = [
        'modulo',
        'icono',
        'link',
        'es_catalogo'
    ];
    public function user(){
        return $this->belongtsTo(User::class);
    }
    public function acceso()
    {
        return $this->hasMany(Acceso::class);
    }
}
