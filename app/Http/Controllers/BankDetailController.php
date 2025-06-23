<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankDetail;
use App\Models\Bank;

class BankDetailController extends Controller
{
    public function index()
    {
        $bankDetails = BankDetail::all();
        return view('administrator.setting.bank_details.manage', compact('bankDetails'));
    }

    public function create()
    {
        $banks = Bank::all();
        return view('administrator.setting.bank_details.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_detail_code' => 'required|unique:bank_details',
            'bank_detail_name' => 'required',
            'bsb_number' => 'required',
            'bank_type' => 'required',
            'bank_address' => 'required',
            'bank_phone' => 'required',
            'employment_account_number' => 'required',
            'account_suffix' => 'required',
            'status'   => 'required'
        ]);

        BankDetail::create($request->all());

        return redirect('/setting/bank_details')->with('success', 'Bank detail added successfully.');
    }

    public function edit($id)
    {
        $bank_details = BankDetail::find($id);
        $banks = Bank::all();
        return view('administrator.setting.bank_details.edit', compact('bank_details', 'banks'));
    }

    public function update(Request $request, $id)
    {
        // Find the bank detail record by ID
        $bank_detail = BankDetail::find($id);

        if (!$bank_detail) {
            return redirect('/setting/bank_details')->with('exception', 'Bank detail not found!');
        }

        // Validate the incoming request
        $request->validate([
            'bank_detail_code' => 'required',
            'bank_detail_name' => 'required',
            'bsb_number' => 'required',
            'bank_type' => 'required',
            'bank_address' => 'required',
            'bank_phone' => 'required',
            'employment_account_number' => 'required',
            'account_suffix' => 'required',
            'status' => 'required',
        ]);


        // Update the bank detail record with specified request data
        $bank_detail->update([
            'bank_detail_code' => $request['bank_detail_code'],
            'bank_detail_name' => $request['bank_detail_name'],
            'bsb_number' => $request['bsb_number'],
            'bank_type' => $request['bank_type'],
            'bank_phone' => $request['bank_phone'],
            'employment_account_number' => $request['employment_account_number'],
            'account_suffix' => $request['account_suffix'],
            'status' => $request['status'],
            'bank_address' => $request['bank_address']
        ]);


        // Flash a session message and redirect to a specific route
        session()->flash('submitted_form', 'update_contact_form');
        return redirect('/setting/bank_details')->with('success', 'Bank detail updated successfully.');
    }


    public function published($id)
    {
        $bankDetail = BankDetail::find($id);
        $bankDetail->status = '1';
        $bankDetail->save();

        return redirect('/setting/bank_details')->with('success', 'Bank detail published successfully.');
    }

    public function unpublished($id)
    {
        $bankDetail = BankDetail::find($id);
        $bankDetail->status = '0';
        $bankDetail->save();

        return redirect('/setting/bank_details')->with('success', 'Bankd detail unpublished successfully.');
    }

    public function destroy($id)
    {
        $bankDetail = BankDetail::find($id);
        $bankDetail->delete();

        return redirect('/setting/bank_details')->with('success', 'Bank detail deleted successfully.');
    }
}
