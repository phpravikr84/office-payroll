<?php

namespace App\Http\Controllers;

use App\Models\GlInterfaceControlFile;
use App\Models\GLCode;
use Illuminate\Http\Request;

class GlInterfaceControlFileController extends Controller
{
    public function index()
    {
        $controlFiles = GlInterfaceControlFile::join('gl_codes', 'gl_codes.id', '=', 'gl_interface_control_files.gl_code_account_name')
        ->select('gl_interface_control_files.*', 'gl_codes.gl_name') // Select all columns from both tables, adjust as needed
        ->get();
        $glCodes = GLCode::all();
        return view('administrator.setting.gl_interface_control_files.index', compact('controlFiles', 'glCodes'));
    }

    public function create()
    {
        $glCodes = GLCode::all();
        return view('administrator.setting.gl_interface_control_files.create', compact('glCodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'control_setup_name' => 'nullable|string',
            'gl_code_account_name' => 'nullable|string',
        ]);

        GlInterfaceControlFile::create($request->all());

        return redirect()->route('gl_interface_control_files.index')->with('success', 'Control file created successfully.');
    }

    public function edit($id)
    {
        $controlFile = GlInterfaceControlFile::findOrFail($id);
        $glCodes = GLCode::all();
        return view('administrator.setting.gl_interface_control_files.edit', compact('controlFile', 'glCodes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'control_setup_name' => 'nullable|string',
            'gl_code_account_name' => 'nullable|string',
        ]);

        $controlFile = GlInterfaceControlFile::findOrFail($id);
        $controlFile->update($request->all());

        return redirect()->route('gl_interface_control_files.index')->with('success', 'Control file updated successfully.');
    }

    public function destroy($id)
    {
        $controlFile = GlInterfaceControlFile::findOrFail($id);
        $controlFile->delete();

        return redirect()->route('gl_interface_control_files.index')->with('success', 'Control file deleted successfully.');
    }
}
