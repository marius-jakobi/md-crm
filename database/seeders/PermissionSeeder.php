<?php

namespace Database\Seeders;

use App\Models\Permission;
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

        foreach($methods as $method) {
            foreach($entities as $entity) {
                $permission = new Permission([
                    'identifier' => $method['identifier'] . '-' . $entity['identifier'],
                    'description' => $entity['description'] . ($method['identifier'] == 'index' ? 'n' : '') . ' ' . $method['description']
                ]);

                $permission->save();
            }
        }
    }
}
