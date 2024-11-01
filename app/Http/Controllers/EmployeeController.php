<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\EmployeeDetails;
use App\Models\EmployeeAccount;
use Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $data = Employee::select('id', 'staff_id', 'name', 'mobile_no','status')->orderBy('id','DESC')->paginate(10);

        return view('employees.index',compact( 'data' ))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'staff_id' => 'required|string|max:15|unique:employees,staff_id,',
            'name' => 'required|max:60',
            'mobile_no' => 'required|regex:([0-9])|size:11|unique:employees,mobile_no',
            'designation' => 'required|max:60',
            'email' => 'required|max:60',
            'nid' => 'required|mimes:jpeg,png,jpg,webp,pdf',
            'joining_date' => 'required|date_format:Y-m-d',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'emergency_contact' => 'required',
            'blood_group' => 'required',
            'joining_salary' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg,webp',
            'bank_name' => 'required',
            // 'branch_name' => 'required',
            // 'account_name' => 'required',
            'account_number' => 'required|string|max:30|unique:employee_accounts,account_number,',

        ]);
        
        $input = $request->all();
        // dd($request->all());

        $input['staff_id'] = $input['staff_id'];
        $input['created_by'] = !empty( Auth::user()->id) ? Auth::user()->id : 0 ;
        $employeeData = Employee::create($input);

        // dd($employeeItem->toArray());

        if( $employeeData ) {  
            
            $employeeDetails = new EmployeeDetails();

            $employeeDetails->joining_date = !empty($input['joining_date']) ? date("Y-m-d h:i:s", strtotime($input['joining_date'])) : NULL;
            $employeeDetails->staff_id = $input['staff_id'];
            $employeeDetails->designation = $input['designation'];
            $employeeDetails->email = $input['email'];
            $employeeDetails->present_address = $input['present_address'];
            $employeeDetails->permanent_address = $input['permanent_address'];
            $employeeDetails->emergency_contact = $input['emergency_contact'];
            $employeeDetails->blood_group = $input['blood_group'];
            $employeeDetails->joining_salary = $input['joining_salary'];
            $employeeDetails->created_by = $input['created_by'];

            if(!empty($input['photo'])){

                $imagePath = $input['photo'];
                $imageName = 'employee_'.date('Ymdhis_').$imagePath->getClientOriginalName();
                $path = $imagePath->storeAs('employee', $imageName, 'public');
                $employeeDetails->photo = $imageName;
                }

            if(!empty($input['nid'])){

                $imagePath = $input['nid'];
                $imageName = 'nationalIdCard_'.date('Ymdhis_').$imagePath->getClientOriginalName();
                $path = $imagePath->storeAs('nationalIdCard', $imageName, 'public');
                $employeeDetails->nid = $imageName;
                }

            $employeeData->employeeDetails()->save($employeeDetails);


            $employeeAccount = new EmployeeAccount();
            
            $employeeAccount->staff_id = $input['staff_id'];
            $employeeAccount->bank_name = $input['bank_name'];
            $employeeAccount->branch_name = $input['branch_name'];
            $employeeAccount->account_name = $input['account_name'];
            $employeeAccount->account_number = $input['account_number'];
            $employeeAccount->created_by = $input['created_by'];


            $employeeData->employeeAccount()->save($employeeAccount);
    
            $responseStatus = 'success';
            $responseMessage = 'Employee inserted successfully.';

        }else{
            $responseStatus = 'error';
            $responseMessage = 'Something went wrong, please try again.';
       
        }

        // Redirect back or wherever needed after successful save
        return redirect()->route('employees.index')
                        ->with($responseStatus, $responseMessage);    
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //

        // dd($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Employee $employee )
    {

        $employeeData = Employee::with(['employeeDetails'])
        ->with(['employeeAccount'])
        ->find($employee->id);

        // dd($employeeData->toArray());

        return view('employees.edit',compact('employeeData'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, $id )
    {

        $input = $request->all();

        $employeeAccountData = EmployeeAccount::where('employee_id', $id)->first();

        $employeeAccountId = $employeeAccountData->id;

        // dd($employeeAccountId);

        $validatedData = $request->validate([

            'mobile_no' => 'required|regex:([0-9])|size:11|unique:employees,mobile_no,' . $id,
            'name' => 'required|max:60',
            'designation' => 'required|max:60',
            'email' => 'required|max:60',
            'joining_date' => 'required|date_format:Y-m-d',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'emergency_contact' => 'required',
            'blood_group' => 'required',
            'joining_salary' => 'required',
            'photo' => 'nullable|mimes:jpeg,png,jpg,webp',
            'nid' => 'nullable|mimes:jpeg,png,jpg,webp,pdf',
            'bank_name' => 'required',
            // 'branch_name' => 'required',
            // 'account_name' => 'required',
            'account_number' => 'required',
            'account_number' => 'required|string|max:30|unique:employee_accounts,account_number,'. $employeeAccountId,


        ]);

        $input['modified_by'] = !empty( Auth::user()->id) ? Auth::user()->id : 0 ;

        $employeeUpdatedData = Employee::find($id);
		$employeeUpdatedData->update($input);


        if( $employeeUpdatedData ){
            
            $employeeDetails = $employeeUpdatedData->employeeDetails;

            $employeeDetails->joining_date = !empty($input['joining_date']) ? date("Y-m-d h:i:s", strtotime($input['joining_date'])) : NULL;
            $employeeDetails->designation = $input['designation'];
            $employeeDetails->email = $input['email'];
            $employeeDetails->present_address = $input['present_address'];
            $employeeDetails->permanent_address = $input['permanent_address'];
            $employeeDetails->emergency_contact = $input['emergency_contact'];
            $employeeDetails->blood_group = $input['blood_group'];
            $employeeDetails->joining_salary = $input['joining_salary'];
            $employeeDetails->modified_by = $input['modified_by'];

            if(!empty($input['photo'])){

                $imagePath = $input['photo'];
                $imageName = 'employee_'.date('Ymdhis_').$imagePath->getClientOriginalName();
                $path = $imagePath->storeAs('employee', $imageName, 'public');
                $employeeDetails->photo = $imageName;
                }

            if(!empty($input['nid'])){

                $imagePath = $input['nid'];
                $imageName = 'nationalIdCard_'.date('Ymdhis_').$imagePath->getClientOriginalName();
                $path = $imagePath->storeAs('nationalIdCard', $imageName, 'public');
                $employeeDetails->nid = $imageName;
                }

            $employeeUpdatedData->employeeDetails()->save($employeeDetails);

            // for employee_account update with relation maintain ====>

            $employeeAccount = $employeeUpdatedData->employeeAccount;
            
            $employeeAccount->bank_name = $input['bank_name'];
            $employeeAccount->branch_name = $input['branch_name'];
            $employeeAccount->account_name = $input['account_name'];
            $employeeAccount->account_number = $input['account_number'];
            $employeeAccount->modified_by = $input['modified_by'];

            $employeeUpdatedData->employeeAccount()->save($employeeAccount);


            $responseStatus = 'success';
            $responseMessage = 'Employee updated successfully.';

            // dd($employeeDetails->toArray());

        }else{
            $responseStatus = 'error';
            $responseMessage = 'Something went wrong, please try again.';
       
        }

        // Redirect back or wherever needed after successful save
        return redirect()->route('employees.index')
                        ->with($responseStatus, $responseMessage);   
        

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
    
}
