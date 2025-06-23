<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayAccumulator;

class PayAccumulatorController extends Controller
{
    public function index()
    {
        $payAccumulators = PayAccumulator::all();
        return view('administrator.setting.pay_accumulators.index', compact('payAccumulators'));
    }

    public function create()
    {
        return view('administrator.setting.pay_accumulators.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pay_accumulator_code' => 'required|string|max:255|unique:pay_accumulators',
            'pay_accumulator_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        PayAccumulator::create($request->all());

        return redirect()->route('pay_accumulators.index')->with('success', 'Pay Accumulator created successfully.');
    }

    public function edit($id)
    {
        $payAccumulator = PayAccumulator::findOrFail($id);
        return view('administrator.setting.pay_accumulators.edit', compact('payAccumulator'));
    }

    public function update(Request $request, $id)
    {
        $payAccumulator = PayAccumulator::findOrFail($id);
        $request->validate([
            'pay_accumulator_code' => 'required|string|max:255|unique:pay_accumulators,pay_accumulator_code,' . $payAccumulator->id,
            'pay_accumulator_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $payAccumulator->update($request->all());

        return redirect()->route('pay_accumulators.index')->with('success', 'Pay Accumulator updated successfully.');
    }

    public function destroy($id)
    {
        $payAccumulator = PayAccumulator::findOrFail($id);
        $payAccumulator->delete();

        return redirect()->route('pay_accumulators.index')->with('success', 'Pay Accumulator deleted successfully.');
    }
}
