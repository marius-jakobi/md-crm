<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
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

    /**
     * Returns the full name concatenated from firstname and lastname
     *
     * @return string
     */
    public function fullname() {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * User belongs to roles
     */
    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function isSuperAdmin()
    {
        return $this->email === 'bob@test.com';
    }

    public function hasRole(string $identifier) {
        $roles = DB::table('role_user')
            ->where('roles.identifier', '=', $identifier)
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('roles.id')
            ->get();

        return count($roles) > 0;
    }

    public function hasPermission(string $identifier) {
        foreach($this->roles as $role) {
            foreach($role->permissions as $permission) {
                if ($permission->identifier === $identifier) {
                    return true;
                }
            }
        }

        return false;
    }
}
