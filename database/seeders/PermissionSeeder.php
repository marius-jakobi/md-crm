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
        $permissions = [
            ['identifier' => 'show Customer list', 'description' => 'Kundenliste anzeigen'],
            ['identifier' => 'show Customer details', 'description' => 'Kundendetails anzeigen'],
        ];

        foreach ($permissions as $permission) {
            $newPermission = new Permission($permission);
            $newPermission->save();
        }
    }
}
