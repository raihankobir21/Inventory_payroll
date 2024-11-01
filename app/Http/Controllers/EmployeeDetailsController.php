<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDetails;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeDetailsRequest;
use App\Http\Requests\UpdateEmployeeDetailsRequest;

class EmployeeDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreEmployeeDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeDetails $employeeDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeDetails $employeeDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeDetailsRequest $request, EmployeeDetails $employeeDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeDetails $employeeDetails)
    {
        //
    }
}
