<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'id' => 1,
            'name' => User::ADMIN,
            'guard_name' => 'api'
        ]);

        Role::firstOrCreate([
            'id' => 2,
            'name' => User::USER,
            'guard_name' => 'api'
        ]);
    }
}
