<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('attendances.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'staff_id' => 'required|string|max:15',

        ]);

        $input = $request->all();

        $staffId = $input['staff_id'];

        $staffData = User::where('staff_id', $staffId)->with('userDetails')->first();

		if( !empty($staffData) )
		{
			$staffData = $staffData->toArray();
		}
       // $currentDate = date("Y-m-d");

		$currentDate = Carbon::createFromFormat('Y-m-d', date("Y-m-d", strtotime(date("Y-m-d"))) );


        // dd($employeeId);

        if( !empty( $staffData ) ){

            $userId = $staffData['id'];

            $attendanceCheckIdWise = Attendance::where('user_id', $userId)
            ->whereDate('created_at', $currentDate)
            ->count();

            // dd($attendanceCheckIdWise);

            if(!empty( $attendanceCheckIdWise > 0 )){

					$responseStatus = 'error';
					$responseMessage = 'Attendance already taken.';
					//dd($responseStatus);

					return redirect()->route('attendances.index')
                            ->with($responseStatus, $responseMessage);

              }


			else if  ( !empty ( $staffData['user_details']['salary_category_id'] &&  $staffData['user_details']['joining_salary'] ) )
				{
					if ( $staffData['user_details']['salary_category_id'] ==1 ||  $staffData['user_details']['salary_category_id'] ==3 )
					{
						$input['payable_salary'] = $staffData['user_details']['joining_salary']/2;

					}else{

						$salaryPerDayCalulation = ($staffData['user_details']['joining_salary']/30);

						$input['payable_salary'] = $salaryPerDayCalulation/2;
					}

					$input['present_salary'] = $staffData['user_details']['joining_salary'];

					$input['user_id'] = $userId;
					$input['created_user_id'] = !empty( Auth::user()->id) ? Auth::user()->id : 0 ;
					$input['status'] = 1;
					// $input['created_user_id'] = date("Y-m-d h:i:s");
					$data = Attendance::create($input);

					$responseStatus = 'success';
					$responseMessage = 'Attendance has been taken successfully.';

				}else{

					$responseStatus = 'error';
					$responseMessage = 'Salary not set yet.';
				}
				//dd($staffData['user_details']['joining_salary']);


				//dd($responseStatus);

                return redirect()->route('attendances.index')
                            ->with($responseStatus, $responseMessage);

        }
        // dd("ssss");

            $responseStatus = 'error';
            $responseMessage = 'Invalid staff ID.';
            //dd($responseStatus);

            return redirect()->route('attendances.index')
                        ->with($responseStatus, $responseMessage);
    }





    public function dateWiseReport( Request $request ){

        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->endOfDay();

        $dateLength = $fromDate->diffInDays($toDate);

        $dailyRecords = [];

        for ($i = 0; $i <= $dateLength; $i++) {

            $startDate = $fromDate->copy()->addDays($i)->toDateString();

            $userRecords = User::whereDate('created_at','<=', $startDate)
			 ->where('type', 1)
            ->with(['userDetails'])
            ->with(['attendance' => function($query) use ($startDate){
                return $query->whereDate('created_at', $startDate);
            }])
            ->get()
            ->toArray();

            $dailyRecords[$startDate] = $userRecords;
        }

        // dd($dailyRecords);

        $minAvailableDate = User::select('created_at')->where('type', 1)->first();
        $minAvailableDate = Carbon::parse($minAvailableDate->created_at)->format('Y-m-d');
        $maxAvailableDate = Carbon::now()->format('Y-m-d');

        // dd($minAvailableDate);



        return view('reports.index-date-wise-attendance',compact('dailyRecords','minAvailableDate','maxAvailableDate'));
    }


        public function generatePdf()
    {
        $getTodayDate = Carbon::now()->format('Y-m-d');

        $allUsers = User::select('id', 'name', 'staff_id')
            ->with(['userDetails' => function ($query) {
                $query->select('user_id', 'photo');
            }])
            ->with(['attendance' => function ($query) use ($getTodayDate) {
                return $query->select('user_id', 'status', 'created_at', 'exit_time', 'created_at')
                    ->whereDate('created_at', $getTodayDate);
            }])
			 ->where('type', 1)
            ->get();

        $pdf = PDF::loadView('reports.pdf-today-attendance', compact('allUsers'));

        return $pdf->download('today_attendance_report.pdf');
    }



    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */




    public function report()
    {
        $getTodayDate = Carbon::now()->format('Y-m-d');

        $allUsers = User::select('id','name','staff_id')
        ->with(['userDetails' => function($query){

            $query->select('user_id','photo');
        }])
        ->with(['attendance' => function($query) use ($getTodayDate) {  // there is hasMany rleation

            return $query->select('id', 'user_id','status', 'exit_time','created_at', 'payable_salary')
            ->whereDate('created_at', $getTodayDate)->limit(1);
        }])
        ->where('type', 1)
        ->get();


         //dd($allUsers->toArray());

        return view('reports.index-today-attendance',compact('allUsers'));

    }


     public function edit($id)
    {

        $data = Attendance::find($id);

		//dd($id);

        if (!$data) {
            return redirect()->route('today-attendance-reports')->with('error', 'Data not found');
        }


        return view('attendances.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'payable_salary' => 'required|string|max:255',
        ]);

		$input = $request->all();

       // $attendance->update($request->only('payable_salary'));
        $attendance->update($input);

        return redirect()->route('today-attendance-reports')->with('success', 'Salary updated successfully.');
    }

    public function monthlySalaryReport(Request $request)
    {
        print_r($request->all());
        // Validate the request input for month and year
        // $validatedData = $request->validate([
        //     'month' => 'required|integer|min:1|max:12',
        //     'year' => 'required|integer|min:2000|max:' . Carbon::now()->year,
        // ]);

        // $month = $validatedData['month'];
        // dd($month);
        // $year = $validatedData['year'];

        // Get the start and end dates for the given month and year
        // $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        // $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // Fetch all employees along with their attendances for the given month
        // $employees = User::with(['userDetails', 'attendances' => function ($query) use ($startDate, $endDate) {
        //     $query->whereBetween('created_at', [$startDate, $endDate]);
        // }])->get();

        // dd($employees);

        // Calculate the total salary payable for each employee based on their attendances
        // $monthlyReport = $employees->map(function ($employee) use ($startDate, $endDate) {
        //     $totalPayableSalary = $employee->attendances->sum('payable_salary');
        //     // dd($totalPayableSalary);
        //     return [
        //         'staff_id' => $employee->staff_id,
        //         'name' => $employee->name,
        //         'joining_salary' => $employee->userDetails->joining_salary ?? 0,
        //         'total_payable_salary' => $totalPayableSalary,
        //         'total_working_hours' => $employee->attendances->sum('total_working_hour'),
        //         'attendance_count' => $employee->attendances->count(),
        //     ];
        // });

        // return view('reports.monthly_salary', compact('monthlyReport', 'startDate', 'endDate'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
