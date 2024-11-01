<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\SalaryCategory;
use App\Http\Requests\StoreSalaryCategoryRequest;
use App\Http\Requests\UpdateSalaryCategoryRequest;

class SalaryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {

        $data = SalaryCategory::get();
		
		//dd($data);
		
        // $branches = Branch::getList(['status' => 1]);

        return view('salary-categories.index',compact('data'));

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
    public function store(StoreSalaryCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryCategory $salaryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryCategory $salaryCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalaryCategoryRequest $request, SalaryCategory $salaryCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryCategory $salaryCategory)
    {
        //
    }
}
