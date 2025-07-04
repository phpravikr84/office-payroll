<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodDefinationRate;

class PeriodDefinationRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodDefinationRates = PeriodDefinationRate::all();
        return view('administrator.setting.period_defination_rates.index', compact('periodDefinationRates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.setting.period_defination_rates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:period_defination_rates,code',
            'name' => 'required',
            'pay_unit' => 'required',
            'pays_per_year' => 'required',
            'hours_per_day' => 'required',
            'hours_per_pay' => 'required',
            'days_per_pay' => 'required',
            // Add other validation rules as needed
        ]);

        PeriodDefinationRate::create($request->all());
        return redirect()->route('period_defination_rates.index')
                         ->with('success', 'Period Definition Rate created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeriodDefinationRate  $periodDefinationRate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $periodDefinationRate = PeriodDefinationRate::findOrFail($id);
        return view('administrator.setting.period_defination_rates.edit', compact('periodDefinationRate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeriodDefinationRate  $periodDefinationRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $periodDefinationRate = PeriodDefinationRate::findOrFail($id);
        $request->validate([
            'code' => 'required|unique:period_defination_rates,code,' . $id,
            'name' => 'required',
            'pay_unit' => 'required',
            'pays_per_year' => 'required',
            'hours_per_day' => 'required',
            'hours_per_pay' => 'required',
            'days_per_pay' => 'required',
            // Add other validation rules as needed
        ]);

        $periodDefinationRate->update($request->all());
        return redirect()->route('period_defination_rates.index')
                         ->with('success', 'Period Definition Rate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeriodDefinationRate  $periodDefinationRate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodDefinationRate = PeriodDefinationRate::findOrFail($id);
        $periodDefinationRate->delete();
        return redirect()->route('period_defination_rates.index')
                         ->with('success', 'Period Definition Rate deleted successfully.');
    }
}
