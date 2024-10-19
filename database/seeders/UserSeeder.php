<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@test.com';
        $user->password = bcrypt('password');
        $user->save();

        $admin = Role::whereSlug('admin')->first();
        $user->roles()->attach($admin);

        $user = new User();
        $user->name = 'Customer';
        $user->email = 'user@test.com';
        $user->password = bcrypt('password');
        $user->save();

        $customer = Role::whereSlug('customer')->first();
        $user->roles()->attach($customer);
    }
}
