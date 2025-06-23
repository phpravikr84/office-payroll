<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overtime;

class OvertimeController extends Controller
{
    public function index()
    {
        $overtimes = Overtime::get();
        return view('administrator.setting.overtime.index', compact('overtimes'));
    }


    public function create()
    {
        return view('administrator.setting.overtime.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required|unique:overtime_list,code',
            'name' => 'required',
            'fixed_amount' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return redirect('/administrator/setting/overtime')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        $overtime = new Overtime();
        $overtime->code = $request->code;
        $overtime->name = $request->name;
        $overtime->fixed_amount = $request->fixed_amount;
        $overtime->save();
    
        return redirect('/setting/overtime')->with('success', 'Overtime added successfully.');
    }
    

    public function edit($id)
    {
        $overtime = Overtime::find($id);

        if (!$overtime) {
            return redirect('/etting/overtime')->with('error', 'Overtime not found.');
        }
    
        return view('administrator.setting.overtime.edit', compact('overtime'));
    }
    

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required|unique:overtime_list,code,' . $id,
            'name' => 'required',
            'fixed_amount' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return redirect('/setting/overtime/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        $overtime = Overtime::find($id);
        if (!$overtime) {
            return redirect('/setting/overtime')->with('error', 'Overtime not found.');
        }
    
        $overtime->code = $request->code;
        $overtime->name = $request->name;
        $overtime->fixed_amount = $request->fixed_amount;
        $overtime->save();
    
        return redirect('/setting/overtime')->with('success', 'Overtime updated successfully.');
    }
    

    public function published($id)
    {
        $overtime = Overtime::find($id);
        $overtime->status = 1;
        $overtime->save();

        return redirect('/setting/overtime')->with('success', 'Overtime published successfully.');
    }

    public function unpublished($id)
    {
        $overtime = Overtime::find($id);
        $overtime->status = 0;
        $overtime->save();

        return redirect('/setting/overtime')->with('success', 'Overtime unpublished successfully.');
    }

    public function destroy($id)
    {
        $overtime = Overtime::find($id);
        $overtime->delete();

        return redirect('/setting/overtime')->with('success', 'Overtime deleted successfully.');
    }
}
