<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\EmployeeAdvancePayment;
use App\Models\EmployeeExpense;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeAdvancePaymentRequest;
use App\Http\Requests\UpdateEmployeeAdvancePaymentRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmployeeAdvancePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

     public function index()
     {
         // Paginate advance payments
         $advancePayments = EmployeeAdvancePayment::select('project_id', 'user_id', DB::raw('SUM(amount) as total_advance_amount'))
             ->with('user')
             ->with('project')
             ->groupBy('project_id')
             ->groupBy('user_id')
             ->where('type', 1)
             ->paginate(10); // Paginate with 10 items per page
     
         // Fetch expenses
         $expenses = EmployeeExpense::select('user_id', DB::raw('SUM(expense_amount) as total_expense_amount'))
             ->groupBy('user_id')
             ->get();
     
         // Map advance payments to include expense data
         $data = $advancePayments->map(function ($payment) use ($expenses) {
             $userExpenses = $expenses->firstWhere('user_id', $payment->user_id);
             $totalExpenseAmount = $userExpenses ? $userExpenses->total_expense_amount : 0;
     
             return [
                 'user_id' => $payment->user_id,
                 'project_name' => $payment->project ? $payment->project->name : 'No project associated',
                 'user_name' => $payment->user ? $payment->user->name : 'No user associated',
                 'total_advance_amount' => $payment->total_advance_amount,
                 'total_expense_amount' => $totalExpenseAmount,
                 'remaining_balance' => $payment->total_advance_amount - $totalExpenseAmount,
             ];
         });
     
         // Pass the data and pagination links to the view
         return view('employee-advance-payments.index', [
             'data' => $data,
             'advancePayments' => $advancePayments // Pass the paginated instance
         ]);
     }
     
	
	
	
	   public function indexSalary()
    {
        $advancePayments = EmployeeAdvancePayment::select('project_id','user_id', DB::raw('SUM(amount) as total_advance_amount'))
            ->with('user')
            ->with('project')
            ->groupBy('project_id')
            ->groupBy('user_id')
			->where('type', 2)
            ->get();
        //dd($advancePayments->toArray());

        $expenses = EmployeeExpense::select('user_id', DB::raw('SUM(expense_amount) as total_expense_amount'))
            ->groupBy('user_id')
            ->get();
       // dd($expenses->toArray());


        $data = $advancePayments->map(function ($payment) use ($expenses) {
            $userExpenses = $expenses->firstWhere('user_id', $payment->user_id);
            $totalExpenseAmount = $userExpenses ? $userExpenses->total_expense_amount : 0;

            return [
                'user_id' => $payment->user_id,
                'project_name' => $payment->project ? $payment->project->name : 'No project associated',
                'user_name' => $payment->user ? $payment->user->name : 'No user associated',
                'total_advance_amount' => $payment->total_advance_amount,
                'total_expense_amount' => $totalExpenseAmount,
                'remaining_balance' => $payment->total_advance_amount - $totalExpenseAmount,
            ];
        });

     //   dd($remainingBalances->toArray());

        return view('employee-advance-payments.index-salary', compact('data'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
		
        $project = Project::all();
		
		$reArrangeProject = [];
		
		foreach( $project as $p)
		{
			$reArrangeProject[$p->id] = $p->project_custom_id.' '.$p->name;
		}
		//dd($reArrange);
		
        return view('employee-advance-payments.create', compact('users', 'reArrangeProject'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project' => 'required|exists:projects,id',
			
            'user_id' => 'required|exists:users,id',
            'purpose' => 'required|string|max:60',
            'amount' => 'required|numeric',
        ]);

        $input = $request->all();
		
		$projectInfo = Project::find($input['project']);
		//dd($projectInfo->project_custom_id);
		
        $empInfo = User::find($input['user_id']);
		
        $input['staff_id'] = $empInfo->staff_id;
        $input['project_id'] = $input['project'];
        $input['project_custom_id'] = $projectInfo->project_custom_id;
        $input['type'] = 1;
		
		
		$checkCurrentBaqlance = $this->checkCurrentBalance([]);
		//dd($checkCurrentBaqlance);
		
		if( $checkCurrentBaqlance < $input['amount'] )
		{
			$responseStatus = 'error';
			$responseMessage = 'You have not sufficient balance.';
			
		}else{
			$saveInfo = EmployeeAdvancePayment::create($input);
			
			$remainInfo['event_table_name'] = 'employee_advance_payments';
			$remainInfo['event_table_row_id'] = $saveInfo->id;
			$remainInfo['event_amount'] = $input['amount'];
			$this->addIntoRemainBalance($remainInfo, 'Expense');
			
			$responseStatus = 'success';
			$responseMessage = 'Advance Payment created successfully.';
		}
		
       

        return redirect()->route('employee-advance-payments.index')
                        ->with($responseStatus, $responseMessage);
    }

    /**
     * Display the specified resource.
     */
    
    public function showByUser($user_id)
    {
        $advancePayments = EmployeeAdvancePayment::with('user')
            ->where('user_id', $user_id)
            ->get();
        
        return view('employee-advance-payments.show', compact('advancePayments'));
    }

   
   
   
    public function edit($id)
    {
		
		$reArrangeProject = [];
		
		$users = User::all();
		$project = Project::all();
		 
		foreach( $project as $p)
		{
			$reArrangeProject[$p->id] = $p->project_custom_id.' '.$p->name;
		}
		
        $advancePayments = EmployeeAdvancePayment::find($id);
		
		//dd($advancePayments->toArray());
		
        return view('employee-advance-payments.edit', compact( 'advancePayments', 'reArrangeProject', 'users' ));
    }
	
	
    public function editByUser($user_id)
    {
		
		
        $advancePayments = EmployeeAdvancePayment::with('user')
            ->where('user_id', $user_id)
            ->get();

        return view('employee-advance-payments.edit', compact('advancePayments'));
    }
    
	
	public function update(Request $request, EmployeeAdvancePayment $employeeAdvancePayment)
    {
      // dd($employeeAdvancePayment->toArray());

       $request->validate([
            'project' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'purpose' => 'required',
            'amount' => 'required|numeric'
        ]);
		
		$input = $request->all();
		
		$remainCheckParameter['event_table_name'] = 'employee_advance_payments';
		$remainCheckParameter['event_table_row_id'] = $employeeAdvancePayment->id;
		
		$checkAllowResponse = $this->checkEditDeleteAllow($remainCheckParameter,  $request->amount, 'Expense');
		
		$conditions[0]['event_table_name'] = 'employee_advance_payments';
		$conditions[1] = $employeeAdvancePayment->id;
		
		$checkCurrentBaqlance = $this->checkCurrentBalance($conditions);
		//dd($checkCurrentBaqlance);
		
		if( $checkCurrentBaqlance < $input['amount'] )
		{
			$responseStatus = 'error';
			$responseMessage = 'You have not sufficient balance.';
		}
		else if ($checkAllowResponse == true )
			{

				
		
				$projectInfo = Project::find($input['project']);
				$empInfo = User::find($input['user_id']);
				 
				
				$input['project_id'] = $input['project'];
				$input['project_custom_id'] = $projectInfo->project_custom_id;
				$input['staff_id'] = $empInfo->staff_id;
				$input['modified_user_id'] = !empty(auth()->id()) ? auth()->id() : 0;
				
				$employeeAdvancePayment->update($input);
				
				$responseStatus = 'success';
				$responseMessage = 'Advance payment updated successfully.';
			}
		else{
			
			$responseStatus = 'error';
			$responseMessage = 'Time out. Edit permission not allow at this moment.';
			
		}
		
		
		 return redirect()->route('employee-advance-payments.index')->with($responseStatus, $responseMessage);
    
     }
	
	

        public function updateByUser(Request $request, $user_id)
    {
		
        $payments = $request->input('payments');
		
		
        foreach ($payments as $id => $data) {
            $payment = EmployeeAdvancePayment::find($id);
            if ($payment) {
                $payment->update($data);
            }
        }

        return redirect()->route('employee-advance-payments.showByUser', $user_id)
                        ->with('success', 'Advance payments updated successfully.');
    }

        public function destroyByUser($user_id)
    {
        $advancePayments = EmployeeAdvancePayment::where('user_id', $user_id);
        $advancePayments->delete();

        return redirect()->route('employee-advance-payments.index')
                        ->with('success', 'Advance Payments deleted successfully.');
    }
}
