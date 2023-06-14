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
        'persona_id',
        'sucursale_id',
        'role_id',
        'nom_user',
        'password',
        'api_token',
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
        'api_token',
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
            return $query->leftJoin('personas', 'users.persona_id', '=', 'personas.id')->where('nombres', 'like', '%'.$user.'%')
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
    public static function scopeUserSucursal($query, $sucursal)
    {
        if($sucursal && is_numeric($sucursal))
        {
            return $query->where('sucursale_id', $sucursal);
        }
    }
    public function persona()
    {
        return $this->hasOne(Persona::class, 'id', 'persona_id');
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
        return $this->belongsTo(Sucursale::class, 'sucursale_id', 'id')->withTrashed();
    }
    public function ventas()
    {
        return $this->belongsTo(Venta::class, 'id', 'user_id');
    }
}
