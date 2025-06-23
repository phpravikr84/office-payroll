<?php

namespace App\Http\Controllers;
use App\Models\LoanMaster;


use Illuminate\Http\Request;

class LoanMasterController extends Controller
{
    public function index()
    {
        $loans = LoanMaster::all();
        return view('administrator.setting.loan_master.index', compact('loans'));
    }

    public function create()
    {
        return view('administrator.setting.loan_master.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_code' => 'required|unique:loan_master,loan_code',
            'loan_name' => 'required',
        ]);

        LoanMaster::create($request->all());

        return redirect()->route('loan_master.index')->with('success', 'Loan created successfully.');
    }

    public function edit($id)
    {
        $loan = LoanMaster::findOrFail($id);
        return view('administrator.setting.loan_master.edit', compact('loan'));
    }

    public function update(Request $request, $id)
    {
        $loan = LoanMaster::findOrFail($id);
        $request->validate([
            'loan_code' => 'required',
            'loan_name' => 'required',
        ]);
        $loan->loan_code = $request->get('loan_code');
        $loan->loan_name = $request->get('loan_name');
        $affected_row = $loan->save();

        if (!empty($affected_row)) {
            return redirect('/setting/loans')->with('message', 'Update successfully.');
        }
        return redirect('/setting/loans')->with('exception', 'Operation failed !');
    }
}
