<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'password' => 'hashed',
    ];

    public function hasAnyRoles($roles) {
        if (!is_array($roles)) {
            return false;
        }

        foreach($roles as $role) {
            if ($this->hasRole($role)) {
                return true;  
            } 
        }

        return false;
    }

    public function hasRole($role) {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function roles() : BelongsToMany {
        return $this->belongsToMany(Role::class, 'roles_users')
            ->withTimestamps();
    }

    public function canModify() {
        return $this->hasAnyRoles([
            'ROLE_ADMIN',
            'ROLE_DIRECTOR',
        ]);
    }

    protected static function booted() {
        static::deleting(function (User $user) {
            $user->roles()->detach();
        });
    }
}
