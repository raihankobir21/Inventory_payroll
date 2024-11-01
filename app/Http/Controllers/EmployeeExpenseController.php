<?php

namespace App\Http\Controllers;
use App\Models\EmployeeExpense;

use App\Models\Project;
use App\Models\User;
use App\Models\EmployeeAdvancePayment;
use App\Http\Requests\StoreEmployeeExpenseRequest;
use App\Http\Requests\UpdateEmployeeExpenseRequest;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class EmployeeExpenseController extends Controller
{
    public function index()
    {
		
		
       
        $expenses = EmployeeExpense::with(['user', 'project'])
        ->paginate(10); 

        return view('employee_expenses.index', compact('expenses'));
    }

    public function create()
    {
        $users = User::all();
		
		$project = Project::all();
		$reArrangeProject = [];
		foreach( $project as $p)
		{
			$reArrangeProject[$p->id] = $p->project_custom_id.' '.$p->name;
		}
		
        return view('employee_expenses.create', compact('users', 'reArrangeProject' ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project' => 'required',
            'user_id' => 'required',
            'expense_amount' => 'required|numeric',
        ]);

        // Get total advance balance for the employee
        $employeeAdvance = EmployeeAdvancePayment::where('user_id', $request->user_id)->sum('amount');

        // Get total expenses already recorded for this employee
        $totalExpenses = EmployeeExpense::where('user_id', $request->user_id)->sum('expense_amount');

        // Calculate remaining balance after the new expense
        $remainBalance = $employeeAdvance - ($totalExpenses + $request->expense_amount);
	
		$previouslnHand = ($employeeAdvance - $totalExpenses );
		
		if( $previouslnHand < $request->expense_amount )
		{
			$responseStatus = 'error';
			$responseMessage = 'Please increase advance payment.';
		}
		
		else{
			$staffId = User::where('id', $request->user_id)->value('staff_id');
			
			//dd($previouslnHand);
			// Create the new expense
			
			$input = $request->all();
			
			$projectInfo = Project::find($input['project']);
			$input['created_by']  = !empty(auth()->user()->id) ? auth()->user()->id : 0; 
			$input['previous_in_hand']  = $previouslnHand; 
			$input['remain_balance']  = $remainBalance; 
			$input['staff_id'] = $staffId;
			$input['project_id'] = $input['project'];
			$input['project_custom_id'] = $projectInfo->project_custom_id;
			
			
			
			EmployeeExpense::create($input);
		
			$responseStatus = 'success';
			$responseMessage = 'Expense created successfully.';
		}

        return redirect()->route('employee_expenses.index')->with($responseStatus, $responseMessage);
    }

    
    

    public function show($id)
    {
		
        $expense = EmployeeExpense::with('user')->findOrFail($id);
        return view('employee_expenses.show', compact('expense'));
    }

    public function edit($id)
    {
		
		$project = Project::all();
		$reArrangeProject = [];
		foreach( $project as $p)
		{
			$reArrangeProject[$p->id] = $p->project_custom_id.' '.$p->name;
		}
		
        $expense = EmployeeExpense::findOrFail($id);
        $users = User::all();
		
		$employeeAdvance = EmployeeAdvancePayment::where('user_id', $expense->user_id)->sum('amount');

		// Get total expenses excluding the current one (for correct update)
		$totalExpenses = EmployeeExpense::where('user_id', $expense->user_id)
										->where('id', '!=', $id)
										->sum('expense_amount');

		// Calculate remaining balance after updating the expense
		$remainBalance = $employeeAdvance - ($totalExpenses + $expense->expense_amount);
		
		
		
        return view('employee_expenses.edit', compact('expense', 'users', 'reArrangeProject', 'remainBalance'));
    }
	
	
	

    public function update(Request $request, $id)
    {
		//dd('tt');
		
        $request->validate([
            'user_id' => 'required',
            'expense_amount' => 'required|numeric',
        ]);
	
        $expenseLastRowId = EmployeeExpense::orderBy('id', 'DESC')->first();
		
		$expense = EmployeeExpense::findOrFail($id);

		// Get total advance balance for the employee
		$employeeAdvance = EmployeeAdvancePayment::where('user_id', $request->user_id)->sum('amount');

		// Get total expenses excluding the current one (for correct update)
		$totalExpenses = EmployeeExpense::where('user_id', $request->user_id)
										->where('id', '!=', $id)
										->sum('expense_amount');

		// Calculate remaining balance after updating the expense
		$remainBalance = $employeeAdvance - ($totalExpenses + $request->expense_amount);
		
		
		$previouslnHand = ($employeeAdvance - $totalExpenses );
		
		//dd($employeeAdvance);
        if( $expenseLastRowId->id != $id )
		{
			$responseStatus = 'error';
			$responseMessage = 'Time out. YOu can not update at this moment.';
			
		}
		else if( $previouslnHand < $request->expense_amount )
		{
			$responseStatus = 'error';
			$responseMessage = 'Please increase advance payment.';
			
		}else{
			
		
			// Update the expense
			$expense->update([
				'user_id' => $request->user_id,
				'staff_id' => $request->staff_id,
				'purpose' => $request->purpose,
				'remarks' => $request->remarks,
				'previous_in_hand' => $previouslnHand,
				'expense_amount' => $request->expense_amount,
				'remain_balance' => $remainBalance,  // Calculated dynamically
				'modified_by' => auth()->user()->id,
			]);
			
			$responseStatus = 'success';
			$responseMessage = 'Expense updated successfully.';
		}

        return redirect()->route('employee_expenses.index')->with($responseStatus, $responseMessage);
    }
	
	

    public function todayReport()
    {
        $todayExpenses = EmployeeExpense::whereDate('created_at', today())->with('user')->get();
        return view('employee_expenses.today', compact('todayExpenses'));
    }


        public function dateWiseReport(Request $request)
    {
        $query = EmployeeExpense::query();

        // If dates are provided, filter the results
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $expenses = $query->with('user')->get();

        // Check if the request is for PDF export
        if ($request->has('pdf')) {
            $pdf = Pdf::loadView('employee_expenses.report_pdf', compact('expenses'));
            return $pdf->download('expenses_report.pdf');
        }

        return view('employee_expenses.report', compact('expenses'));
    }

    public function downloadPdf(Request $request)
    {
        // Get the date range from the request
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        // Retrieve the expenses for the specified date range
        $expenses = EmployeeExpense::whereBetween('created_at', [$startDate, $endDate])
                                    ->with('user')
                                    ->get();

        // Load the view and pass the expenses data
        $pdf = Pdf::loadView('employee_expenses.report_pdf', compact('expenses'));

        // Download the PDF with a specific file name
        return $pdf->download('date_wise_expenses_report.pdf');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        EmployeeExpense::destroy($id);
        return redirect()->route('employee_expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
