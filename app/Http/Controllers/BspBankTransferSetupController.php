<?php

namespace App\Http\Controllers;

use App\Models\BspBankTransferSetup;
use App\Models\BspSettingBank;
use App\Models\GLCode;
use App\Models\Bank; // Assuming BankList model exists
use Illuminate\Http\Request;
use DB;

class BspBankTransferSetupController extends Controller
{
    public function index()
    {
        $bspBankTransferSetups = BspBankTransferSetup::all();
        $glCodes = GLCode::all();
        $bankList = Bank::where('status', '1')->get(); // Fetch active banks
        $bspSettingBanks = BspSettingBank::join('bank_list', 'bank_list.id', '=', 'bsp_setting_banks.bank_id')
        ->select('bsp_setting_banks.*', 'bank_list.bank_name') // Select all columns from both tables, adjust as needed
        ->get();
    
        return view('administrator.setting.bsp_bank_transfer_setup.index', compact('bspBankTransferSetups', 'bankList', 'glCodes', 'bspSettingBanks'));
    }

    public function store(Request $request)
    {
        // Define default values for nullable fields
        $validatedData = $request->validate([
            'bsp_customer_reference' => 'nullable|string',
            'bsp_folder_directory' => 'nullable|string',
            'gl_account_code' => 'nullable',
        ]);
    
        // Replace null values with default empty strings or handle them appropriately
        $validatedData['bsp_customer_reference'] = $validatedData['bsp_customer_reference'] ?? '';
        $validatedData['bsp_folder_directory'] = $validatedData['bsp_folder_directory'] ?? '';
        $validatedData['gl_account_code'] = $validatedData['gl_account_code'] ?? null;
    
        // Check if it's an update or create operation
        if ($request->id) {
            $bspBankTransferSetups = BspBankTransferSetup::findOrFail($request->id);
            $bspBankTransferSetups->update($validatedData);
        } else {
            $bspBankTransferSetups = BspBankTransferSetup::create($validatedData);
        }
    
        return response()->json(['success' => true]);
    }
    

    public function edit($id)
    {
        $transferSetup = BspBankTransferSetup::findOrFail($id);
        return response()->json($transferSetup);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bsp_customer_reference' => 'nullable|string',
            'bsp_folder_directory' => 'nullable|string',
            'gl_account_code' => 'nullable|integer',
        ]);

        $transferSetup = BspBankTransferSetup::findOrFail($id);
        $transferSetup->update($request->all());
        return redirect()->route('bsp_bank_transfer_setups.index')->with('success', 'Setup updated successfully.');
    }

    public function destroy($id)
    {
        BspBankTransferSetup::destroy($id);
        return redirect()->route('bsp_bank_transfer_setups.index')->with('success', 'Setup deleted successfully.');
    }

    
    public function getBankTransferSetup()
    {
        $setup = BspBankTransferSetup::first();
        
        if ($setup) {
            return response()->json(['exists' => true, 'data' => $setup]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function checkBankExists(Request $request)
    {
        $exists = BspSettingBank::where('bank_id', $request->bank_id)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function storeBank(Request $request)
    {
        // Validate the incoming request
        // $request->validate([
        //     'bsp_setting_id' => 'required|exists:bsp_settings,id', // Assuming bsp_settings is the correct table
        //     'bank_id' => 'required|exists:banks,id',
        //     'transaction_fee' => 'required|numeric', // Adjust the validation as needed
        // ]);
        $bank = DB::table('bank_list')->where('id', $request->bank_id)->first();
        if($bank){
            try {
                // Attempt to create the record in bsp_setting_banks
                BspSettingBank::create([
                    'bsp_setting_id' => $request->bsp_setting_id,
                    'bank_id' => $request->bank_id,
                    'transaction_fee' => $request->transaction_fee,
                ]);

                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // If there is any error, catch it and return a response
                return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
            }
        } else {
              // Handle the error
                return response()->json(['error' => 'Bank does not exist'], 400);
        }

    }


    public function removeBank(Request $request)
    {
        BspSettingBank::where('bank_id', $request->bank_id)->delete();
        return response()->json(['success' => true]);
    }

    public function updateBank(Request $request)
    {
        BspSettingBank::where('bank_id', $request->bank_id)
            ->update(['transaction_fee' => $request->transaction_fee]);

        return response()->json(['success' => true]);
    }
}
