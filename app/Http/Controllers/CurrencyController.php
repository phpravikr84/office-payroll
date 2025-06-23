<?php
namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return view('administrator.setting.currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('administrator.setting.currencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency_code' => 'required|unique:currencies|max:10',
            'currency_name' => 'required|max:255',
            'exchange_rate' => 'required|numeric',
            'exchange_currency' => 'required|max:10',
            'last_er_update' => 'required|date',
            'status' => 'required|boolean',
        ]);

        Currency::create($request->all());

        return redirect()->route('currencies.index')->with('success', 'Currency created successfully.');
    }

    public function edit(Currency $currency)
    {
        return view('administrator.setting.currencies.edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'currency_code' => 'required|max:10|unique:currencies,currency_code,' . $currency->id,
            'currency_name' => 'required|max:255',
            'exchange_rate' => 'required|numeric',
            'exchange_currency' => 'required|max:10',
            'last_er_update' => 'required|date',
            'status' => 'required|boolean',
        ]);

        $currency->update($request->all());

        return redirect()->route('currencies.index')->with('success', 'Currency updated successfully.');
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully.');
    }
}
