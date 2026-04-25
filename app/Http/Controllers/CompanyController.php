<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Services\CompanyService;


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
    public function store(CompanyStoreRequest $request)
    {
        $validatedData = $request->validated();

        $existingCompany = Company::where('email', $validatedData['email'])->orWhere('phone', $validatedData['phone'])->first();

        if ($existingCompany) {
            ToastMagic::error('Email or phone already exists.');
            return back();
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $logoPath;
        }

        if ($request->hasFile('host_profile_picture')) {
            $image = $request->file('host_profile_picture');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile-pictures');
            $image->move($destinationPath, $name);
            $validatedData['host_profile_picture'] = '/images/profile-pictures/' . $name;
        }

        $companyService = new CompanyService();

        // create new company
        $company = $companyService->createCompany($validatedData);

        // create new company user
        $companyService->createCompanyUser($validatedData, $company);


        ToastMagic::success('Company created successfully.');

        return back();
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
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $logoPath;
        } else {
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

        if ($company != null) {
            if ($company->is_deleted == true) {
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

    public function filter(Request $request)
    {
        $query = Company::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhere('website', 'LIKE', "%$search%")
                ->orWhere("city", "LIKE", "%$search%");
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
            if ($sort == 'newest') {
                $query->orderBy('created_at', 'desc');
            }
        }

        $companies = $query->paginate(10);
        $cities = Company::distinct()->pluck('city');

        return view('dashboard.companies.index', compact('companies', 'cities'));
    }
}
