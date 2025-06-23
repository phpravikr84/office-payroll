<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayLocation;
use DB;

class PayLocationController extends Controller
{
    public function index()
    {
        $payLocations = PayLocation::all();
        return view('administrator.setting.pay_locations.index', compact('payLocations'));
    }

    public function create()
    {
        $bankLists = DB::table('bank_list')->get();
        return view('administrator.setting.pay_locations.create', compact('bankLists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payroll_location_code' => 'required|string|max:255|unique:pay_locations',
            'payroll_location_name' => 'required|string|max:255',
            'bank_id' => 'required',
            'bank_detail_id' => 'required',
            'status' => 'required|in:0,1',
        ]);

        PayLocation::create($request->all());

        return redirect()->route('pay_locations.index')->with('success', 'Pay Location created successfully.');
    }

    public function edit($id)
    {
        $payLocation = PayLocation::findOrFail($id);
        return view('administrator.setting.pay_locations.edit', compact('payLocation'));
    }

    public function update(Request $request, $id)
    {
        $payLocation = PayLocation::findOrFail($id);
        $request->validate([
            'payroll_location_code' => 'required|string|max:255|unique:pay_locations,payroll_location_code,' . $payLocation->id,
            'payroll_location_name' => 'required|string|max:255',
            'bank_id' => 'required',
            'bank_detail_id' => 'required',
            'status' => 'required|in:0,1',
        ]);

        $payLocation->update($request->all());

        return redirect()->route('pay_locations.index')->with('success', 'Pay Location updated successfully.');
    }

    public function destroy($id)
    {
        $payLocation = PayLocation::findOrFail($id);
        $payLocation->delete();

        return redirect()->route('pay_locations.index')->with('success', 'Pay Location deleted successfully.');
    }

    public function getBankDetail($bankId)
    {
        $selectBoxBankDtls = ''; // Initialize string to hold the HTML options

        // Fetch bank details based on the selected bank
        $bankDtls = DB::table('bank_details')->where('bank_type', $bankId)->get();

        if ($bankDtls->isEmpty()) {
            return response()->json(['message' => 'No bank details found']);
        }

        // Loop through the fetched bank details and build the options
        foreach ($bankDtls as $bankDtl) {
            $selectBoxBankDtls .= '<option value="'.$bankDtl->id.'">'.$bankDtl->bank_detail_name.'</option>';
        }

        // Return the options as a JSON response
        return response()->json(['message' => 'success', 'bank_details' => $selectBoxBankDtls]);
    }

}
