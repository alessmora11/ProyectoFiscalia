<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('images');
        Storage::makeDirectory('images');

        // User::create([
        //     'name'  => "Alejandra Esquivel",
        //     'email' => "user",
        //     'password'  => bcrypt('password')

        // ]);

        // $this->call(RoleUserSeeder::class);

        $users = User::factory(10)->create();
        
        foreach ($users as $user) {
            Image::factory(1)->create([
                'imageable_id'      => $user->id,
                'imageable_type'    => User::class
            ]);
            $role = Role::find(2);
            error_log($role);
            // $user->roles()->save($role);
        }
        
    }
}
