<?php

    

namespace App\Http\Controllers;

    

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeAccountController;

use App\Models\User;
use App\Models\Bank;
use App\Models\BloodGroup;
use App\Models\UserDetail;
use  App\Models\EmployeeAccount;
use App\Models\SalaryCategory;

use App\Models\Branch;

use Spatie\Permission\Models\Role;

use DB;

use Hash;

use Illuminate\Support\Arr;
use Auth;

    

class UserController extends Controller

{

    public function index(Request $request)

    {

        $data = User::where('type', 1)
		->orderBy('staff_id','ASC')->paginate(10);

        // $branches = Branch::getList(['status' => 1]);
		
		$salaryCategories = SalaryCategory::pluck('title', 'id')->toArray();
		
		//dd($salaryCategories);

        return view('users.index',compact('data', 'salaryCategories' ))

            ->with('i', ($request->input('page', 1) - 1) * 10);

    }
	
	
	
	public function indexSalary(Request $request)

    {
		$curerntYM = date("m");
		//dd($curerntYM);
		
        $data = User::where('type', 1)
		->with(['attendance' => function($query) {  // there is hasMany rleation

            return $query->select('id', 'user_id', 'created_at', 'payable_salary')
            ->whereYear('created_at',  date("Y"))
            ->whereMonth('created_at',  date("m"));
        }])
		->orderBy('staff_id','ASC')->paginate(10);
		//->orderBy('staff_id','ASC')->get()->toArray();
		//dd($data);
		
        // $branches = Branch::getList(['status' => 1]);
		
		$salaryCategories = SalaryCategory::pluck('title', 'id')->toArray();
		
		//dd($salaryCategories);

        return view('users.salary',compact('data', 'salaryCategories' ))

            ->with('i', ($request->input('page', 1) - 1) * 10);

    }

    

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $roles = Role::pluck('name','name')->all();

        // $branches = Branch::getList(['status' => 1]);
        //dd($branches);
        $banks = Bank::all();
        $bloodGroups = BloodGroup::all();
        $salaryCategories = SalaryCategory::all();
        //dd($banks);

        return view('users.create',compact( 'roles', 'banks', 'bloodGroups', 'salaryCategories' ));

    }

    

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    

    public function store(Request $request)
 {
    $this->validate($request, [
	
        'name' => 'required',
        'email' => 'nullable|email|unique:users,email',
        'roles.0' => 'required',
        'staff_id' => 'required|string|max:15|unique:users,staff_id',
        'mobile_no' => 'required|regex:([0-9])|size:11|unique:users,mobile_no',
		
        'designation' => 'required|max:60',
        'joining_date' => 'required|date_format:Y-m-d',
        'present_address' => 'required',
        'permanent_address' => 'required',
        'emergency_contact' => 'required',
		
        'joining_salary' => 'required',
        'salary_category' => 'required',
        'photo' => 'required|mimes:jpeg,png,jpg,webp|max:512',
        'nid' => 'required|mimes:jpeg,png,jpg,webp,pdf|max:1024',
        'bank_name' => 'required',  // Validate that bank_name exists in banks table
        'account_number' => 'required|string|max:30|unique:employee_accounts,account_number',
        'gender' => 'required|in:male,female,other',  // Assuming gender is a required field
        'blood_group' => 'required',  
    
	]);

    $input = $request->all();
    $input['password'] = Hash::make(12345678);
    $input['created_user_id'] = Auth::user()->id ?? 0;

    $userData = User::create($input);
    $userData->assignRole($request->input('roles'));

    if ($userData) {
        $userDetails = new UserDetail();
        $userDetails->joining_date = date("Y-m-d h:i:s", strtotime($input['joining_date']));
        $userDetails->staff_id = $input['staff_id'];
        $userDetails->designation = $input['designation'];
        $userDetails->email = $input['email'];
        $userDetails->present_address = $input['present_address'];
        $userDetails->permanent_address = $input['permanent_address'];
        $userDetails->emergency_contact = $input['emergency_contact'];
        $userDetails->blood_group = $input['blood_group'];  // Save blood group
        $userDetails->gender = $input['gender'];  // Save gender
        $userDetails->salary_category_id = $input['salary_category'];
        $userDetails->joining_salary = $input['joining_salary'];
        $userDetails->created_user_id = $input['created_user_id'];

        // Handle photo upload
        if (!empty($input['photo'])) {
            $imagePath = $input['photo'];
            $imageName = 'photo_'.$input['staff_id'].'_'. date('Ymdhis_') . $imagePath->getClientOriginalName();
            $path = $imagePath->storeAs('employees', $imageName, 'public');
            $userDetails->photo = $imageName;
        }

        // Handle NID upload
        if (!empty($input['nid'])) {
            $imagePath = $input['nid'];
            $imageName = 'nid_'.$input['staff_id'].'_'. date('Ymdhis_') . $imagePath->getClientOriginalName();
            $path = $imagePath->storeAs('employees', $imageName, 'public');
            $userDetails->nid = $imageName;
        }

        $userData->userDetails()->save($userDetails);

      
        $employeeAccount = new EmployeeAccount();
        $employeeAccount->staff_id = $input['staff_id'];
        $employeeAccount->bank_id = $input['bank_name'];  // Store bank_name as bank_id
        $employeeAccount->branch_name = $input['branch_name'] ?? '';
        $employeeAccount->account_name = $input['account_name'] ?? '';
        $employeeAccount->account_number = $input['account_number'];
        $employeeAccount->created_user_id = $input['created_user_id'];

        $userData->employeeAccount()->save($employeeAccount);

        $responseStatus = 'success';
        $responseMessage = 'User added successfully.';

    } else {
        $responseStatus = 'error';
        $responseMessage = 'Something went wrong, please try again.';
    }

    return redirect()->route('users.index')
                    ->with($responseStatus, $responseMessage);


}
    

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

     public function show($id)
     {
         $user = User::with('userDetails', 'employeeAccount')->findOrFail($id);
         return view('users.show', compact('user'));
     }
     

    

    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
    
     public function edit($id)
    {

        $user = User::find($id);
		
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        $banks = Bank::all();
        $bloodGroups = BloodGroup::all();
		
        $salaryCategories = SalaryCategory::all();

        $roles = Role::pluck('name', 'name')->all();

        $userRole = $user->roles->pluck('name', 'name')->all();

        $userRoleKey = array_keys($userRole);
    //dd($user, $roles, $userRole, $banks, $salaryCategories);
        return view('users.edit', compact('user', 'roles', 'userRole', 'banks', 'bloodGroups', 'salaryCategories'));
    }

    


    public function update(Request $request, $id)
    {
    // Validate the request
	
	$user = User::where('id', $id)->with('employeeAccount')->first()->toArray();
	$accounntTableID = !empty($user['employee_account']['id']) ? $user['employee_account']['id'] : '';
	//dd($user);
	
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|same:confirm-password',
        // 'roles' => 'required',
        // 'roles.*' => 'exists:roles,id',
        'mobile_no' => 'required|regex:/^[0-9]{11}$/|unique:users,mobile_no,' . $id,
        'designation' => 'required|string|max:60',
        
        'joining_date' => 'required',
        'present_address' => 'required',
        'permanent_address' => 'required',
        'emergency_contact' => 'required',
        'blood_group' => 'required',
		
		'salary_category' => 'required',
        'joining_salary' => 'required|numeric',
		
		'nid' => 'nullable|mimes:jpeg,png,jpg,pdf|max:1024',
        'photo' => 'nullable|mimes:jpeg,png,jpg|max:512',
        'bank_name' => 'required',
		'account_number' => 'required|string|max:30|unique:employee_accounts,account_number,'.$accounntTableID,
		
        
    ]);

    // Find the user by ID
    //dd('response');
	
    //$user = User::find($id);
	$input = $request->all();
	
	//dd($input);
	
	 $input = $request->except('confirm-password');
	 
	 if(!empty($input['password'])){ 

		$input['password'] = Hash::make($input['password']);

	}else{

		$input = Arr::except($input,array('password'));    

	}
		
	 $user = User::findOrFail($id);
	 
	if( $user->update($input) ) {
		
		
		  
			 DB::table('model_has_roles')->where('model_id', $id)->delete();
			 $user->assignRole($request->input('roles'));
			
			 $userDetails = $user->userDetails;
			 
			 $userDetails->staff_id = $input['staff_id'];
             
			 $userDetails->designation = $input['designation'];
			 $userDetails->joining_date = $input['joining_date'];
			 $userDetails->present_address = $input['present_address'];
			 $userDetails->permanent_address = $input['permanent_address'];
			 $userDetails->emergency_contact = $input['emergency_contact'];
			 $userDetails->blood_group = $input['blood_group'];
			 $userDetails->salary_category_id = $input['salary_category'];
			 $userDetails->joining_salary = $input['joining_salary'];
			 
			 
			 
			 if ($request->hasFile('photo')) {
				
				$imagePath = $request->file('photo');
				$imageName = 'photo_'.$input['staff_id'].'_' . date('Ymdhis_') . $imagePath->getClientOriginalName();
				$imagePath->storeAs('employees', $imageName, 'public');
				
				   if( !empty($userDetails->photo) ){


						if( file_exists('storage/app/public/employees/'.$userDetails->photo) ){
						
							unlink('storage/app/public/employees/'.$userDetails->photo);
						
						}
				   }
				   
				   $userDetails->photo = $imageName;
				
			}
			
			
			if ($request->hasFile('nid')) {
				
				$imagePath = $request->file('nid');
				$imageName = 'nid_'.$input['staff_id'].'_' . date('Ymdhis_') . $imagePath->getClientOriginalName();
				$imagePath->storeAs('employees', $imageName, 'public');
				
				   if( !empty($userDetails->nid) ){
						
					//	dd('ttt');

						if( file_exists('storage/app/public/employees/'.$userDetails->nid) ){
						//dd('ttt');
							unlink('storage/app/public/employees/'.$userDetails->nid);
						
						}
				   }
				   
				   $userDetails->nid = $imageName;
				
			}
			
			//dd($userDetails->toArray());
			
			$user->userDetails()->save($userDetails);

            // Update employee accounts
            $employeeAccount = $user->employeeAccount;
            $employeeAccount->update([
                'bank_id' => $request->input('bank_name'),
                'branch_name' => $request->input('branch_name'),
                'account_name' => $request->input('account_name'),
                'account_number' => $request->input('account_number'),
            ]);

            //$user->employeeAccount()->save(employeeAccount);
	 
	 
	 
            $responseStatus = 'success';
            $responseMessage = 'Updated successfully.';

        }else{
			
            $responseStatus = 'error';
            $responseMessage = 'Something went wrong, please try again.';
       
        }

       
        return redirect()->route('users.index')
                        ->with($responseStatus, $responseMessage);
						
	  
	 
	 //$employeeItem->employeeDetails()->save($employeeDetails);
}


    public function destroy($id)

    {

        User::find($id)->delete();

        return redirect()->route('users.index')

                        ->with('success','User deleted successfully');

    }
	


    public function activeInactive($id)
    {
      

        $data = User::findOrFail($id);

        //dd($data;die;

 
        $responseMessage = '';

        if( $data->status == 0 ){

            $input['status'] = 1;

            $responseMessage = 'Active successfully.';

        }else{

            $input['status'] = 0;

            $responseMessage = 'Inactive successfully.';
        }



        if( $data->update($input) ) {

            $responseStatus = 'success';

        }else{

            $responseStatus = 'error';
            $responseMessage = 'Something went wrong, please try again.';
       
        }

        //$add = Country::create(['name' => $request->input('name')]);
    
        return redirect()->route('users.index')
                        ->with($responseStatus, $responseMessage);
    }



}