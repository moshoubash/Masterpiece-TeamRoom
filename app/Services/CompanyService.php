<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;

class CompanyService
{
    public function createCompany(array $data): Company
    {
        return Company::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'website' => $data['website'],
            'logo' => $data['logo'] ?? null,
            'description' => $data['description'],
            'city' => $data['city'],
            'street' => $data['street'],
            'apartment' => $data['apartment'],
            'floor' => $data['floor'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'status' => 'active',
        ]);
    }

    public function createCompanyUser(array $data, $company): void
    {
        $user = User::create([
            'first_name' => $data['host_first_name'],
            'last_name' => $data['host_last_name'],
            'email' => $data['host_email'],
            'phone_number' => $data['host_phone'],
            'password' => bcrypt($data['host_password']),

            'company_name' => $data['company_name'],
            'company_id' => $company->id,
            'slug' => 'company-' . $company->id,
            'profile_picture_url' => $data['host_profile_picture'] ?? null,
        ]);

        $companyRole = Role::where('name', 'host')->first();
        $user->roles()->attach($companyRole->id);
    }
}