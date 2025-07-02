<?php

namespace App\Http\Controllers;

use App\Models\Superannuation;
use App\Models\Bank;
use Illuminate\Http\Request;

class SuperannuationController extends Controller
{
    public function index()
    {
        $superannuations = Superannuation::all();
        return view('administrator.setting.superannuations.index', compact('superannuations'));
    }

    public function create()
    {
        $banks = Bank::all();
        return view('administrator.setting.superannuations.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:superannuations',
            'name' => 'required|string|max:255',
            'employer_contribution_percentage' => 'nullable|numeric|between:0,100',
            'employer_contribution_fixed_amount' => 'nullable|numeric',
            'tax_method_for_employee_contribution' => 'nullable|string|max:255',
            'included_bank_transfer' => 'required|boolean',
            'bank_account_number' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'employer_name' => 'nullable|string|max:255',
            'employer_superannuation_no' => 'nullable|string|max:255',
            'registration_date' => 'nullable|date',
            'employee_contrib_percent' => 'nullable|numeric|between:0,100',
            'employee_contrib_amount' => 'nullable|numeric',
            'status' => 'required|in:0,1',
        ]);

        Superannuation::create($request->all());

        return redirect()->route('superannuations.index')->with('success', 'Superannuation created successfully.');
    }

    public function edit($id)
    {
        $superannuation = Superannuation::findOrFail($id);
        $banks = Bank::all();
        return view('administrator.setting.superannuations.edit', compact('superannuation', 'banks'));
    }

    public function update(Request $request, $id)
    {
        $superannuation = Superannuation::findOrFail($id);
        $request->validate([
            'code' => 'required|string|max:255|unique:superannuations,code,' . $superannuation->id,
            'name' => 'required|string|max:255',
            'employer_contribution_percentage' => 'nullable|numeric|between:0,100',
            'employer_contribution_fixed_amount' => 'nullable|numeric',
            'tax_method_for_employee_contribution' => 'nullable|string|max:255',
            'included_bank_transfer' => 'required|boolean',
            'bank_account_number' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'employer_name' => 'nullable|string|max:255',
            'employer_superannuation_no' => 'nullable|string|max:255',
            'registration_date' => 'nullable|date',
            'employee_contrib_percent' => 'nullable|numeric|between:0,100',
            'employee_contrib_amount' => 'nullable|numeric',
            'status' => 'required|in:0,1',
        ]);

        $superannuation->update($request->all());

        return redirect()->route('superannuations.index')->with('success', 'Superannuation updated successfully.');
    }

    public function destroy($id)
    {
        $superannuation = Superannuation::findOrFail($id);
        $superannuation->delete();

        return redirect()->route('superannuations.index')->with('success', 'Superannuation deleted successfully.');
    }
}

