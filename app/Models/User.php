<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto; 
    use Notifiable;
    use TwoFactorAuthenticatable; 
    use HasRoles;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected static function boot()
{
    parent::boot();

    static::updating(function ($user) {
        if ($user->isDirty('status') && $user->status == 'DEACTIVATED') {
            $user->roles()->update(['status' => 'DEACTIVATED']);
        }
    });

    static::updating(function ($user) {
        if ($user->isDirty('status') && $user->status == 'ACTIVE') {
            $user->roles()->update(['status' => 'ACTIVE']);
        }
    });
}


    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // ----Funcion para que aparezca la foto del usuario
    public function adminlte_image(){
        return 'https://picsum.photos/300/300';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id');
    }

    // ----Funcion para permitir ver el rol que tiene cada usuario
    public function adminlte_desc(){

        return $this->role->name;
    }

    // ----Funcion para ir al perfil del usuario
    public function adminlte_profile_url(){
        
        return 'users';
    }

} 
