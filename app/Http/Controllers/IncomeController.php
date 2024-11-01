<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Company;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    
    public function index()
    {
        // $incomes = Income::with('company')->get(); // Eager load company
        // return view('incomes.index', compact('incomes'));
        $incomes = Income::with('company')->paginate(10); // Load 10 records per page
        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        $companies = Company::all(); // Get all companies
        return view('incomes.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric',
            'remarks' => 'nullable|string|max:300',
        ]);
		
	 $input = $request->all();
	 $input['created_user_id'] = !empty(auth()->id()) ? auth()->id() : 0;
       
       $saveInfo =  Income::create($input);
		
		
		$remainInfo['event_table_name'] = 'incomes';
        $remainInfo['event_table_row_id'] = $saveInfo->id;
        $remainInfo['event_amount'] = $input['amount'];
		
		$this->addIntoRemainBalance($remainInfo, 'Income');

        return redirect()->route('incomes.index')->with('success', 'Income created successfully.');
    }

    public function show(Income $income)
    {
        return view('incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        $companies = Company::all();
        return view('incomes.edit', compact('income', 'companies'));
    }

    public function update(Request $request, Income $income)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric',
            'remarks' => 'nullable|string|max:300',
        ]);
	
		$remainCheckParameter['event_table_name'] = 'incomes';
		$remainCheckParameter['event_table_row_id'] = $income->id;
		
		$checkAllowResponse = $this->checkEditDeleteAllow($remainCheckParameter,  $request->amount, 'Income');
		
		if ($checkAllowResponse == true )
		{
			$income->update([
				'company_id' => $request->company_id,
				'amount' => $request->amount,
				'remarks' => $request->remarks,
				'modified_user_id' => auth()->id(),
			]);
			
			$responseStatus = 'success';
			$responseMessage = 'Capital updated successfully.';
		}
		else{
			
			$responseStatus = 'error';
			$responseMessage = 'Time out. Edit permission not allow at this moment.';
			
		}
		
		 return redirect()->route('incomes.index')->with($responseStatus, $responseMessage);
    
     }

    public function destroy(Income $income)
    {	
		
		$remainCheckParameter['event_table_name'] = 'incomes';
		$remainCheckParameter['event_table_row_id'] = $income->id;
		
		$checkAllowResponse = $this->checkEditDeleteAllow($remainCheckParameter, '', 'incomming');
		
		if ($checkAllowResponse == true )
		{
			$income->delete();
			
			$responseStatus = 'success';
			$responseMessage = 'Capital deleted successfully.';
		}else{
			
			$responseStatus = 'error';
			$responseMessage = 'Time out. Delete permission not allow at this moment.';
			
		}
		
		return redirect()->route('incomes.index')->with($responseStatus, $responseMessage);
    
      
	}
}
