<?php

namespace App\Http\Controllers;

use App\Models\OffDay;
use App\Http\Requests\StoreOffDayRequest;
use App\Http\Requests\UpdateOffDayRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OffDayController extends Controller
{
    /**
     * Display a listing of the off days.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $offDays = OffDay::paginate(10); // Adjust pagination as needed
        return view('off-days.index', compact('offDays'));
    }

    /**
     * Show the form for creating a new off day entry.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('off-days.create');
    }

    /**
     * Store a newly created off day in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'month_year' => 'required|date_format:Y-m',
            'off_days' => 'required|json',
        ]);

        $input = $request->all();
       // dd($input);
        $monthYear = Carbon::parse($request->input('month_year'));
        $totalDays = $monthYear->daysInMonth;
        $offDays = json_decode($request->input('off_days'), true);
        
        $offDaysCount = count($offDays);

        $remainWorkingDays = $totalDays - $offDaysCount;

        OffDay::create([
            'title' => 'Off Days for ' . $monthYear->format('F Y'),
            'off_days' => $request->input('off_days'),
            'total_days' => $totalDays,
            'remain_working_days' => $remainWorkingDays,
            'created_user_id' => auth()->id(),
            'month_year' => $request->input('month_year'),
        ]);

        return redirect()->route('off-days.index')->with('success', 'Off days added successfully.');
    }

    /**
     * Display the specified off day.
     *
     * @param \App\Models\OffDay $offDay
     * @return \Illuminate\View\View
     */
    public function show(OffDay $offDay)
    {
        return view('off-days.show', compact('offDay'));
    }

    /**
     * Show the form for editing the specified off day.
     *
     * @param \App\Models\OffDay $offDay
     * @return \Illuminate\View\View
     */
    public function edit(OffDay $offDay)
    {
        return view('off-days.edit', compact('offDay'));
    }

    /**
     * Update the specified off day in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OffDay $offDay
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, OffDay $offDay)
    {
        $request->validate([
            'month_year' => 'required|date_format:Y-m',
            'off_days' => 'required|json',
        ]);

        $monthYear = Carbon::parse($request->input('month_year'));
        $totalDays = $monthYear->daysInMonth;
        $offDays = json_decode($request->input('off_days'), true);
        $offDaysCount = count($offDays);

        $remainWorkingDays = $totalDays - $offDaysCount;

        $offDay->update([
            'title' => 'Off Days for ' . $monthYear->format('F Y'),
            'off_days' => $request->input('off_days'),
            'total_days' => $totalDays,
            'remain_working_days' => $remainWorkingDays,
            'modified_user_id' => auth()->id(),
            'month_year' => $request->input('month_year'),
        ]);

        return redirect()->route('off-days.index')->with('success', 'Off days updated successfully.');
    }

    /**
     * Remove the specified off day from the database.
     *
     * @param \App\Models\OffDay $offDay
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(OffDay $offDay)
    {
        $offDay->delete();
        return redirect()->route('off-days.index')->with('success', 'Off day deleted successfully.');
    }
}
