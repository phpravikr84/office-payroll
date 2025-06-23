<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\User;
use App\Models\HraRate;
use App\Models\HraAreaPlace;
use App\Models\Allowance;
use App\Models\TaxResident;
use App\Models\DependentRebate;
use Illuminate\Http\Request;

class PayrollController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();

		return view('administrator.hrm.payroll.manage_salary', compact('employees'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function go(Request $request) {
		request()->validate([
			'user_id' => 'required',
		], [
			'user_id.required' => 'The employee name field is required',
		]);
		return redirect('/hrm/payroll/manage-salary/' . $request->user_id);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create($user_id) {
		$employee_id = $user_id;

		$loca_places = HraAreaPlace::query()
			->orderBy('loca_name', 'ASC')
			->orderBy('places', 'ASC')
			->get(['id', 'loca_name', 'places'])
			->toArray();

		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();

		$salary = Payroll::where('user_id', $employee_id)
			->first();

		if (!empty($salary)) {
			return view('administrator.hrm.payroll.edit_salary', compact('employees', 'employee_id', 'salary', 'loca_places'));
		} else {
			return view('administrator.hrm.payroll.create_salary', compact('employees', 'employee_id', 'loca_places'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$salary = request()->validate([
			'employee_type' => 'required',
			'basic_salary' => 'required|numeric',
			'house_rent_allowance' => 'nullable|numeric',
			'medical_allowance' => 'nullable|numeric',
			'special_allowance' => 'nullable|numeric',
			'provident_fund_contribution' => 'nullable|numeric',
			'other_allowance' => 'nullable|numeric',
			'provident_fund_deduction' => 'nullable|numeric',
			'other_deduction' => 'nullable|numeric',
			'resident_status' => 'required',
			'no_of_dependent' => 'nullable|numeric',
			'hourrate' => 'nullable|numeric',
			'overtime_hr' => 'nullable|numeric',
			'overtime_rate' => 'nullable|numeric',
			'overtime_amt'  => 'nullable|numeric',
			'sales_comm'  => 'nullable|numeric',
			'electricity_allowance'  => 'nullable|numeric',
			'security_allowance'  => 'nullable|numeric',
			'tax_deduction_a'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
			'tax_deduction_b'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
			'hr_place' => 'required',
			'hra_type' => 'required',
			'hra_amount_per_week'  => 'nullable|numeric',
			'va_type' => 'required',
			'vehicle_allowance' => 'nullable|numeric',
			'meals_tag'  => 'nullable',
			'meals_allowance' => 'nullable|numeric',
		]);

		$result = Payroll::create($salary + ['created_by' => auth()->user()->id, 'user_id' => $request->user_id]);
		$inserted_id = $result->id;

		if (!empty($inserted_id)) {
			//return;
			return redirect('/hrm/payroll/salary-list')->with('message', 'Add successfully.');
		}
		return redirect('/hrm/payroll/salary-list')->with('exception', 'Operation failed !');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function hra($rentamt,$hra_type,$areatype) {
		//$rentamt1=$rentamt;
		if($hra_type=1){
		$hrarange = HraRate::query()
			->where('area_type', $areatype)
			->orderBy('wkly_hra_min_val', 'ASC')
			->get(['hra_amt','chk_amt','wkly_hra_min_val','wkly_hra_max_val'
				])
			->toArray();
		}else{
			$hrarange = HraRate::query()
			->where('area_type', $areatype)
			->orderBy('wkly_hra_min_val', 'ASC')
			->get(['hra_amt','chk_amt','wkly_hra_min_val','wkly_hra_max_val'
				])
			->toArray();
		}
		$hraamt = 0;
		foreach ($hrarange as $key => $value) {
			if ($rentamt <= $value['wkly_hra_max_val']) {
				$hraamt = $value['hra_amt'];
				break;
			}
		}
		return response([$hraamt]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function hra_area_src($hra_area_id) {
		//$rentamt1=$rentamt;
		$area_location = HraAreaPlace::query()
			->where('id', $hra_area_id)
			->get(['id', 'loca_name', 'places'])
			->toArray();

		foreach ($area_location as $key => $value) {
				$area_location1 = $value['loca_name'];
		}
		return response([$area_location1]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function taxcal($gross_sal,$dependent,$r_status) {
		if($r_status == 1){
			$gross_yr_sal = $gross_sal * 26 -200;
		} else {
			$gross_yr_sal = $gross_sal * 26;
		}
		$tax_details = TaxResident::query()
		->whereRaw('? between min_amt and max_amt', [$gross_yr_sal])
		->where('resi_status', $r_status)
		->get(['gross_tax_per', 'deduted_amt'])
		->toArray();
		$tax_per = 0;
		$deduted_amt=0;
		foreach ($tax_details as $key => $value) {
			$tax_per = $value['gross_tax_per']/100;
			$deduted_amt = $value['deduted_amt'];
		}
		$gr_tax_amt = ($gross_yr_sal * $tax_per) - $deduted_amt;
		if($dependent >= 3){
			$dependent = 3;
		}
		$depend_qry = DependentRebate::query()
			->where('no_of_dependent', $dependent)
			->get(['rebate_amt1','rebate_amt2','per_of_tax'
				])
			->toArray();
		if(count($depend_qry) > 0){
			foreach ($depend_qry as $key => $value) {
				$rebate_amt1 = $value['rebate_amt1'];
				$rebate_amt2 = $value['rebate_amt2'];
				$per_of_tax = $value['per_of_tax'];
			}
			$rebate_amt = $per_of_tax/100 * $gr_tax_amt;
			if($rebate_amt > $rebate_amt2){
				$rebate_amt = $rebate_amt2;
			}
			if($rebate_amt < $rebate_amt1){
				$rebate_amt = $rebate_amt1;
			}
		} else {
			$rebate_amt = 0;
		}
		$net_tax_amt = $gr_tax_amt - $rebate_amt;
		// $gr_tax_amt = number_format($gr_tax_amt/26, 2, '.', ',');
		// return response([$gr_tax_amt]);
		$frt_tax_amt = $net_tax_amt/26;
		return response()->json(['frt_tax_amt' => $frt_tax_amt]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function vehicle($va_type) {
		$va_amount = Allowance::query()
			->where('id', $va_type)
			->get(['amount'
				])
			->toArray();
		$va_amt = 0;
		foreach ($va_amount as $key => $value) {
			$va_amt = $value['amount'];
		}
		return response([$va_amt]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function meals($meals_type) {
		$meals_amount = Allowance::query()
			->where('id', $meals_type)
			->get(['amount'
				])
			->toArray();
		$meals_allowance = 0;
		foreach ($meals_amount as $key => $value) {
			$meals_allowance = $value['amount'];
		}
		return response([$meals_allowance]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function list() {
		$salaries = Payroll::query()
			->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
			->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.deletion_status', 0)
			->get([
				'payrolls.*',
				'users.name',
				'designations.designation',
			])
			->toArray();
		return view('administrator.hrm.payroll.salary_list', compact('salaries'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Payroll  $payroll
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$salary = Payroll::query()
			->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
			->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
			->leftjoin('departments', 'designations.department_id', '=', 'departments.id')
			->orderBy('users.name', 'ASC')
			->where('payrolls.id', $id)
			->where('users.deletion_status', 0)
			->first([
				'payrolls.*',
				'users.name',
				'users.avatar',
				'designations.designation',
				'departments.department',
			])
			->toArray();
		return view('administrator.hrm.payroll.salary_details', compact('salary'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Payroll  $payroll
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$salary = Payroll::find($id);
		request()->validate([
			'employee_type' => 'required',
			'basic_salary' => 'required|numeric',
			'house_rent_allowance' => 'nullable|numeric',
			'medical_allowance' => 'nullable|numeric',
			'special_allowance' => 'nullable|numeric',
			'provident_fund_contribution' => 'nullable|numeric',
			'other_allowance' => 'nullable|numeric',
			'provident_fund_deduction' => 'nullable|numeric',
			'other_deduction' => 'nullable|numeric',
			'resident_status' => 'required',
			'no_of_dependent' => 'nullable|numeric',
			'hourrate' => 'nullable|numeric',
			'overtime_hr' => 'nullable|numeric',
			'overtime_rate' => 'nullable|numeric',
			'overtime_amt'  => 'nullable|numeric',
			'sales_comm'  => 'nullable|numeric',
			'electricity_allowance'  => 'nullable|numeric',
			'security_allowance'  => 'nullable|numeric',
			'tax_deduction_a'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
			'tax_deduction_b'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
			'hr_place' => 'required',
			'hra_type' => 'required',
			'hra_amount_per_week'  => 'nullable|numeric',
			'va_type' => 'required',
			'vehicle_allowance' => 'nullable|numeric',
			'meals_tag'  => 'nullable',
			'meals_allowance' => 'nullable|numeric',
		]);

		$salary->employee_type = $request->get('employee_type');
		$salary->basic_salary = $request->get('basic_salary');
		$salary->house_rent_allowance = $request->get('house_rent_allowance');
		$salary->medical_allowance = $request->get('medical_allowance');
		$salary->special_allowance = $request->get('special_allowance'); // Telephone allowance
		$salary->provident_fund_contribution = $request->get('provident_fund_contribution');
		$salary->other_allowance = $request->get('other_allowance'); //	Servant Allowance
		$salary->provident_fund_deduction = $request->get('provident_fund_deduction');
		$salary->other_deduction = $request->get('other_deduction');
		$salary->resident_status = $request->get('resident_status');
		$salary->no_of_dependent = $request->get('no_of_dependent');
		$salary->declaration_lodge_status = $request->get('declaration_lodge_status');
		$salary->hrly_salary_rate = $request->get('hrly_salary_rate');
		$salary->overtime_hr = $request->get('overtime_hr');
		$salary->overtime_rate = $request->get('ovretime_rate');
		$salary->overtime_amt = $request->get('overtime_amt');
		$salary->sales_comm = $request->get('sales_comm');
		$salary->electricity_allowance = $request->get('electricity_allowance');
		$salary->security_allowance = $request->get('security_allowance');
		$salary->tax_deduction_a = $request->get('tax_deduction_a');
		$salary->tax_deduction_b = $request->get('tax_deduction_b');
		$salary->hr_place = $request->get('hr_place');
		$salary->hr_area = $request->get('hr_area');
		$salary->hra_type = $request->get('hra_type');
		$salary->hra_amount_per_week = $request->get('hra_amount_per_week');
		$salary->va_type = $request->get('va_type');
		$salary->vehicle_allowance = $request->get('vehicle_allowance');
		$salary->meals_tag = $request->get('meals_tag');
		$salary->meals_allowance = $request->get('meals_allowance');
		$affected_row = $salary->save();

		if (!empty($affected_row)) {
			return redirect('/hrm/payroll/salary-list')->with('message', 'Update successfully.');
		}
		return redirect('/hrm/payroll/salary-list')->with('exception', 'Operation failed !');

		$result = Payroll::create($salary + ['created_by' => auth()->user()->id, 'user_id' => $request->user_id]);
		$inserted_id = $result->id;

		if (!empty($inserted_id)) {
			return redirect('/hrm/payroll/salary-list')->with('message', 'Add successfully.');
		}
		return redirect('/hrm/payroll/salary-list')->with('exception', 'Operation failed !');
	}
}
