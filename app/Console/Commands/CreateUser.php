<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    protected $signature = 'app:create-user';
    protected $description = 'Create default admin user';

    public function handle(): void
    {
        $name = 'Dave';

        $user = User::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'email' => 'dave@dcblog.dev',
            'password' => bcrypt('password'),
            'is_active' => 1,
            'is_office_login_only' => 0,
        ]);

        $user->assignRole('admin');

        //generate image
        $name = get_initials($user->name);
        $id = $user->id . '.png';
        $path = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();
    }
}
