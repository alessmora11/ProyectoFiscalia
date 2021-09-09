<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'  => "Administrador",
            'slug' => "admin",
            'description'  => "Este usuario es administrador",
        ]);

        Role::create([
            'name'  => "Invitado",
            'slug' => "invitado",
            'description'  => "Este usuario es invitado",
        ]);
    }
}
