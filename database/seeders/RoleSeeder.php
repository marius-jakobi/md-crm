<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administratoren', 'IT', 'Außendienst', 'Innendienst'
        ];

        foreach($roles as $roleName) {
            $role = new Role(['name' => $roleName]);
            $role->save();
        }
    }
}
