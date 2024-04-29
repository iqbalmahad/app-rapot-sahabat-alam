<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'password', // Ganti dengan password yang sesuai
        ]);

        // User::create([
        //     'name' => 'Iqbal',
        //     'username' => 'iqbalja',
        //     'email' => 'iqbal@gmail.com',
        //     'password' => 'password', // Ganti dengan password yang sesuai
        // ]);

        // Assign role admin to the user
        $adminRole = Role::where('name', 'admin')->first();
        $admin->assignRole($adminRole);
    }
}
