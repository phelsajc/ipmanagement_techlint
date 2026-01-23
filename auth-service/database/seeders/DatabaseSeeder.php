<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'super-admin']);
        $userRole = Role::create(['name' => 'regular-user']);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => $userRole->id,
        ]);
    }
}
