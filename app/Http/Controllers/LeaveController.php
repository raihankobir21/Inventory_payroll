<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\OffDay;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;

class LeaveController extends Controller
{
   /**
     * Display a listing of the leaves.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $leaves = Leave::with('user')->paginate(10); // Adjust the number of items per page as needed
        return view('leave-days.index', compact('leaves'));
    }
    

    /**
     * Show the form for creating a new leave entry.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all(); // Fetch all users
        return view('leave-days.create', compact('users'));
    }

    /**
     * Store a newly created leave in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
        public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|integer',
           // 'staff_id' => 'required|integer',
            'month_year' => 'required|date_format:Y-m',
            'leave_days' => 'required|json', // This will be the JSON array of dates
        ]);

        // Parse month_year and check for off days
        $monthYear = Carbon::parse($request->input('month_year'));
        $offDaysRecord = OffDay::where('month_year', $monthYear->format('Y-m'))->first();

        // Check if off days record exists
        if (!$offDaysRecord) {
            return redirect()->back()->withErrors('No off days record found for the selected month.');
        }

        // Decode leave_days JSON to an array
        $leaveDays = json_decode($request->input('leave_days'), true);
        $leaveDaysCount = count($leaveDays);

        // Check if leave record for this user and month already exists
        $existingLeaveRecord = Leave::where('user_id', $request->input('user_id'))
                                    ->where('month_year', $request->input('month_year'))
                                    ->first();

        if ($existingLeaveRecord) {
            // If record exists, update the total leave days
            $existingLeaveRecord->update([
                'leave_days' => $request->input('leave_days'), // Update with new leave days
                'total_days' => $leaveDaysCount, // Recalculate total days
                'updated_user_id' => auth()->id(),
            ]);
        } else {
            // Otherwise, create a new leave record
			
			$userInfo = User::find($request->input('user_id'));
            Leave::create([
                'user_id' => $request->input('user_id'),
                'staff_id' => $userInfo->staff_id,
                'month_year' => $request->input('month_year'),
                'leave_days' => $request->input('leave_days'), // Store leave days
                'total_days' => $leaveDaysCount,
                'created_user_id' => auth()->id(),
            ]);
        }

        // Redirect with success message
        return redirect()->route('leave-days.index')->with('success', 'Leave added successfully.');
    }



    /**
     * Display the specified leave.
     *
     * @param \App\Models\Leave $leave
     * @return \Illuminate\View\View
     */
    public function show(Leave $leave)
    {
        return view('leave-days.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified leave.
     *
     * @param \App\Models\Leave $leave
     * @return \Illuminate\View\View
     */
    public function edit(Leave $leave)
    {
        return view('leave-days.edit', compact('leave'));
    }

    /**
     * Update the specified leave in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Leave $leave
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Leave $leave)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'month_year' => 'required|date_format:Y-m',
            'leave_days' => 'required|json',
        ]);

        $monthYear = Carbon::parse($request->input('month_year'));
        $offDaysRecord = OffDay::where('month_year', $monthYear->format('Y-m'))->first();
        $remainWorkingDays = $offDaysRecord ? $offDaysRecord->remain_working_days : 0;
        
        $leaveDays = json_decode($request->input('leave_days'), true);
        $leaveDaysCount = count($leaveDays);

        $totalDays = $remainWorkingDays - $leaveDaysCount;

        $leave->update([
            'user_id' => $request->input('user_id'),
            'staff_id' => $request->input('staff_id'),
            'month_year' => $request->input('month_year'),
            'leave_days' => $request->input('leave_days'),
            'total_days' => $totalDays,
            'modified_user_id' => auth()->id(),
        ]);

        return redirect()->route('leave-days.index')->with('success', 'Leave updated successfully.');
    }

    /**
     * Remove the specified leave from the database.
     *
     * @param \App\Models\Leave $leave
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('leave-days.index')->with('success', 'Leave deleted successfully.');
    }
}
