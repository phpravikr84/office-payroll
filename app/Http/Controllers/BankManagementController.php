<?php
namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankManagementController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('administrator.setting.bank_lists.index', compact('banks'));
    }

    public function create()
    {
        return view('administrator.setting.bank_lists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_code' => 'required|unique:bank_list',
            'bank_name' => 'required',
            'status' => 'required|in:0,1',
        ]);

        Bank::create($request->all());
        return redirect()->route('banks.index')->with('success', 'Bank created successfully.');
    }

    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('administrator.setting.bank_lists.edit', compact('bank'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bank_code' => 'required|unique:bank_list,bank_code,' . $id,
            'bank_name' => 'required',
            'status' => 'required|in:0,1',
        ]);

        $bank = Bank::findOrFail($id);
        $bank->update($request->all());
        return redirect()->route('banks.index')->with('success', 'Bank updated successfully.');
    }

    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        return redirect()->route('banks.index')->with('success', 'Bank deleted successfully.');
    }
}
