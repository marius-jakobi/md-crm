<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            ['identifier' => 'index', 'description' => 'auflisten'],
            ['identifier' => 'view', 'description' => 'anzeigen'],
            ['identifier' => 'create', 'description' => 'erstellen'],
            ['identifier' => 'update', 'description' => 'ändern'],
            ['identifier' => 'delete', 'description' => 'löschen'],
        ];
        $entities = [
            ['identifier' => 'customer', 'description' => 'Kunde']
        ];

        $adminRole = Role::where('identifier', '=', 'administrators')->first();

        foreach($methods as $method) {
            foreach($entities as $entity) {
                $permission = new Permission([
                    'identifier' => $method['identifier'] . '-' . $entity['identifier'],
                    'description' => $entity['description'] . ($method['identifier'] == 'index' ? 'n' : '') . ' ' . $method['description']
                ]);
                $adminRole->permissions()->save($permission);
            }
        }

        $user = User::where('email', '=', User::adminEmail())->first();
        $user->roles()->attach($adminRole->id);

    }
}
