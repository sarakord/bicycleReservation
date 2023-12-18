<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()->firstOrCreate(
            ['name' => 'admin'],
            [
                'username' => 'admin',
                'email' => 'admin@test.com',
                'password' => 'admin@1402',
                'email_verified_at' => now(),
            ]
        );

        $adminRole = Role::query()->firstOrCreate([
            'name' => 'administrator',
        ]);
        $admin->assignRole($adminRole);
    }
}
