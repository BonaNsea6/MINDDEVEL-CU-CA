<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'telephone',
        'boite_postale',
        'password',
        'roleId',
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
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, "user_roles", "userId", "roleId");
    
    }

    public function hasRole($role)
    {
        return $this->roles()->where("name", $role)->first() !== null;
    }

    public function hasAnyRoles($roles)
    {
        return $this->roles()->whereIn("name", $role)->first() !== null;
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId');
    }

   // Dans le modèle User pour les communes
    public function communes()
    {
        return $this->belongsToMany(User::class, 'commune_communautes', 'cubId', 'carId');
    }

    // Dans le modèle User, pour une commune
   // Dans le modèle User pour les communes
    // Dans le modèle User pour les communautés
    public function communaute()
    {
        return $this->belongsToMany(User::class, 'commune_communautes', 'carId', 'cubId');
    }


}