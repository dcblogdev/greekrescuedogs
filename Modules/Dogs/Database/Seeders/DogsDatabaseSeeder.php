<?php

namespace Modules\Dogs\Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DogsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Permission::firstOrCreate(['name' => 'view_dogs', 'label' => 'View Dogs', 'module' => 'Dogs']);
        Permission::firstOrCreate(['name' => 'add_dogs', 'label' => 'Add Dog', 'module' => 'Dogs']);
        Permission::firstOrCreate(['name' => 'edit_dogs', 'label' => 'Edit Dog', 'module' => 'Dogs']);
        Permission::firstOrCreate(['name' => 'delete_dogs', 'label' => 'Delete Dog', 'module' => 'Dogs']);
    }
}
