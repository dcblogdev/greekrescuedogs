<?php

namespace Modules\Blog\Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class BlogDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Permission::firstOrCreate(['name' => 'view_blog_posts', 'label' => 'View Posts', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'add_blog_posts', 'label' => 'Add Posts', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'edit_blog_posts', 'label' => 'Edit Posts', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'delete_blog_posts', 'label' => 'Delete Posts', 'module' => 'Blog']);

        Permission::firstOrCreate(['name' => 'view_blog_categories', 'label' => 'View Categories', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'add_blog_categories', 'label' => 'Add Categories', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'edit_blog_categories', 'label' => 'Edit Categories', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'delete_blog_categories', 'label' => 'Delete Categories', 'module' => 'Blog']);

        Permission::firstOrCreate(['name' => 'view_blog_authors', 'label' => 'View Authors', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'add_blog_authors', 'label' => 'Add Authors', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'edit_blog_authors', 'label' => 'Edit Authors', 'module' => 'Blog']);
        Permission::firstOrCreate(['name' => 'delete_blog_authors', 'label' => 'Delete Authors', 'module' => 'Blog']);
    }
}
