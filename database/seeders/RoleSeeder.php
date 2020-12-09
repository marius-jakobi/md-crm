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
            ['name' => 'Administratoren', 'identifier' => 'administrators'],
            ['name' => 'IT', 'identifier' => 'it'],
            ['name' => 'Außendienstmitarbeiter', 'identifier' => 'sales-agents'],
            ['name' => 'Innendienstmitarbeiter', 'identifier' => 'backoffice'],
            ['name' => 'Service-Techniker', 'identifier' => 'technicians'],
        ];

        foreach($roles as $roleName) {
            $role = new Role(['name' => $roleName]);
            $role->save();
        }
    }
}
