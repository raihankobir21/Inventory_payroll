<?php

namespace App\Http\Controllers;

use App\Models\MyCompany;
use App\Http\Requests\StoreMyCompanyRequest;
use App\Http\Requests\UpdateMyCompanyRequest;

class MyCompanyController extends Controller
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
    public function store(StoreMyCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MyCompany $myCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyCompany $myCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMyCompanyRequest $request, MyCompany $myCompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyCompany $myCompany)
    {
        //
    }
}
