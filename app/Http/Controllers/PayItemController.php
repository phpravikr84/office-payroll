<?php

namespace App\Http\Controllers;

use App\Models\PayItem;
use App\Models\GLCode;
use App\Models\PayAccumulator;
use App\Models\Bank;
use App\Models\BankDetail;
use App\Models\Superannuation;
use Illuminate\Http\Request;

class PayItemController extends Controller
{
    public function index()
    {
        $payItems = PayItem::all();
        $glCodes = GLCode::all();
        $accumulators = PayAccumulator::all();
         // Fetch the banks data
        $banks = Bank::all(); // Adjust this line based on your model and data retrieval logic
        $bankDetails = BankDetail::all();
        $supperannuations = Superannuation::all();

        return view('administrator.setting.pay_items.index', compact('payItems', 'glCodes', 'accumulators', 'banks', 'bankDetails', 'supperannuations'));
    }

    // public function store(Request $request)
    // {
    //     // Custom validation rules
    //     $validated = $request->validate([
    //         'code' => 'required|string|max:255',
    //         'name' => 'required|string|max:255',
    //         'accumulator' => 'nullable|exists:pay_accumulators,id',
    //         'glaccount' => 'nullable|exists:gl_codes,id',
    //         'tax_rate' => 'nullable|numeric',
    //         'spread_code' => 'nullable|string|max:255',
    //         'taxflag' => 'nullable|string|max:255',
    //         'bank_id' => 'nullable|integer',
    //         'bank_detail_id' => 'nullable|integer',
    //         'superannuation_fund_id' => 'nullable|integer',
    //         'payment_mode' => 'nullable|string|max:255',
    //         'fixed_amount' => 'nullable|numeric',
    //         'percentage' => 'nullable|numeric',
    //         'sequence' => 'nullable|string|max:255',
    //         'will_accure_leave' => 'nullable|in:0,1',
    //     ]);

    //     // Conditional validation for fixed_amount, percentage, sequence, and will_accure_leave
    //     if (empty($request->superannuation_fund_id)) {
    //         $request->validate([
    //             'fixed_amount' => 'nullable|numeric',
    //             'percentage' => 'nullable|numeric',
    //             'sequence' => 'nullable|string|max:255',
    //             'will_accure_leave' => 'nullable|in:0,1',
    //         ]);
    //     } else {
    //         $request->validate([
    //             'fixed_amount' => 'required|numeric',
    //             'percentage' => 'required|numeric',
    //             'sequence' => 'required|string|max:255',
    //             'will_accure_leave' => 'required|in:0,1',
    //         ]);
    //     }

    //     PayItem::create($validated);

    //     return response()->json(['success' => 'Pay item created successfully.']);
    // }


    public function edit($id)
    {
        $payItem = PayItem::findOrFail($id);
        return response()->json($payItem);
    }

    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'code' => 'required|string|max:255',
    //         'name' => 'required|string|max:255',
    //         'accumulator' => 'nullable|exists:pay_accumulators,id',
    //         'glaccount' => 'nullable|exists:gl_codes,id',
    //         'tax_rate' => 'nullable|numeric',
    //         'spread_code' => 'nullable|string|max:255',
    //         'taxflag' => 'nullable|string|max:255',
    //         'bank_id' => 'nullable|integer',
    //         'bank_detail_id' => 'nullable|integer',
    //         'superannuation_fund_id' => 'nullable|integer',
    //         'payment_mode' => 'nullable|string|max:255',
    //         'fixed_amount' => 'nullable|numeric',
    //         'percentage' => 'nullable|numeric',
    //         'sequence' => 'nullable|string|max:255',
    //         'will_accure_leave' => 'nullable|in:0,1'
    //     ]);

    //     $payItem = PayItem::findOrFail($id);
    //     $payItem->update($validated);

    //     return response()->json(['success' => 'Pay item updated successfully.']);
    // }
    public function store(Request $request)
    {
        // Default validation rules
        $rules = [
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'accumulator' => 'nullable|numeric',
            'glaccount' => 'nullable|numeric',
            'tax_rate' => 'nullable|numeric',
            'spread_code' => 'nullable|string|max:255',
            'taxflag' => 'nullable|string|max:255',
            'bank_id' => 'nullable|integer',
            'bank_detail_id' => 'nullable|integer',
            'superannuation_fund_id' => 'nullable|integer',
            'payment_mode' => 'nullable|string|max:255',
            'fixed_amount' => 'nullable|numeric',
            'percentage' => 'nullable|numeric',
            'sequence' => 'nullable|string|max:255',
            'will_accure_leave' => 'nullable|in:0,1',
        ];

        // Additional validation based on taxflag
        switch ($request->input('taxflag')) {
            case 'SE':
            case 'SEA':
            case 'SS':
            case 'SR':
            case 'SRA':
                $rules['superannuation_fund_id'] = 'required|integer';
                break;

            case 'BC':
            case 'NN':
            case 'BD':
            case 'GD':
                $rules['bank_id'] = 'required|integer';
                $rules['bank_detail_id'] = 'required|integer';
                break;
        }

        // Validate the request with the rules
        $validated = $request->validate($rules);

        // Create the PayItem
        PayItem::create($validated);

        return response()->json(['success' => 'Pay item created successfully.']);
    }

    public function update(Request $request, $id)
    {
        // Default validation rules
        $rules = [
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'accumulator' => 'nullable|numeric',
            'glaccount' => 'nullable|numeric',
            'tax_rate' => 'nullable|numeric',
            'spread_code' => 'nullable|string|max:255',
            'taxflag' => 'nullable|string|max:255',
            'bank_id' => 'nullable|integer',
            'bank_detail_id' => 'nullable|integer',
            'superannuation_fund_id' => 'nullable|integer',
            'payment_mode' => 'nullable|string|max:255',
            'fixed_amount' => 'nullable|numeric',
            'percentage' => 'nullable|numeric',
            'sequence' => 'nullable|string|max:255',
            'will_accure_leave' => 'nullable|in:0,1',
        ];

        // Additional validation based on taxflag
        switch ($request->input('taxflag')) {
            case 'SE':
            case 'SEA':
            case 'SS':
            case 'SR':
            case 'SRA':
                $rules['superannuation_fund_id'] = 'required|integer';
                break;

            case 'BC':
            case 'NN':
            case 'BD':
            case 'GD':
                $rules['bank_id'] = 'required|integer';
                $rules['bank_detail_id'] = 'required|integer';
                break;
        }

        // Validate the request with the rules
        $validated = $request->validate($rules);

        // Find and update the PayItem
        $payItem = PayItem::findOrFail($id);
        $payItem->update($validated);

        return response()->json(['success' => 'Pay item updated successfully.']);
    }


    public function destroy($id)
    {
        $payItem = PayItem::findOrFail($id);
        $payItem->delete();

        return response()->json(['success' => 'Pay item deleted successfully.']);
    }
}
