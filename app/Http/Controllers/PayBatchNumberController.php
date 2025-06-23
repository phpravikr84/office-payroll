<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayBatchNumber;

class PayBatchNumberController extends Controller
{
    public function index()
    {
        $payBatchNumbers = PayBatchNumber::all();
        return view('administrator.setting.pay_batch_numbers.index', compact('payBatchNumbers'));
    }

    public function create()
    {
        return view('administrator.setting.pay_batch_numbers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pay_batch_number_code' => 'required|string|max:255|unique:pay_batch_numbers',
            'pay_batch_number_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        PayBatchNumber::create($request->all());

        return redirect()->route('pay_batch_numbers.index')->with('success', 'Pay Batch Number created successfully.');
    }

    public function edit($id)
    {
        $payBatchNumber = PayBatchNumber::findOrFail($id);
        return view('administrator.setting.pay_batch_numbers.edit', compact('payBatchNumber'));
    }

    public function update(Request $request, $id)
    {
        $payBatchNumber = PayBatchNumber::findOrFail($id);
        $request->validate([
            'pay_batch_number_code' => 'required|string|max:255|unique:pay_batch_numbers,pay_batch_number_code,' . $payBatchNumber->id,
            'pay_batch_number_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $payBatchNumber->update($request->all());

        return redirect()->route('pay_batch_numbers.index')->with('success', 'Pay Batch Number updated successfully.');
    }

    public function destroy($id)
    {
        $payBatchNumber = PayBatchNumber::findOrFail($id);
        $payBatchNumber->delete();

        return redirect()->route('pay_batch_numbers.index')->with('success', 'Pay Batch Number deleted successfully.');
    }
}
