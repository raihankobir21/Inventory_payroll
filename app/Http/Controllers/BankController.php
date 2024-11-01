<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('banks.index', compact('banks'));
    }

    public function create()
    {
        return view('banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Bank::create($request->only('name'));

        return redirect()->route('banks.index')->with('success', 'Bank created successfully.');
    }

    public function show(Bank $bank)
    {
        return view('banks.show', compact('bank'));
    }

    public function edit(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bank->update($request->only('name'));

        return redirect()->route('banks.index')->with('success', 'Bank updated successfully.');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('banks.index')->with('success', 'Bank deleted successfully.');
    }
}
