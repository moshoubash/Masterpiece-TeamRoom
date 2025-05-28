<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        $cities = Company::distinct()->pluck('city');
        return view('dashboard.companies.index', compact('companies', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:50',
            'floor' => 'nullable|integer|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            // Host Data
            'host_first_name' =>'required|string|max:255',
            'host_last_name' =>'required|string|max:255',
            'host_phone' =>'required|string|max:20',
            'host_email' =>'required|email|max:255',
            'company_name' =>'required|string|max:255',
            'host_password' => 'required|string|min:8|confirmed',
        ]);

        $existingCompany = Company::where('email', $validatedData['email'])->orWhere('phone', $validatedData['phone'])->first();
        if ($existingCompany) {
            return back()->with('error', 'Email or phone already exists.');
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $logoPath;
        }

        if($request->hasFile('host_profile_picture')){
            $image = $request->file('host_profile_picture');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile-pictures');
            $image->move($destinationPath, $name);
            $validatedData['host_profile_picture'] = '/images/profile-pictures/' . $name;
        }

        $company = Company::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'website' => $validatedData['website'],
            'logo' => $validatedData['logo'] ?? null,
            'description' => $validatedData['description'],
            'city' => $validatedData['city'],
            'street' => $validatedData['street'],
            'apartment' => $validatedData['apartment'],
            'floor' => $validatedData['floor'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'status' => 'active',
        ]);

        // create new user
        $user = User::create([
            'first_name' => $validatedData['host_first_name'],
            'last_name' => $validatedData['host_last_name'],
            'email' => $validatedData['host_email'],
            'phone' => $validatedData['host_phone'],
            'password' => bcrypt($validatedData['host_password']),
            'company_name' => $validatedData['company_name'],
            'company_id' => $company->id,
            'slug' => 'company-'.$company->id,
            'profile_picture_url' => $validatedData['host_profile_picture'] ?? null,
        ]);

        $companyRole = Role::where('name', 'host')->first();
        $user->roles()->attach($companyRole->id);

        return back()->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('dashboard.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('dashboard.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:50',
            'floor' => 'nullable|integer|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $logoPath;
        }
        else{
            $validatedData['logo'] = $company->logo;
        }

        $company->update($validatedData);

        return back()->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        
        if($company !=null){
            if($company->is_deleted == true){
                return back()->with('error', 'Company is already deleted.');
            }

            $company->is_deleted = true;
            $company->save();
            return back()->with('success', 'Company deleted successfully.');
        }

        return back()->with('error', 'Company not found.');
    }

    // restore deleted company
    public function restore($id)
    {
        $company = Company::findOrFail($id);

        if ($company) {
            if ($company->is_deleted == false) {
                return back()->with('error', 'Company is not deleted.');
            }
            
            $company->is_deleted = false;
            $company->save();
            return back()->with('success', 'Company restored successfully.');
        }

        return back()->with('error', 'Company not found.');
    }

    public function filter(Request $request){
        $query = Company::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%")
                  ->orWhere('website', 'LIKE', "%$search%")
                  ->orWhere("city", "LIKE", "%$search%");
        }

        if($request->has('sort')){
            $sort = $request->input('sort');
            if($sort == 'oldest'){
                $query->orderBy('created_at', 'asc');
            }
            if($sort == 'newest'){
                $query->orderBy('created_at', 'desc');
            }
        }

        $companies = $query->paginate(10);
        $cities = Company::distinct()->pluck('city');
        
        return view('dashboard.companies.index', compact('companies', 'cities'));
    }
}
