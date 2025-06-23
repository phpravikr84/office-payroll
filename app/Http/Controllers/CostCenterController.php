<?php

namespace App\Http\Controllers;

use App\Models\CostCenter;
use App\Models\Department;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{
    public function index()
    {
        $costcenters = CostCenter::with('departments')->get();
        return view('administrator.setting.costcenters.index', compact('costcenters'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('administrator.setting.costcenters.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cost_center_code' => 'required',
            'department_id' => 'required|array',
            'department_id.*' => 'exists:departments,id',
            'status' => 'required|boolean',
        ]);

        // Create the cost center first
        $costCenter = CostCenter::create([
            'name' => $request->name,
            'cost_center_code' => $request->cost_center_code,
            'status' => $request->status,
        ]);

        // Attach the selected departments
        $costCenter->departments()->sync($request->department_id);

        return redirect()->route('costcenters.index')->with('success', 'Cost Center created successfully.');
    }

    public function edit($id)
    {
        $costcenter = CostCenter::with('departments')->findOrFail($id);
        $departments = Department::all();

        return view('administrator.setting.costcenters.edit', compact('costcenter', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'cost_center_code' => 'required',
            'department_id' => 'required|array',
            'department_id.*' => 'exists:departments,id',
            'status' => 'required|boolean',
        ]);

        // Find the existing CostCenter record
        $costCenter = CostCenter::findOrFail($id);

        // Update the cost center's attributes
        $costCenter->update([
            'name' => $request->name,
            'cost_center_code' => $request->cost_center_code,
            'status' => $request->status,
        ]);

        // Sync the departments to update the pivot table
        $costCenter->departments()->sync($request->department_id);

        return redirect()->route('costcenters.index')->with('success', 'Cost Center updated successfully.');
    }

    public function destroy(CostCenter $costcenter)
    {
        // Detach all departments before deleting the cost center
        $costcenter->departments()->detach();
        $costcenter->delete();

        return redirect()->route('costcenters.index')->with('success', 'Cost Center deleted successfully.');
    }

    public function getDepartmentsByCostCenter($costCenterId)
    {
        $costCenter = CostCenter::with('departments')->findOrFail($costCenterId);
        
        $departments = $costCenter->departments;
        
        $sharePercentages = [];
        $totalDepartments = $departments->count();
        
        if ($totalDepartments > 1) {
            // Example: Distribute percentages equally among departments
            $sharePercentage = 100 / $totalDepartments;
            foreach ($departments as $department) {
                $sharePercentages[$department->id] = round($sharePercentage, 2);
            }
        } else {
            // Single department, set 100%
            foreach ($departments as $department) {
                $sharePercentages[$department->id] = 100;
            }
        }

        return response()->json([
            'departments' => $departments,
            'sharePercentages' => $sharePercentages
        ]);
    }


}
