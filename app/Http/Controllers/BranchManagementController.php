<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchManagementController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('administrator.setting.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('administrator.setting.branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_code' => 'required|unique:branches',
            'branch_name' => 'required',
            'branch_address' => 'required',
        ]);

        Branch::create($request->all());

        return redirect()->route('branches.index')
                         ->with('success', 'Branch created successfully.');
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('setting..branches.show', compact('branch'));
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('administrator.setting.branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_code' => 'required|unique:branches,branch_code,'.$id,
            'branch_name' => 'required',
            'branch_address' => 'required',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update($request->all());

        return redirect()->route('branches.index')
                         ->with('success', 'Branch updated successfully.');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')
                         ->with('success', 'Branch deleted successfully.');
    }
}
