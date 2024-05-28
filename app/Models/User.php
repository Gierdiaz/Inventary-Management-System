<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'users';

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'profile_users');
    }

    public function hasProfile(string $profile): bool
    {
        return $this->profiles()->where('name', $profile)->exists();
    }

    public function assignProfile($profileId)
    {
        $this->profiles()->syncWithoutDetaching([$profileId]);
    }

    public function revokeProfile($profileId)
    {
        $this->profiles()->detach($profileId);
    }

    /**
     * Atribui a função de administrador (role 'admin') a um usuário.
     *
     * @return void
     */
    public function assignAdminRole()
    {
        $adminRoleId = Role::where('name', 'admin')->value('id');
        $this->roles()->syncWithoutDetaching([$adminRoleId]);
    }

    /**
     * Revoga a função de administrador (role 'admin') de um usuário.
     *
     * @return void
     */
    public function revokeAdminRole()
    {
        $adminRoleId = Role::where('name', 'admin')->value('id');
        $this->roles()->detach($adminRoleId);
    }

}
