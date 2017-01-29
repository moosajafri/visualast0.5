<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany('Role')->withTimestamps();
    }

    /**
     * Does the user have a particular role?
     *
     * @param $name
     * @return bool
     */
    public function hasRole($name)
    {
        foreach ($this->roles as $role)
        {
            if ($role->name == $name) return true;
        }
        return false;
    }
    /**
     * Assign a role to the user
     *
     * @param $role
     * @return mixed
     */
    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }
    /**
     * Remove a role from a user
     *
     * @param $role
     * @return mixed
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }


}
