<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GLCode;

class GLCodeController extends Controller
{
    public function index()
    {
        $glCodes = GLCode::all();
        return view('administrator.setting.gl_codes.index', compact('glCodes'));
    }

    public function create()
    {
        return view('administrator.setting.gl_codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gl_code' => 'required|string|max:255|unique:gl_codes',
            'gl_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        GLCode::create($request->all());

        return redirect()->route('gl_codes.index')->with('success', 'GL Code created successfully.');
    }

    public function edit($id)
    {
        $glCode = GLCode::findOrFail($id);
        return view('administrator.setting.gl_codes.edit', compact('glCode'));
    }

    public function update(Request $request, $id)
    {
        $glCode = GLCode::findOrFail($id);
        $request->validate([
            'gl_code' => 'required|string|max:255|unique:gl_codes,gl_code,' . $glCode->id,
            'gl_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $glCode->update($request->all());

        return redirect()->route('gl_codes.index')->with('success', 'GL Code updated successfully.');
    }

    public function destroy($id)
    {
        $glCode = GLCode::findOrFail($id);
        $glCode->delete();

        return redirect()->route('gl_codes.index')->with('success', 'GL Code deleted successfully.');
    }
}
