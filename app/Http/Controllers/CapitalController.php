<?php

namespace App\Http\Controllers;

use App\Models\Capital;
use App\Models\CompanyRemainBalance;
use App\Http\Requests\StoreCapitalRequest;
use App\Http\Requests\UpdateCapitalRequest;

use Illuminate\Http\Request;

class CapitalController extends Controller
{
     // Display a listing of the capitals (index page)
     public function index()
     {
         //$data  = Capital::all();  // or you can use pagination: Capital::paginate(10);

         $data = Capital::paginate(10);

         return view('capitals.index', compact('data'));
     }
	 
 
     // Show the form for creating a new capital
     public function create()
     {
         return view('capitals.create');
     }
 
     // Store a newly created capital in storage
     public function store(Request $request)
     {
         $request->validate([
             'amount' => 'required|numeric',
             'remarks' => 'nullable|string|max:255',
         ]);
 
         // Calculate the remaining balance
         $remain_balance = $request->amount - $request->expense;
        
         $input = $request->all();
         
         $input['remain_balance'] = $remain_balance;
         $input['created_user_id'] = !empty(auth()->id()) ? auth()->id() : 0;
       //  $input['count_status'] = 1;

         //dd($input);
         $saveInfo = Capital::create($input);
         
       
		// start insert into remain table 
			$remainInfo['event_table_name'] = 'capitals';
			$remainInfo['event_table_row_id'] = $saveInfo->id;
			$remainInfo['event_amount'] = $input['amount'];
			$this->addIntoRemainBalance($remainInfo, 'Income');
		// end insert into remain table 
		
		
         $responseStatus = 'success';
         $responseMessage = 'Capital added successfully.';

         
         return redirect()->route('capitals.index')->with($responseStatus, $responseMessage);
     }
 
     // Display the specified capital (show page)
     public function show($id)
     {
         $capital = Capital::findOrFail($id);
         return view('capitals.show', compact('capital'));
     }
 
     // Show the form for editing the specified capital
     public function edit($id)
     {
         $capital = Capital::findOrFail($id);
         return view('capitals.edit', compact('capital'));
     }
 
     // Update the specified capital in storage
     public function update(Request $request, $id)
     {
         $request->validate([
             'amount' => 'required|numeric',
             'remarks' => 'nullable|string|max:255',
         ]);
 
         $capital = Capital::findOrFail($id);
 
         // Calculate the remaining balance
        
		
		$remainCheckParameter['event_table_name'] = 'capitals';
		$remainCheckParameter['event_table_row_id'] = $id;
		
		$checkAllowResponse = $this->checkEditDeleteAllow($remainCheckParameter,  $request->amount, 'Income');
		
		if ($checkAllowResponse == true )
		{
				$capital->update([
				 'amount' => $request->amount,
				 'remarks' => $request->remarks,
				 'modified_user_id' => auth()->id(),
				]);
				
				$responseStatus = 'success';
				$responseMessage = 'Capital added successfully.';

			
		}else{
			
			$responseStatus = 'error';
			$responseMessage = 'Time out. Edit permission not allow at this moment.';
				
		}
		
		
		 
 
         return redirect()->route('capitals.index')->with($responseStatus, $responseMessage);
    
	}
 
     // Remove the specified capital from storage
     public function destroy($id)
     {
		$remainCheckParameter['event_table_name'] = 'capitals';
		$remainCheckParameter['event_table_row_id'] = $id;
		
		$checkAllowResponse = $this->checkEditDeleteAllow($remainCheckParameter, '', 'Income');
		
		if ($checkAllowResponse == true )
		{
			$capital = Capital::findOrFail($id);
			$capital->delete();
			
			$responseStatus = 'success';
			$responseMessage = 'Capital deleted successfully.';

		}else{
			
			$responseStatus = 'error';
			$responseMessage = 'Time out. Delete permission not allow at this moment.';
			
		}
 
			return redirect()->route('capitals.index')->with($responseStatus, $responseMessage);
    
	 }
	 
	 
    
}
