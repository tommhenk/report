<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login',
        'number',
        'birth',
        'get_job',
        'fired',
        'created_at',
        'prdated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){

        return $this->hasMany(Order::class, 'client_id', 'id');

    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function hasRole($name, $required = false){
        if (is_array($name)) {
            foreach ($name as $item) {
                $confirmRol = $this->hasRole($item);
                if ($confirmRol && !$required) {
                    return true;
                }elseif(!$confirmRol && $required){
                    return false;
                }
            }
            return $required;
        }else {
            foreach($this->roles as $role){
                if (Str::is($role->name, $name)) {
                    return true;
                }
            }
            return false;
        }
    }

    public function canDo($name, $required = false){
        if (is_array($name)) {
            foreach ($name as $item) {
                $confirmPerm = $this->canDo($item);
                if($confirmPerm && !$required){
                    return true;
                }elseif (!$confirmPerm && $required) {
                    return false;
                }
            }
            return $required;
        }else{
            foreach($this->roles as $role){
                foreach($role->perms as $perm){
                    if (Str::is($perm->name, $name)) {
                        return true;
                    }
                }
            }
            return false;
        }
    }
}
