<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    public function index()
    {
        $perPage = 10; // Adjust this value as needed
        $companies = Company::paginate($perPage);
        return view('companies.index', compact('companies'));
    }


    // Show form to create a new company
    public function create()
    {
        return view('companies.create');
    }

    // Store the new company in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'mobile_no' => 'required|max:11|unique:companies',
            //'email' => 'required|email|unique:companies',
            'address' => 'nullable|string',
        ]);

        Company::create($request->all());
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    // Show a single company's details
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    // Show the form to edit a company
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    // Update the company in the database
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|max:60',
            'mobile_no' => 'nullable|max:11|unique:companies,mobile_no,' . $company->id,
            //'email' => 'required|email|unique:companies,email,' . $company->id,
            'address' => 'nullable|string',
        ]);

        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    // Delete the company
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
