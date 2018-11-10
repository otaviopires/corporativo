<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setNameAttribute($value) {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setUsernameAttribute($value) {
        $this->attributes['username'] = strtolower($value);
    }

    public function roles() {

        return $this->belongsToMany(\App\Role::class);
    }

    public function hasPermission(Permission $permission) {

        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles) {

        if (is_array($roles) || is_object($roles)) {
            return !!$roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);
    }
}
