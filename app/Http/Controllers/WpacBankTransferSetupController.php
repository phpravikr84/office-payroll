<?php

namespace App\Http\Controllers;

use App\Models\WpacBankTransferSetup;
use App\Models\WpacSettingBank;
use App\Models\GLCode;
use App\Models\Bank; // Assuming Bank model exists
use Illuminate\Http\Request;
use DB;

class WpacBankTransferSetupController extends Controller
{
    public function index()
    {
        $wpacBankTransferSetups = WpacBankTransferSetup::all();
        $glCodes = GLCode::all();
        $bankList = Bank::where('status', '1')->get(); // Fetch active banks

        $wpacSettingBanks = WpacSettingBank::join('bank_list', 'bank_list.id', '=', 'wpac_setting_banks.bank_id')
            ->select('wpac_setting_banks.*', 'bank_list.bank_name') // Select all columns from both tables, adjust as needed
            ->get();

        return view('administrator.setting.wpac_bank_transfer_setup.index', compact('wpacBankTransferSetups', 'bankList', 'glCodes', 'wpacSettingBanks'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'wpac_customer_reference' => 'nullable|string',
            'wpac_folder_directory' => 'nullable|string',
            'gl_code_id' => 'nullable|integer',
        ]);

        // Replace null values with default values
        $validatedData['wpac_customer_reference'] = $validatedData['wpac_customer_reference'] ?? '';
        $validatedData['wpac_folder_directory'] = $validatedData['wpac_folder_directory'] ?? '';
        $validatedData['gl_code_id'] = $validatedData['gl_code_id'] ?? null;

        // Check if it's an update or create operation
        if ($request->id) {
            $wpacBankTransferSetup = WpacBankTransferSetup::findOrFail($request->id);

            if ($wpacBankTransferSetup) {
                $wpacBankTransferSetup->update($validatedData);
            }

            return response()->json(['updated' => true]);
        } else {
            $wpacBankTransferSetup = WpacBankTransferSetup::create($validatedData);
            return response()->json(['created' => true]);
        }
    }

    public function edit($id)
    {
        $transferSetup = WpacBankTransferSetup::findOrFail($id);
        return response()->json($transferSetup);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'wpac_customer_reference' => 'nullable|string',
            'wpac_folder_directory' => 'nullable|string',
            'gl_code_id' => 'nullable|integer',
        ]);

        $transferSetup = WpacBankTransferSetup::findOrFail($id);
        $transferSetup->update($request->all());
        return redirect()->route('wpac_bank_transfer_setups.index')->with('success', 'Setup updated successfully.');
    }

    public function destroy($id)
    {
        WpacBankTransferSetup::destroy($id);
        return redirect()->route('wpac_bank_transfer_setups.index')->with('success', 'Setup deleted successfully.');
    }

    public function getBankTransferSetup()
    {
        $setup = WpacBankTransferSetup::first();
        
        if ($setup) {
            return response()->json(['exists' => true, 'data' => $setup]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function checkBankExists(Request $request)
    {
        $exists = WpacSettingBank::where('bank_id', $request->bank_id)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function storeBank(Request $request)
    {
        $bank = DB::table('bank_list')->where('id', $request->bank_id)->first();
        if ($bank) {
            try {
                // Attempt to create the record in wpac_setting_banks
                WpacSettingBank::create([
                    'wpac_setting_id' => $request->wpac_setting_id, // Assuming this field exists
                    'bank_id' => $request->bank_id,
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
        WpacSettingBank::where('bank_id', $request->bank_id)->delete();
        return response()->json(['success' => true]);
    }

    public function updateBank(Request $request)
    {
        WpacSettingBank::where('bank_id', $request->bank_id)
            ->update(['transaction_fee' => $request->transaction_fee]); // Adjust if transaction_fee is applicable

        return response()->json(['success' => true]);
    }
}
