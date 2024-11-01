<?php

namespace App\Http\Controllers;

use App\Models\CompanyRemainBalance;
use App\Http\Requests\StoreCompanyRemainBalanceRequest;
use App\Http\Requests\UpdateCompanyRemainBalanceRequest;
use Illuminate\Http\Request;

class CompanyRemainBalanceController extends Controller
{
    public function index()
    {
        $balances = CompanyRemainBalance::all();
        return view('company_remain_balances.index', compact('balances'));
    }

    // Show the form to create a new resource
    public function create()
    {
        return view('company_remain_balances.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'event_table_name' => 'nullable|string|max:100',
            'event_table_row_id' => 'nullable|string|max:100',
            'amount' => 'nullable|numeric',
            'created_user_id' => 'required|integer',
            'modified_user_id' => 'required|integer',
            'deleted_user_id' => 'required|integer',
            'status' => 'required|boolean'
        ]);

        CompanyRemainBalance::create($request->all());

        return redirect()->route('company_remain_balances.index')->with('success', 'Balance created successfully.');
    }

    // Display the specified resource
    public function show(CompanyRemainBalance $companyRemainBalance)
    {
        return view('company_remain_balances.show', compact('companyRemainBalance'));
    }

    // Show the form to edit the specified resource
    public function edit(CompanyRemainBalance $companyRemainBalance)
    {
        return view('company_remain_balances.edit', compact('companyRemainBalance'));
    }

    // Update the specified resource in storage
    public function update(Request $request, CompanyRemainBalance $companyRemainBalance)
    {
        $request->validate([
            'event_table_name' => 'nullable|string|max:100',
            'event_table_row_id' => 'nullable|string|max:100',
            'amount' => 'nullable|numeric',
            'created_user_id' => 'required|integer',
            'modified_user_id' => 'required|integer',
            'deleted_user_id' => 'required|integer',
            'status' => 'required|boolean'
        ]);

        $companyRemainBalance->update($request->all());

        return redirect()->route('company_remain_balances.index')->with('success', 'Balance updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(CompanyRemainBalance $companyRemainBalance)
    {
        $companyRemainBalance->delete();

        return redirect()->route('company_remain_balances.index')->with('success', 'Balance deleted successfully.');
    }
	
	
	
	public function remainBalance()
	{
		$conditions = [];
		$checkCurrentBaqlance = $this->checkCurrentBalance($conditions);
		  
		return view('company_remain_balances.current-balance', compact('checkCurrentBaqlance'));
		
	}
	
}
