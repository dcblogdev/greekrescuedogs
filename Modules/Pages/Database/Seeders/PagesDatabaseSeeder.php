<?php

namespace Modules\Pages\Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PagesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Permission::firstOrCreate(['name' => 'view_pages', 'label' => 'View Pages', 'module' => 'Pages']);
        Permission::firstOrCreate(['name' => 'add_pages', 'label' => 'Add Page', 'module' => 'Pages']);
        Permission::firstOrCreate(['name' => 'edit_pages', 'label' => 'Edit Page', 'module' => 'Pages']);
        Permission::firstOrCreate(['name' => 'delete_pages', 'label' => 'Delete Page', 'module' => 'Pages']);
    }
}
