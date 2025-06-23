<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Superannuation;
use Illuminate\Http\Request;
use DB;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $superannuation =  Superannuation::all();
        return view('administrator.setting.companies.index', compact('companies', 'superannuation'));
    }

    public function create()
    {
        $superannuation =  Superannuation::all();
        $banks = DB::table('bank_list')->get();
        return view('administrator.setting.companies.create', compact('superannuation', 'banks'));
    }

    public function getBankDetails($id){
        $bankDtls = DB::table('bank_details')->where('bank_type', $id)->get();
        if(!$bankDtls){
            return response()->json(['error' => 'Bank Details not found'], 404);
        }
    
        $tables =  array(
            0 => 'anz_setting_banks', 
            1 => 'kina_setting_banks', 
            2 => 'wpac_setting_banks',
            3 => 'bsp_setting_banks'
        );
    
        $bankSettingId = null;
        $bankTransactionFee = null;
        $bankSettingTableName =  null;
    
        foreach($tables as $table){
            $bank_settings = DB::table($table)->where('bank_id', $id)->first();
            if ($bank_settings) {
                $bankSettingTableName = $table;
                $bankSettingId = $bank_settings->id;
                $bankTransactionFee = $bank_settings->transaction_fee;
                break;
            }
        }
    
        return response()->json([
            'bank_details' => json_encode($bankDtls),
            'setting_table_name' => $bankSettingTableName,
            'bank_setting_id' => $bankSettingId,
            'transaction_fee' => $bankTransactionFee,
        ]);
    }

    public function getEditBankDetails($id){
        $company = DB::table('companies')->where('id',  $id)->first();
        if(!$company){
            return response()->json(['error' => 'Company not found'], 404);
        }
        $bankDtls = DB::table('bank_details')->where('bank_type', $company->bank_id)->get();
        if(!$bankDtls){
            return response()->json(['error' => 'Bank Details not found'], 404);
        }
    
        $tables =  array(
            0 => 'anz_setting_banks', 
            1 => 'kina_setting_banks', 
            2 => 'wpac_setting_banks',
            3 => 'bsp_setting_banks'
        );
    
        $bankSettingId = null;
        $bankTransactionFee = null;
        $bankSettingTableName =  null;
    
        foreach($tables as $table){
            $bank_settings = DB::table($table)->where('bank_id', $id)->first();
            if ($bank_settings) {
                $bankSettingTableName = $table;
                $bankSettingId = $bank_settings->id;
                $bankTransactionFee = $bank_settings->transaction_fee;
                break;
            }
        }
    
        return response()->json([
            'bank_details' => json_encode($bankDtls),
            'setting_table_name' => $bankSettingTableName,
            'bank_setting_id' => $bankSettingId,
            'transaction_fee' => $bankTransactionFee,
        ]);
    }
    

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'trading_name' => 'nullable|string|max:255',
            'phone1' => 'nullable|string|max:15',
            'phone2' => 'nullable|string|max:15',
            'fax1' => 'nullable|string|max:15',
            'fax2' => 'nullable|string|max:15',
            'tax_number' => 'nullable|string|max:20',
            'business_number' => 'nullable|string|max:20',
            'initial_payroll_year' => 'nullable|integer',
            'current_payroll_year' => 'nullable|integer',
            'employee_limit' => 'nullable|integer',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'address_street_no' => 'nullable|string|max:255',
            'address_street_name' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255',
            'address_postcode' => 'nullable|string|max:10',
            'address_country' => 'nullable|string|max:255',
            'mailing_street_no' => 'nullable|string|max:255',
            'mailing_street_name' => 'nullable|string|max:255',
            'mailing_city' => 'nullable|string|max:255',
            'mailing_state' => 'nullable|string|max:255',
            'mailing_postcode' => 'nullable|string|max:10',
            'mailing_country' => 'nullable|string|max:255',
            'bank_id'  => 'nullable|integer',
            'bank_detail_id'  => 'nullable|integer',
            'setting_table_name'  => 'nullable|integer',
            'bank_setting_id'  => 'nullable|integer',
            'transaction_fee' =>   'nullable|string',
            'superannuation_id' => 'nullable|string',
            'superannuation_fund' => 'nullable|string|max:255',
            'superannuation_number' => 'nullable|string|max:20',
            'ncsl_number' => 'nullable|string|max:20',
        ]);

        Company::create($data);
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');

    }

    public function edit($id)
    {
        $company = Company::where('id', $id)->first();
        $superannuation =  Superannuation::all();
        $banks = DB::table('bank_list')->get();
        return view('administrator.setting.companies.edit', compact('company', 'superannuation', 'banks'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        // Find the company record by ID
        $company = Company::find($id);

        if (!$company) {
            return redirect('/setting/company')->with('exception', 'Company not found!');
        }

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'trading_name' => 'nullable|string|max:255',
            'phone1' => 'nullable|string|max:15',
            'phone2' => 'nullable|string|max:15',
            'fax1' => 'nullable|string|max:15',
            'fax2' => 'nullable|string|max:15',
            'tax_number' => 'nullable|string|max:20',
            'business_number' => 'nullable|string|max:20',
            'initial_payroll_year' => 'nullable|integer',
            'current_payroll_year' => 'nullable|integer',
            'employee_limit' => 'nullable|integer',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'address_street_no' => 'nullable|string|max:255',
            'address_street_name' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255',
            'address_postcode' => 'nullable|string|max:10',
            'address_country' => 'nullable|string|max:255',
            'mailing_street_no' => 'nullable|string|max:255',
            'mailing_street_name' => 'nullable|string|max:255',
            'mailing_city' => 'nullable|string|max:255',
            'mailing_state' => 'nullable|string|max:255',
            'mailing_postcode' => 'nullable|string|max:10',
            'mailing_country' => 'nullable|string|max:255',
            'bank_id'  => 'nullable|integer',
            'bank_detail_id'  => 'nullable|integer',
            'setting_table_name'  => 'nullable|integer',
            'transaction_fee' => 'nullable|numeric',
            'setting_table_name' => 'nullable|string|max:255',
            'superannuation_id' => 'nullable|integer',
            'superannuation_fund' => 'nullable|string|max:255',
            'superannuation_number' => 'nullable|string|max:20',
            'ncsl_number' => 'nullable|string|max:20',
        ]);

        // Update the company with validated data
        $updated = $company->update($request->all());

        if ($updated) {
            return redirect('/setting/company')->with('success', 'Company updated successfully.');
        }

        return redirect('/setting/company')->with('exception', 'Operation failed!');
    }


    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
