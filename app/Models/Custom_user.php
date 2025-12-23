<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Custom_user extends Authenticatable
{

    protected $table = 'custom_users';

    protected $fillable = ['name', 'email', 'password', 'xp', 'gold', 'rank'];

    protected $hidden = ['password'];

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'custom_user_roles',
            'userId',
            'roleId'
        );
    }
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

    public function isHunter()
    {
        return $this->hasRole('Hunter');
    }

    public function isClient()
    {
        return $this->hasRole('Client');
    }


}
