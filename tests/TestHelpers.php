<?php


namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

abstract class TestHelpers
{
    public static function createUserWithPermission(string $identifier)
    {
        $user = User::factory()->create();
        $role = Role::whereHas('permissions', function(Builder $query) use($identifier) {
            $query->where('identifier', '=', $identifier);
        })->first();

        if(!$role) {
            throw new \Exception("No Role with Permission '$identifier' found");
        }

        $user->roles()->save($role);
        $user->refresh();

        return $user;
    }
}
