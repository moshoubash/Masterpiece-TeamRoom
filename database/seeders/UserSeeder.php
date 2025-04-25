<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // generate renter 
        $renter = User::create([
            'first_name' => 'Renter',
            'last_name' => 'Renter',
            'email' => 'renter@example.com',
            'password' => Hash::make('123123123'),
            'slug' => Str::slug("Renter Renter" . '-' . time()),
        ]);

        $renterRole = Role::where('name', 'renter')->first();
        $renter->roles()->attach($renterRole);

        // generate host 
        $host = User::create([
            'first_name' => 'Host',
            'last_name' => 'Host',
            'email' => 'host@example.com',
            'password' => Hash::make('123123123'),
            'slug' => Str::slug("Host Host" . '-' . time()),
        ]);

        $hostRole = Role::where('name', 'host')->first();
        $host->roles()->attach($hostRole);

        // generate admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123123123'),
            'slug' => Str::slug("Admin Admin" . '-' . time()),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole);

        // generate super-admin
        $superAdmin = User::create([
            'first_name' => 'SuperAdmin',
            'last_name' => 'SuperAdmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('123123123'),
            'slug' => Str::slug("SuperAdmin SuperAdmin" . '-' . time()),
        ]);

        $superAdminRole = Role::where('name', 'superadmin')->first();
        $superAdmin->roles()->attach($superAdminRole);
    }
}
