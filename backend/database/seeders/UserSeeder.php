<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => config('products.user_name'),
            'email' => config('products.email'),
            'password' => config('products.user_pwd'),
        ]);

        $admin->assignRole(User::ADMIN);
    }
}
