<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = new User();

        $user->first_name = 'Super Admin';
        $user->last_name = 'Seeder';
        $user->email = 'superadmin@example.com';
        $user->email_verified_at = now();
        $user->birth_date = '01 January 2000';
        $user->gender = 'male';
        $user->password = bcrypt('testing');
        $user->role = 'superadmin';
        $user->created_at = now();
        $user->updated_at = now();

        $user->save();
    }
}
