<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order_masters()
    {
        return $this->hasMany('App\Model\OrderMaster');
    }

    public function log()
    {
        return $this->hasMany('App\Model\Log');
    }

    // public function create_role($role_name)
    // {
    //     $role = Role::create(['name' => $role_name]);
    //     return $role;
    // }
    
    // public function get_users_roles($role)
    // {
    //     $users = User::role($role)->get();
    //     return $users;
    // }

    // public function get_all_roles()
    // {
    //     $roles = Roles::all()->pluck('name');
    // } 

}
