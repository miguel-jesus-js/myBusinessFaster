<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function acceso()
    {
        return $this->hasMany(Acceso::class);
    }
}
