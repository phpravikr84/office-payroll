<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Role;
use App\Models\User;
use App\Models\Payroll;
use App\Models\HraRate;
use App\Models\HraAreaPlace;
use App\Models\Department;
use App\Models\LeaveCategory;
use DB;
use Illuminate\Http\Request;
use PDF;
use App\Models\WorkingDay;
use Carbon\Carbon;
Use App\Models\Superannuation;
use App\Models\BankDetail;
use App\Models\EmployeeContact;
use App\Models\UserDetail;

class EmplController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('employee_id', 'users.id', 'users.name', 'users.contact_no_one', 'users.created_at', 'users.activation_status', 'designations.designation')
			->orderBy('users.employee_id', 'ASC')
			->get()
			->toArray();
		
		// Fetch all leave categories
		$leaveCategories = LeaveCategory::where('publication_status', 1)->get();
		return view('administrator.people.employee.manage_employees', compact('employees', 'leaveCategories'));
	}

	public function print() {
		$employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('users.id', 'users.employee_id', 'users.name', 'users.email', 'users.present_address', 'users.contact_no_one', 'designations.designation')
			->orderBy('users.id', 'DESC')
			->get()
			->toArray();
		return view('administrator.people.employee.employees_print', compact('employees'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request, $id=null) {
		
		/**
		 * Get Employee ID exist in Url
		 */
		$reqOutput = $request->getRequestUri();
		// Use regex to extract the number from the URL
		if (preg_match('/\d+$/', $reqOutput, $matches)) {
			$number = $matches[0]; // Extracted number
			$empl_id = $number; // Output: 76
		} else {
			$empl_id = 0;
		}
		/**
		 * END
		 */

		$leaveCategories = LeaveCategory::where('publication_status', 1)->get();
					
		$designations = Designation::where('deletion_status', 0)
		->where('publication_status', 1)
		->orderBy('designation', 'ASC')
		->select('id', 'designation')
		->get()
		->toArray();
		$superannuations =  DB::table('superannuations')
							->leftJoin('bank_list', 'bank_list.id', 'superannuations.bank_name')
							->leftJoin('bank_details', 'bank_details.bank_type', 'bank_list.id')
							->select('superannuations.*', 'bank_list.bank_name', 'bank_list.bank_code', 'bank_details.bank_detail_code', 'bank_details.bsb_number', 'bank_details.bank_address', 'bank_details.bank_phone', 'bank_details.employment_account_number')
							->get();
		//$superannuations = Superannuation::all(); // Assuming your model is named Superannuation
		$bankDetails = BankDetail::all(); // Assuming your model is named BankDetail
		// Fetch all leave categories
		$leaveCategories = LeaveCategory::where('publication_status', 1)->get();
		$bankLists = DB::table('bank_list')->get();
		//dd($superannuations);
		if ($id) {
			// Code to handle the case when ID is passed
			// Fetch all leave categories
		
				$roles = Role::all();

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
				$employee_id = $id;
					$sumOfWorkingHours = WorkingDay::sum('working_hours');
					//Get Superannuation of Employee
				$companies = DB::table('companies')
				->leftJoin('superannuations', 'superannuations.id', '=', 'companies.superannuation_id')
				->select('companies.*', 'superannuations.code', 'superannuations.name')
				->get();
					return view('administrator.people.employee.add_employee', compact('designations', 'roles', 'loca_places', 'employees','leaveCategories', 'sumOfWorkingHours', 'employee_id', 'superannuations', 'bankDetails', 'bankLists', 'companies')); 
		} else {
			// Code to handle the case when ID is not passed
			$designations = Designation::where('deletion_status', 0)
				->where('publication_status', 1)
				->orderBy('designation', 'ASC')
				->select('id', 'designation')
				->get()
				->toArray();
			$roles = Role::all();

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

				$sumOfWorkingHours = WorkingDay::sum('working_hours');

				//Get Superannuation of Employee
				$companies = DB::table('companies')
				->leftJoin('superannuations', 'superannuations.id', '=', 'companies.superannuation_id')
				->select('companies.*', 'superannuations.code', 'superannuations.name')
				->get();

				$costcenters = DB::table('cost_centers')->get();

			return view('administrator.people.employee.add_employee', compact('designations', 'roles', 'loca_places', 'employees', 'sumOfWorkingHours', 'superannuations', 'bankDetails', 'leaveCategories', 'bankLists', 'companies', 'empl_id', 'costcenters')); 
		}
	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request)
	{
		 // Define URL validation regex
		 $url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
	 
		 // Validate the request data
		 $employee = $request->validate([
			 'employee_id' => 'required|max:250',
			 'name' => 'required|max:100',
			 'father_name' => 'nullable|max:100',
			 'mother_name' => 'nullable|max:100',
			 'spouse_name' => 'nullable|max:100',
			 'gender' => 'required',
			 'marital_status' => 'nullable',
			 'date_of_birth' => 'nullable|date',
			 'designation_id' => 'required|numeric',
			 'joining_date' => 'nullable|date',
			 'branch' => 'required|numeric',
			 'role' => 'required',
			 'employee_type' => 'required',
			 'resident_status' => 'required',
			 'academic_qualification' => 'nullable',
			 'professional_qualification' => 'nullable',
			 'experience' => 'nullable',
			 'web' => 'nullable|max:150|regex:' . $url,
			 'present_address' => 'required|max:250',
			 'city_pr' => 'nullable',
			 'state_pr' => 'nullable',
			 'postcode_pr' => 'nullable',
			 'country_pr' => 'nullable',
			 'permanent_address' => 'nullable|max:250',
			 'city' => 'nullable',
			 'state' => 'nullable',
			 'postcode' => 'nullable',
			 'country' => 'nullable',
			 'email' => 'required|email|unique:users|max:100',
			 'contact_no_one' => 'required|max:20',
			 'emergency_contact' => 'nullable|max:20',
		 ], [
			 'designation_id.required' => 'The designation field is required.',
			 'contact_no_one.required' => 'The contact no field is required.',
			 'web.regex' => 'The URL format is invalid.',
			 'joining_position.required' => 'The department field is required.',
			 'branch.required' => 'The branch field is required.',
		 ]);
	 
		 // Format dates using Carbon
		 if (!empty($request->date_of_birth)) {
			 $employee['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->format('Y-m-d');
		 }
	 
		 if (!empty($request->joining_date)) {
			 $employee['joining_date'] = Carbon::createFromFormat('d-m-Y', $request->joining_date)->format('Y-m-d');
		 }
	 
		 // Create the user and assign the role
		 $result = User::create($employee + ['created_by' => auth()->user()->id, 'access_label' => 2, 'password' => bcrypt(12345678)]);
		 $inserted_id = $result->id;
	 
		 //$result->attachRole(Role::where('name', $request->role)->first());
		 
	 
		 if (!empty($inserted_id)) {
			 // Update employee_id in User table
			 if (!empty($request->employee_id)) {
				 DB::table('users')->where('id', $inserted_id)->update(['employee_id' => $inserted_id]);
			 }
	 
			 // Insert into employee_relations table without duplicates
			 $existingRelation = DB::table('employee_relations')
				 ->where('emp_id', $inserted_id)
				 ->where('department_id', $request->joining_position)
				 ->where('branch_id', $request->branch)
				 ->where('payroll_location_id', $request->payroll_location)
				 ->where('payroll_batch_id', $request->pay_batch_number)
				 ->first();
	 
			 if (!$existingRelation) {
				 DB::table('employee_relations')->insert([
					 'emp_id' => $inserted_id,
					 'department_id' => $request->joining_position,
					 'branch_id' => $request->branch,
					 'payroll_location_id' => $request->payroll_location,
					 'payroll_batch_id' => $request->pay_batch_number,
					 'created_at' => now(),
					 'updated_at' => now(),
				 ]);
			 }
	 
			 // Insert into user_details table with the new user_id
			 UserDetail::create([
				 'user_id' => $inserted_id,
				 'present_address' => $request->present_address,
				 'city_pr' => $request->city_pr,
				 'state_pr' => $request->state_pr,
				 'postcode_pr' => $request->postcode_pr,
				 'country_pr' => $request->country_pr,
				 'permanent_address' => $request->permanent_address,
				 'city' => $request->city,
				 'state' => $request->state,
				 'postcode' => $request->postcode,
				 'country' => $request->country,
			 ]);
	 
			 // Store the successful insertion data in session
			 session()->put('employee_data', [
				 'employee' => $employee,
				 'user_id' => $inserted_id,
				 'relation_data' => [
					 'department_id' => $request->joining_position,
					 'branch_id' => $request->branch,
					 'payroll_location_id' => $request->payroll_location,
					 'payroll_batch_id' => $request->pay_batch_number,
				 ]
			 ]);
	 
			 session()->flash('submitted_form', 'add_employee_form');
			 return redirect('/people/employees/manage/' . $inserted_id)->with('message', 'Added successfully.');
		 }
	 
		 return redirect('/people/employees/manage')->with('exception', 'Operation failed!');
	}
	 
	 
	/**
	 * Update an existing employee.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function empl_update(Request $request, $id)
	{
		// Define URL validation regex
		$url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
		// Validate the request data
		$employee = $request->validate([
			'name' => 'required|max:100',
			'father_name' => 'nullable|max:100',
			'mother_name' => 'nullable|max:100',
			'spouse_name' => 'nullable|max:100',
			'email' => 'required|email|max:100|unique:users,email,' . $id,
			'contact_no_one' => 'required|max:20',
			'emergency_contact' => 'nullable|max:20',
			'web' => 'nullable|max:150|regex:' . $url,
			'gender' => 'required',
			'date_of_birth' => 'nullable|date',
			'present_address' => 'required|max:250',
			'permanent_address' => 'nullable|max:250',
			'home_district' => 'nullable|max:250',
			'academic_qualification' => 'nullable',
			'professional_qualification' => 'nullable',
			'experience' => 'nullable',
			'reference' => 'nullable',
			'joining_date' => 'nullable|date',
			'designation_id' => 'required|numeric',
			'joining_position' => 'required|numeric', // Department
			'branch' => 'required|numeric', // Branch
			'payroll_location' => 'required|numeric', // Payroll Location
			'pay_batch_number' => 'required|numeric', // Pay Batch Number
			'marital_status' => 'nullable',
			'id_name' => 'nullable',
			'id_number' => 'nullable|max:100',
			'role' => 'required',
			'employee_type' => 'required',
			'resident_status' => 'required',
			'no_of_dependent' => 'nullable|numeric',
		], [
			'designation_id.required' => 'The designation field is required.',
			'contact_no_one.required' => 'The contact no field is required.',
			'web.regex' => 'The URL format is invalid.',
			'joining_position.required' => 'The department field is required.',
			'branch.required' => 'The branch field is required.',
			'payroll_location.required' => 'The payroll location field is required.',
			'pay_batch_number.required' => 'The pay batch number field is required.',
		]);

		if (!empty($request->date_of_birth)) {
				$employee['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->format('Y-m-d');
			}

			if (!empty($request->joining_date)) {
				$employee['joining_date'] = Carbon::createFromFormat('d-m-Y', $request->joining_date)->format('Y-m-d');
			}

		try {
			// Format the dates using Carbon if they are provided
			

			// Update the user record
			$updated = User::where('id', $id)->update($employee + [
				'updated_by' => auth()->user()->id,
			]);

			if ($updated) {
				// Update employee_relations table
				$existingRelation = DB::table('employee_relations')
					->where('emp_id', $id)
					->where('department_id', $request->joining_position)
					->where('branch_id', $request->branch)
					->where('payroll_location_id', $request->payroll_location)
					->where('payroll_batch_id', $request->pay_batch_number)
					->first();

				if (!$existingRelation) {
					DB::table('employee_relations')
						->where('emp_id', $id)
						->updateOrInsert([
							'emp_id' => $id,
							'department_id' => $request->joining_position,
							'branch_id' => $request->branch,
							'payroll_location_id' => $request->payroll_location,
							'payroll_batch_id' => $request->pay_batch_number,
						], [
							'updated_at' => now(),
						]);
				}

				session()->flash('submitted_form', 'update_employee_form');
				return redirect('/people/employees/manage/' . $id)->with('message', 'Updated successfully.');
			}

			return redirect('/people/employees/manage')->with('exception', 'Update failed.');
		} catch (\Exception $e) {
			// Handle exceptions and errors
			\Log::error('Employee Update Error: ' . $e->getMessage()); // Log the error for debugging
			return redirect('/people/employees/manage')->with('exception', 'An error occurred: ' . $e->getMessage());
		}
	}

	 


	/**
	 * Store a newly created resource in Payroll storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function payroll_store(Request $request) {
		$salary = request()->validate([
			'employee_type' => 'required',
			'basic_salary' => 'required',
			'house_rent_allowance' => 'nullable|numeric',
			'medical_allowance' => 'nullable|numeric',
			'special_allowance' => 'nullable|numeric',
			'provident_fund_contribution' => 'nullable|numeric',
			'other_allowance' => 'nullable|numeric',
			'provident_fund_deduction' => 'nullable|numeric',
			'other_deduction' => 'nullable|numeric',
			'resident_status' => 'required',
			'no_of_dependent' => 'nullable|numeric',
			'hrly_salary_rate' => 'nullable',
			'overtime_hr' => 'nullable|numeric',
			'overtime_rate' => 'nullable|numeric',
			'overtime_amt'  => 'nullable|numeric',
			'sales_comm'  => 'nullable|numeric',
			'electricity_allowance'  => 'nullable|numeric',
			'security_allowance'  => 'nullable|numeric',
			'tax_deduction_a'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
			'tax_deduction_b'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
			'hr_place' => 'required',
			'hr_area' => 'required',
			'hra_type' => 'required',
			'hra_amount_per_week'  => 'nullable|numeric',
			'va_type' => 'required',
			'vehicle_allowance' => 'nullable|numeric',
			'meals_tag'  => 'nullable',
			'meals_allowance' => 'nullable|numeric',
			'annual_salary' => 'required',
		]);

		$result = Payroll::create($salary + ['created_by' => auth()->user()->id, 'user_id' => $request->user_id]);
		$inserted_id = $result->id;

		if (!empty($inserted_id)) {

			$salary = Payroll::where('user_id', $inserted_id)
				->first();
			
			//payroll_id associated with user
			User::where('id', $request->user_id)->update(['user_payroll_rel_id' => $inserted_id]);
			// Set session variable to indicate which form was submitted
			  // Set session variables
			  session()->flash('submitted_form', 'add_payroll_form');
			return redirect('/people/employees/manage/'.$request->user_id.'#payrollDetailsTab')->with('message', 'Add Payroll successfully.');
		}
		
		return redirect('/people/employees/manage')->with('exception', 'Operation failed !');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Payroll  $payroll
	 * @return \Illuminate\Http\Response
	 */
	public function payroll_update(Request $request, $id) {
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
			'hrly_salary_rate' => 'nullable|numeric',
			'overtime_hr' => 'nullable|numeric',
			'overtime_rate' => 'nullable|numeric',
			'overtime_amt'  => 'nullable|numeric',
			'sales_comm'  => 'nullable|numeric',
			'electricity_allowance'  => 'nullable|numeric',
			'security_allowance'  => 'nullable|numeric',
			'tax_deduction_a'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
			'tax_deduction_b'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
			'hr_place' => 'required',
			'hr_area' => 'required',
			'hra_type' => 'required',
			'hra_amount_per_week'  => 'nullable|numeric',
			'va_type' => 'required',
			'vehicle_allowance' => 'nullable|numeric',
			'meals_tag'  => 'nullable',
			'meals_allowance' => 'nullable|numeric',
			'annual_salary' => 'required',
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
		$salary->annual_salary =  $request->get('annual_salary');
		$affected_row = $salary->save();

		if (!empty($affected_row)) {
			return redirect('/people/employees/manage/'.$request->user_id.'#payrollDetailsTab')->with('message', 'Update Payroll successfully.');
		}
		return redirect('/people/employees/manage/'.$request->user_id.'#payrollDetailsTab')->with('exception', 'Operation failed !');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function active($id) {
		$affected_row = User::where('id', $id)
			->update(['activation_status' => 1]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Activate successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function deactive($id) {
		$affected_row = User::where('id', $id)
			->update(['activation_status' => 0]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Deactive successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//$employee_type = User::find($id)->toArray();
		$employee = DB::table('users')
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->select('users.*', 'designations.designation')
			->where('users.id', $id)
			->first();
		$created_by = User::where('id', $employee->created_by)
			->select('id', 'name')
			->first();
		$designations = Designation::where('deletion_status', 0)
			->select('id', 'designation')
			->get();
		$departments = Department::where('deletion_status', 0)
			->select('id', 'department')
			->get();	
		return view('administrator.people.employee.show_employee', compact('employee', 'created_by', 'designations', 'departments'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function pdf($id) {
		$employee = DB::table('users')
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->select('users.*', 'designations.designation')
			->where('users.id', $id)
			->first();

		$created_by = User::where('id', $employee->created_by)
			->select('id', 'name')
			->first();

		$designations = Designation::where('deletion_status', 0)
			->select('id', 'designation')
			->get();

		$pdf = PDF::loadView('administrator.people.employee.pdf', compact('employee', 'created_by', 'designations'));
		$file_name = 'EMP-' . $employee->id . '.pdf';
		return $pdf->download($file_name);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$employee = User::find($id)->toArray();
		$designations = Designation::where('deletion_status', 0)
			->where('publication_status', 1)
			->orderBy('designation', 'ASC')
			->select('id', 'designation')
			->get()
			->toArray();
		$roles = Role::all();
		return view('administrator.people.employee.edit_employee', compact('employee', 'roles', 'designations'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$employee = User::find($id);

		$url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

		request()->validate([
			'employee_id' => 'required|max:250',
			'name' => 'required|max:100',
			'father_name' => 'nullable|max:100',
			'mother_name' => 'nullable|max:100',
			'spouse_name' => 'nullable|max:100',
			'email' => 'required|email|max:100',
			'contact_no_one' => 'required|max:20',
			'emergency_contact' => 'nullable|max:20',
			'web' => 'nullable|max:150|regex:' . $url,
			'gender' => 'required',
			'date_of_birth' => 'nullable|date',
			'present_address' => 'required|max:250',
			'permanent_address' => 'nullable|max:250',
			'home_district' => 'nullable|max:250',
			'academic_qualification' => 'nullable',
			'professional_qualification' => 'nullable',
			'experience' => 'nullable',
			'reference' => 'nullable',
			'joining_date' => 'nullable',
			'designation_id' => 'required|numeric',
			'joining_position' => 'required|numeric',
			'marital_status' => 'nullable',
			'id_name' => 'nullable',
			'id_number' => 'nullable|max:100',
			'role' => 'required',
		], [
			'designation_id.required' => 'The designation field is required.',
			'contact_no_one.required' => 'The contact no field is required.',
			'web.regex' => 'The URL format is invalid.',
			'name.regex' => 'No number is allowed.',
			'access_label' => 'The position field is required.',
		]);

		$employee->employee_id = $request->get('employee_id');
		$employee->name = $request->get('name');
		$employee->father_name = $request->get('father_name');
		$employee->mother_name = $request->get('mother_name');
		$employee->spouse_name = $request->get('spouse_name');
		$employee->email = $request->get('email');
		$employee->contact_no_one = $request->get('contact_no_one');
		$employee->emergency_contact = $request->get('emergency_contact');
		$employee->web = $request->get('web');
		$employee->gender = $request->get('gender');
		$employee->date_of_birth = $request->get('date_of_birth');
		$employee->present_address = $request->get('present_address');
		$employee->permanent_address = $request->get('permanent_address');
		$employee->home_district = $request->get('home_district');
		$employee->academic_qualification = $request->get('academic_qualification');
		$employee->professional_qualification = $request->get('professional_qualification');
		$employee->experience = $request->get('experience');
		$employee->reference = $request->get('reference');
		$employee->joining_date = $request->get('joining_date');
		$employee->designation_id = $request->get('designation_id');
		$employee->joining_position = $request->get('joining_position');
		$employee->access_label = 2;
		$employee->marital_status = $request->get('marital_status');
		$employee->id_name = $request->get('id_name');
		$employee->id_number = $request->get('id_number');
		$employee->role = $request->get('role');
		$affected_row = $employee->save();

		DB::table('role_user')
			->where('user_id', $id)
			->update(['role_id' => $request->input('role')]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Update successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$affected_row = User::where('id', $id)
			->update(['deletion_status' => 1]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Delete successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Add Master leave associated with User
	 */
	public function AddLeaveMstEmployee(Request $request){
		request()->validate([
			'emp_id' 			=> $request->get('emp_id'),
			'leave_category_id' => $request->get('leave_category_id')
		]);

		DB::table('employee_leave_msts')->insert(
			[
			'emp_id' => $request->get('emp_id'), 
			'leave_category_id' => $request->get('leave_category_id')
			]
		);
	}

	/**
	 * Add Employee Salary sheet 
	 */
	public function AddEmployeeSheet(Request $request){
		request()->validate([
			'attendence_sheet' => $request->get('attendence_sheet')
		]);
	}

	/**
	 * Add leave association with Employee
	 */
	public function leave_store(Request $request)
	{
		// Validate the request input
		$request->validate([
			'employee_lv_id' => 'required|integer',
			// Add validation for other inputs if necessary
		]);


		try {
			// Loop through leave categories submitted in the form
			foreach ($request->leave_category_id as $index => $leaveCategoryId) {
				// Insert data into employee_leave_msts table
				$inserted_id = DB::table('employee_leave_msts')->insertGetId([
					'emp_id' => $request->employee_lv_id,
					'leave_category_id' => $leaveCategoryId,
					'created_at' => now(),
					'updated_at' => now(),
				]);
			}

			// Check if data was inserted
			if (!empty($inserted_id)) {
				// Set a success message in the session
				session()->flash('submitted_form', 'add_leave_form');
				return redirect('/people/employees/manage/' . $request->employee_lv_id.'#superannuationTab')->with('message', 'Leave added successfully.');
			}

			// In case of failure
			return redirect('/people/employees/manage'. $request->employee_lv_id.'#leaveDetailsTab')->with('exception', 'Operation failed!');
		} catch (\Exception $e) {
			// Handle exceptions and errors
			return redirect('/people/employees/manage'. $request->employee_lv_id.'#leaveDetailsTab')->with('exception', 'An error occurred: ' . $e->getMessage());
		}
	}

	/**
	 * Add Employee Superannuation
	 */
	public function submitSuperannuation(Request $request)
	{
		//dd($request);
		// Validate the form inputs
		$request->validate([
			'superannuation_id' => 'required|integer',
			'employer_contribution_percentage' => 'nullable|string',
			'employer_contribution_fixed_amount' => 'nullable|string',
			'bank_name' => 'nullable|string',
			'bank_address' => 'nullable|string',
			'bank_account_number' => 'nullable|string',
			'employer_superannuation_no' => 'nullable|string',
		]);

		//Get Employer Superannuation details
	
		//echo $request->employer_superannuation_no;
		//exit;
	

		try {
			
			if(isset($request->employer_superannuation_no) && !empty($request->employer_superannuation_no)){
				$employerSuperannuation =  DB::table('companies')->where('superannuation_number', $request->employer_superannuation_no)->first();
				$superannuationDtls = DB::table('superannuations')->where('id', $employerSuperannuation->superannuation_id)->first();
			} else {
				$superannuationDtls=[];
				$employerSuperannuation=[];
			}
			
			// Insert data into the employee's superannuation table
			$inserted_id = DB::table('empl_superannuation_rels')->insert([
				'employee_id' => $request->employee_id, // Assuming you have employee_id as authenticated user
				'superannuation_id' => $request->superannuation_id,
				'employer_contribution_percentage' => $request->employer_contribution_percentage,
				'employer_contribution_fixed_amount' => $request->employer_contribution_fixed_amount,
				'bank_name' => $request->bank_name,
				'bank_address' => $request->bank_address,
				'bank_account_number' => $request->bank_account_number,
				'employer_superannuation_no' => $request->employer_superannuation_no ?? 0,
				'employer_superannuation_id' => $superannuationDtls->id ?? 0,
				'employer_superannuation_code' => $superannuationDtls->code,
				'employer_superannuation_name' => $superannuationDtls->name,
				'created_at' => now(),
				'updated_at' => now(),
			]);

			// Check if data was inserted
			if (!empty($inserted_id)) {
				// Set a success message in the session
				session()->flash('submitted_form', 'add_superannuation_form');
				return redirect('/people/employees/manage/' . $request->employee_id.'#bankCreditsTab')->with('message', 'Superannuation added successfully.');
			}

			// In case of failure
			return redirect('/people/employees/manage'. $request->employee_id .'#superannuationTab')->with('exception', 'Operation failed!');

		} catch (\Exception $e) {
			// Handle exceptions and errors
			return redirect('/people/employees/manage'. $request->employee_id .'#superannuationTab')->with('exception', 'An error occurred: ' . $e->getMessage());
		}
	}

	/**
	 * Update Employee Superannuation
	 */
	public function updateSuperannuation(Request $request, $id)
	{
		// Validate the form inputs
		$request->validate([
			'superannuation_id' => 'required|integer',
			'employer_contribution_percentage' => 'nullable|string',
			'employer_contribution_fixed_amount' => 'nullable|string',
			'bank_name' => 'nullable|string',
			'bank_address' => 'nullable|string',
			'bank_account_number' => 'nullable|string',
			'employer_superannuation_no' => 'nullable|string',
		]);

		try {
			// Retrieve superannuation details if employer_superannuation_no is provided
			$superannuationDtls = [];
			if (isset($request->employer_superannuation_no) && !empty($request->employer_superannuation_no)) {
				$employerSuperannuation = DB::table('companies')
					->where('superannuation_number', $request->employer_superannuation_no)
					->first();
				
				if ($employerSuperannuation) {
					$superannuationDtls = DB::table('superannuations')
						->where('id', $employerSuperannuation->superannuation_id)
						->first();
				}
			}

			// Update data in the employee's superannuation table
			$updated = DB::table('empl_superannuation_rels')
				->where('employee_id', $request->employee_id)
				->where('id', $id)
				->update([
					'superannuation_id' => $request->superannuation_id,
					'employer_contribution_percentage' => $request->employer_contribution_percentage,
					'employer_contribution_fixed_amount' => $request->employer_contribution_fixed_amount,
					'bank_name' => $request->bank_name,
					'bank_address' => $request->bank_address,
					'bank_account_number' => $request->bank_account_number,
					'employer_superannuation_no' => $request->employer_superannuation_no ?? 0,
					'employer_superannuation_id' => $superannuationDtls->id ?? 0,
					'employer_superannuation_code' => $superannuationDtls->code ?? null,
					'employer_superannuation_name' => $superannuationDtls->name ?? null,
					'updated_at' => now(),
				]);

			// Check if data was updated
			if ($updated) {
				// Set a success message in the session
				session()->flash('updated_form', 'update_superannuation_form');
				return redirect('/people/employees/manage/' .  $request->employee_id . '#superannuationTab')->with('message', 'Superannuation updated successfully.');
			}

			// In case no rows were updated
			return redirect('/people/employees/manage/' .  $request->employee_id . '#superannuationTab')->with('exception', 'No changes were made.');

		} catch (\Exception $e) {
			// Handle exceptions and errors
			return redirect('/people/employees/manage/' . $employee_id . '#superannuationTab')->with('exception', 'An error occurred: ' . $e->getMessage());
		}
	}


	/**
	 * Store employee bank details.
	 */
	public function bank_store(Request $request)
	{
		//dd($request);
		// Validate the request input
		$request->validate([
			'bank_id' => 'required',  // Assuming bank details are in the 'banks' table
			'swift_code' => 'required',
			'acct_no' => 'required|string|max:255',
			'acct_name' => 'required|string|max:255',
			'acct_add' => 'nullable|string|max:255',
			'acct_city' => 'nullable|string|max:255',
			'acct_email' => 'nullable|email|max:255',
			'acct_ccode' => 'nullable|string|max:3',
		]);

		try {
			
			$BankId = 0;
			$BankCode = '';
			if($request->bank_id!=0 || $request->bank_id!=''){
				$bank_detail = explode('_',$request->bank_id);
				$BankId = $bank_detail[0];
				$BankCode =  $bank_detail[1];
			}

			
			// Insert data into the employee_bank_rels table
			$inserted_id = DB::table('employee_bank_rels')->insertGetId([
				'emp_id' => $request->employee_bk_id, // Assuming the employee ID is the current authenticated user
				'bank_id' => $BankId,
				'swift_code' => $request->swift_code,
				'account_no' => $request->acct_no,
				'bank_code' => $BankCode,
				'account_holder_name' => $request->acct_name,
				'address' => $request->acct_add,
				'city' => $request->acct_city,
				'email_address' => $request->acct_email,
				'country_code' => $request->acct_ccode,
				'created_at' => now(),
				'updated_at' => now(),
			]);

			// Check if data was inserted
			if (!empty($inserted_id)) {
				// Set a success message in the session
				session()->flash('submitted_form', 'bank_store_form');
				return redirect('/people/employees')->with('message', 'Bank details added successfully.');
			}

			// In case of failure
			return redirect('/people/employees/manage/'. $request->employee_bk_id.'#bankCreditsTab')->with('exception', 'Operation failed!');
		} catch (\Exception $e) {
			// Handle exceptions and errors
			\Log::error('Bank Store Error: ' . $e->getMessage());  // Log the error for debugging
			return redirect('/people/employees/manage/'. $request->employee_bk_id.'#bankCreditsTab')->with('exception', 'An error occurred: ' . $e->getMessage());
		}
	}

	/**
	 * Update Employee Bank Details
	 */
	public function updateBankDetails(Request $request, $id)
	{
		$employee_id = $request->employee_bk_id;
		// Validate the request input
		$request->validate([
			'bank_id' => 'required',  // Assuming bank details are in the 'banks' table
			'swift_code' => 'required',
			'acct_no' => 'required|string|max:255',
			'acct_name' => 'required|string|max:255',
			'acct_add' => 'nullable|string|max:255',
			'acct_city' => 'nullable|string|max:255',
			'acct_email' => 'nullable|email|max:255',
			'acct_ccode' => 'nullable|string|max:3',
		]);

		try {
			// Extract bank details
			$BankId = 0;
			$BankCode = '';
			if (!empty($request->bank_id)) {
				$bank_detail = explode('_', $request->bank_id);
				$BankId = $bank_detail[0];
				$BankCode = $bank_detail[1] ?? '';
			}

			// Find the record to update
			$bankRecord = DB::table('employee_bank_rels')
				->where('emp_id', $employee_id)
				->where('id', $id)
				->first();

			if (!$bankRecord) {
				return redirect('/people/employees/manage/' . $employee_id . '#bankCreditsTab')
					->with('exception', 'Bank details not found.');
			}

			// Update the record
			$updated = DB::table('employee_bank_rels')
				->where('emp_id', $employee_id)
				->where('id', $id)
				->update([
					'bank_id' => $BankId,
					'swift_code' => $request->swift_code,
					'account_no' => $request->acct_no,
					'bank_code' => $BankCode,
					'account_holder_name' => $request->acct_name,
					'address' => $request->acct_add,
					'city' => $request->acct_city,
					'email_address' => $request->acct_email,
					'country_code' => $request->acct_ccode,
					'updated_at' => now(),
				]);

			if ($updated) {
				// Set a success message in the session
				session()->flash('submitted_form', 'update_bank_details_form');
				return redirect('/people/employees/manage/' . $employee_id . '#bankCreditsTab')
					->with('message', 'Bank details updated successfully.');
			}

			// In case of failure
			return redirect('/people/employees/manage/' . $employee_id . '#bankCreditsTab')
				->with('exception', 'No changes were made.');
		} catch (\Exception $e) {
			// Handle exceptions and errors
			\Log::error('Update Bank Details Error: ' . $e->getMessage()); // Log the error for debugging
			return redirect('/people/employees/manage/' . $employee_id . '#bankCreditsTab')
				->with('exception', 'An error occurred: ' . $e->getMessage());
		}
	}


}
