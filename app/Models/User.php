<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Acceso;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sucursale_id',
        'role_id',
        'nombres',
        'app',
        'apm',
        'email',
        'telefono',
        'rfc',
        'ciudad',
        'estado',
        'municipio',
        'cp',
        'colonia',
        'calle',
        'n_exterior',
        'n_interior',
        'nom_user',
        'password',
        'mostrar_sidebar',
        'mostrar_banner',
        'mostrar_foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function scopeUser($query, $user)
    {
        if($user)
        {
            return $query->where('nombres', 'like', '%'.$user.'%')
                        ->orWhere('app', 'like', '%'.$user.'%')
                        ->orWhere('apm', 'like', '%'.$user.'%')
                        ->orWhere('telefono', 'like', '%'.$user.'%')
                        ->orWhere('email', 'like', '%'.$user.'%')
                        ->orWhere('nom_user', 'like', '%'.$user.'%');
        }
    }
    public function scopeIsAdmin($query, $isAdmin)
    {
        if(!$isAdmin)
        {
            return $query->where('sucursale_id', Auth::user()->sucursal->id);
        }
    }
    public function scopeSucursal($query, $sucursal)
    {
        if($sucursal && is_numeric($sucursal))
        {
            return $query->where('sucursale_id', $sucursal);
        }
    }
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function acceso()
    {
        return $this->hasMany(Acceso::class);
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursale::class, 'sucursale_id', 'id');
    }
}
