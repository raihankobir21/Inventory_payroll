<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\SalaryCategory;
use Carbon\Carbon;

class ExitController extends Controller
{
    //

    public function index()
    {
        return view('exit.index');
    }
 
     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         //
         return view('users.create');
     }
 
     /**
      * Store a newly created resource in storage.
      */
    //   public function store( Request $request ){

    //     $validatedData = $request->validate([

    //         'staff_id' => 'required|string|max:15',

    //     ]);

    //     $input = $request->all();

    //     $staffId = $input['staff_id'];

    //     $staffData = User::where('staff_id', $staffId)->get()->toArray();
       
    //     $getTodayDate = Carbon::now()->format('Y-m-d');

    //     if( !empty( $staffData ) ){

    //         $userId = $staffData[0]['id'];

    //         $userCheckIdWise = Attendance::where('user_id', $userId)
    //         ->where('staff_id', $staffId)
    //         ->whereDate('created_user_id', $getTodayDate)
    //         ->count();

    //         if( $userCheckIdWise > 0 ){
                
    //             $getTodayDateTime = date("Y-m-d h:i:s");

    //             // dd($getTodayDateTime);

    //             Attendance::where('user_id', $userId)
    //             ->where('staff_id', $staffId)
    //             ->whereDate('created_user_id', $getTodayDate)
    //             ->update(['exit_time' => $getTodayDateTime]);

    //             $responseStatus = 'success';
    //             $responseMessage = 'User exited successfully.';
    
    //             return redirect()->route('exits.index')
    //                         ->with($responseStatus, $responseMessage);  
    //         }


    //         $responseStatus = 'error';
    //         $responseMessage = 'You have to in first.';

    //         return redirect()->route('exits.index')
    //                     ->with($responseStatus, $responseMessage);  


    //     }

    //         $responseStatus = 'error';
    //         $responseMessage = 'Invalid staff ID.';
            
    //         return redirect()->route('exits.index')
    //                     ->with($responseStatus, $responseMessage);  
    // }
    
    //oneday exit validation by raihan

        public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required|string|max:15',
        ]);

        $staffId = $request->input('staff_id');
        $staffData = User::where('staff_id', $staffId)->with('userDetails')->first();
		
		
		if( empty( $staffData) )
		{
			$responseStatus = 'error';
			$responseMessage = 'Invalid staff ID.';
		}
			
		else
		{
			$getTodayDate = Carbon::now()->format('Y-m-d');
			$getTodayDateTime = Carbon::now();

			// Check if an attendance record already exists for today or the previous day
			$attendance = Attendance::where('user_id', $staffData->id)
									->where('staff_id', $staffData->staff_id)
									->whereDate('created_at', $getTodayDate)
									->orWhere(function ($query) use ($staffData, $getTodayDate) {
										$query->where('user_id', $staffData->id)
											->where('staff_id', $staffData->staff_id)
											->whereDate('created_at', Carbon::yesterday()->format('Y-m-d'))
											->whereNull('exit_time');
									})
									->orderBy('id', 'desc')
									->first();
			
			
			if  ( !empty ( $staffData->userDetails->salary_category_id &&  $staffData->userDetails->joining_salary ) )
			{	

				if ($attendance) {
						// If the attendance record exists, allow the user to exit within 24 hours of their check-in time
						$checkInTime = Carbon::parse($attendance->created_at);
						
						$hourdiff = round((strtotime($checkInTime) - strtotime($getTodayDateTime))/3600, 1);
						$hourdiff = 	abs($hourdiff) ;
							//dd($hourdiff);
						if ( $hourdiff <= 23) {
							
							
							//dd($hourdiff);
							
							$inTime = Carbon::parse($attendance->created_at);
							$totalDurationAllFormate = gmdate('H:i:s', $inTime->diffInSeconds($getTodayDateTime));
							$totalDurationHour = gmdate('H', $inTime->diffInSeconds($getTodayDateTime));
							//$totalDurationMinute = gmdate('i', $inTime->diffInSeconds($getTodayDateTime));
							
							
							$salaryCategoryInfo = SalaryCategory::where('id', $staffData->userDetails->salary_category_id)
									->first();
							
						   if ( $staffData->userDetails->salary_category_id ==1 ||  $staffData->userDetails->salary_category_id == 3 )
								{
									$hourlyDifference = '';
									
									if( $staffData->userDetails->salary_category_id ==1 )
									{
										if( $totalDurationHour > $salaryCategoryInfo->basic_working_hour )
										{
											
											
											$hourlyDifference = ($totalDurationHour-$salaryCategoryInfo->basic_working_hour);
											//dd($hourlyDifference);
											
											//$salaryAfterDoubleHour = '';
											
											if( $hourlyDifference > 3 && $hourlyDifference < 7 ) //  mean 9am to 9pm
											{
												$attendance->payable_salary = ($staffData->userDetails->joining_salary * 1.5);
												$attendance->total_working_hour = $totalDurationHour;
												
											
												
											}
											
											else if( $hourlyDifference > 6  && $hourlyDifference < 8 ) 
											{
												$attendance->payable_salary = ($staffData->userDetails->joining_salary * 2);
												$attendance->total_working_hour = $totalDurationHour;
													//dd($hourlyDifference);
											}
											
											else if( $hourlyDifference > 7 ) // 
											{
												//dd($hourlyDifference);
												$everyHourAfter12am = ($hourlyDifference - 7);
												$perHourlySalaryRate = ($staffData->userDetails->joining_salary/$salaryCategoryInfo->basic_working_hour);
												
												$attendance->payable_salary = ($staffData->userDetails->joining_salary * 2)+($perHourlySalaryRate*$everyHourAfter12am);
												$attendance->total_working_hour = $totalDurationHour;
											}
										}
										
									}
									//dd($staffData->); 
									
								}else if( $staffData->userDetails->salary_category_id ==2 ||  $staffData->userDetails->salary_category_id == 4 ){
									
									$findDailySalary = ($staffData->userDetails->joining_salary/30);
									
									$hourlyDifference = '';
									
									
									if( $staffData->userDetails->salary_category_id ==2 )
									{
										$hourlyDifference = ($totalDurationHour-$salaryCategoryInfo->basic_working_hour);
											
											//dd($hourlyDifference);
											
											//$salaryAfterDoubleHour = '';
											
											if( $hourlyDifference == 0 ) //  after overtime till 12 am
											{
												$attendance->payable_salary = $findDailySalary;
												$attendance->total_working_hour = $totalDurationHour;
												
											
												
											}else if( $hourlyDifference > 0 && $hourlyDifference <= 6 ) //  after overtime till 12 am
											{
												$attendance->payable_salary = $findDailySalary + ( $hourlyDifference* 30 );
												$attendance->total_working_hour = $totalDurationHour;
												
											
												
											}
											
											else if( $hourlyDifference > 7 ) // 
											{
												$til12AmSalary = $staffData->userDetails->joining_salary + ( 6* 30 );
												
												//dd($hourlyDifference);
												$everyHourAfter12am = ($hourlyDifference - 6);
												$perHourlySalaryRate = ($findDailySalary/$salaryCategoryInfo->basic_working_hour);
												
												$attendance->payable_salary = $til12AmSalary+($perHourlySalaryRate*$everyHourAfter12am);
												$attendance->total_working_hour = $totalDurationHour;
											
											}
											
									}else{
										
										$attendance->payable_salary = $findDailySalary;
										$attendance->total_working_hour = $totalDurationHour;
									}
								
								}else{
									
									//$salaryPerDayCalulation = ($staffData['user_details']['joining_salary']/30);
									
									//$input['payable_salary'] = $salaryPerDayCalulation/2;
								}
								
								
							$attendance->exit_time = $getTodayDateTime;
							$attendance->save();
							
							//dd('55');
									
							$responseStatus = 'success';
							$responseMessage = 'Exit successfully.';
							
						} else {
							
							$responseStatus = 'error';
							$responseMessage = 'Exit time has exceeded the 23 hour limit.';
						}
					} else {
						
						$responseStatus = 'error';
						$responseMessage = 'You have to check-in first.';
					}
			}else{
				
				$responseStatus = 'error';
				$responseMessage = 'Salary not set yet.';
			}
		}
		
		 return redirect()->route('exits.index')
                            ->with($responseStatus, $responseMessage); 
    }



     /**
      * Display the specified resource.
      */
     public function show(Employee $employee)
     {
         //
     }
 
     /**
      * Show the form for editing the specified resource.
      */
     public function edit( Employee $employee )
     {
 
     }
 
 
     /**
      * Update the specified resource in storage.
      */
     public function update( Request $request, $id )
     {
 
     }
 
     /**
      * Remove the specified resource from storage.
      */
     public function destroy(Employee $employee)
     {
         //
     }






}
