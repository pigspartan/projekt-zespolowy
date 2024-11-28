<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Listing;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cash',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function roles() {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasRole($role) {

        return $this->roles()->where('name', $role)->exists();
    }

    public function assignRole($role){
        $role = Role::where('name', $role)->firstOrFail();
        $this->roles()->attach($role);
    }

    public function revokeRole($role){
        $role = Role::where('name', $role)->firstOrFail();
        $this->roles()->detach($role);
    }

    public function revokeAllRoles(){
        $this->roles()->detach();
    }

    public function listings() : HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
