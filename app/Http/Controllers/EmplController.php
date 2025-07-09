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
use Illuminate\Http\Request;
use PDF;
use App\Models\WorkingDay;
use Carbon\Carbon;
Use App\Models\Superannuation;
use App\Models\BankDetail;
use App\Models\EmployeeContact;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;


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
	/**
     * Show the form for creating a new employee.
     */
    public function create(Request $request, $id = null)
    {
        // Extract employee ID from URL if present
        $reqOutput = $request->getRequestUri();
        $empl_id = preg_match('/\d+$/', $reqOutput, $matches) ? $matches[0] : 0;
		$employee_id = $id;

        // Fetch necessary data
        $leaveCategories = LeaveCategory::where('publication_status', 1)->get();
        $designations = Designation::where('deletion_status', 0)
            ->where('publication_status', 1)
            ->orderBy('designation', 'ASC')
            ->select('id', 'designation')
            ->get()
            ->toArray();
        $superannuations = DB::table('superannuations')
            ->leftJoin('bank_list', 'bank_list.id', 'superannuations.bank_name')
            ->leftJoin('bank_details', 'bank_details.bank_type', 'bank_list.id')
            ->select('superannuations.*', 'bank_list.bank_name', 'bank_list.bank_code', 'bank_details.bank_detail_code', 'bank_details.bsb_number', 'bank_details.bank_address', 'bank_details.bank_phone', 'bank_details.employment_account_number')
            ->get();
        $bankDetails = BankDetail::all();
        $bankLists = DB::table('bank_list')->get();
        $roles = Role::all();
        $loca_places = HraAreaPlace::query()
            ->orderBy('loca_name', 'ASC')
            ->orderBy('places', 'ASC')
            ->get(['id', 'loca_name', 'places'])
            ->toArray();
        $employees = User::query()
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->orderBy('users.name', 'ASC')
            ->where('users.access_label', '>=', 2)
            ->where('users.access_label', '<=', 3)
            ->get(['designations.designation', 'users.name', 'users.id'])
            ->toArray();
        $sumOfWorkingHours = WorkingDay::sum('working_hours');
        $companies = DB::table('companies')
            ->leftJoin('superannuations', 'superannuations.id', '=', 'companies.superannuation_id')
            ->select('companies.*', 'superannuations.code', 'superannuations.name')
            ->get();
        $costcenters = DB::table('cost_centers')->get();

		//$data = Session::get('employee_data.costcenter');

		//dd($data);

        return view('administrator.people.employee.add_employee', compact(
            'designations', 'roles', 'loca_places', 'employees', 'leaveCategories',
            'sumOfWorkingHours', 'superannuations', 'bankDetails', 'bankLists',
            'companies', 'empl_id', 'costcenters', 'employee_id'
        ));
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
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|max:250',
            'name' => 'required|max:100',
            'father_name' => 'nullable|max:100',
            'mother_name' => 'nullable|max:100',
            'spouse_name' => 'nullable|max:100',
            'gender' => 'required|in:m,f',
            'marital_status' => 'nullable|in:1,2,3,4,5',
            'date_of_birth' => 'nullable|date_format:d/m/Y',
            'designation_id' => 'required|numeric',
            'joining_date' => 'nullable|date_format:d/m/Y',
            'end_date' => 'nullable|date_format:d/m/Y', // Added for completeness
            'branch' => 'required|numeric',
            'role' => 'required',
            'employee_type' => 'required|in:1,2,3,4,5',
            'resident_status' => 'required|in:1,2',
            'academic_qualification' => 'nullable',
            'professional_qualification' => 'nullable',
            'experience' => 'nullable',
            'web' => 'nullable|max:150|regex:' . $url,
            'present_address' => 'required|max:250',
            'city_pr' => 'nullable|max:100',
            'state_pr' => 'nullable|max:100',
            'postcode_pr' => 'nullable|max:20',
            'country_pr' => 'nullable|max:100',
            'permanent_address' => 'nullable|max:250',
            'city' => 'nullable|max:100',
            'state' => 'nullable|max:100',
            'postcode' => 'nullable|max:20',
            'country' => 'nullable|max:100',
            'email' => 'required|email|max:100', // Removed unique:users for now
            'contact_no_one' => 'required|max:20',
            'emergency_contact' => 'nullable|max:20',
            'passport_number' => 'nullable|max:50', // Added for completeness
            'visa_number' => 'nullable|max:50',     // Added for completeness
        ], [
            'designation_id.required' => 'The designation field is required.',
            'contact_no_one.required' => 'The contact no field is required.',
            'web.regex' => 'The URL format is invalid.',
            'branch.required' => 'The branch field is required.',
            'date_of_birth.date_format' => 'The date of birth must be in DD/MM/YYYY format.',
            'joining_date.date_format' => 'The joining date must be in DD/MM/YYYY format.',
            'end_date.date_format' => 'The end date must be in DD/MM/YYYY format.',
        ]);

        // If validation fails, return JSON response for AJAX
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get validated data
        $employee = $validator->validated();

        // Convert dates to Y-m-d format for session storage
        if (!empty($employee['date_of_birth'])) {
            try {
                $employee['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $employee['date_of_birth'])->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'errors' => ['date_of_birth' => ['Invalid date of birth format. Please use DD/MM/YYYY.']],
                ], 422);
            }
        }

        if (!empty($employee['joining_date'])) {
            try {
                $employee['joining_date'] = Carbon::createFromFormat('d/m/Y', $employee['joining_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'errors' => ['joining_date' => ['Invalid joining date format. Please use DD/MM/YYYY.']],
                ], 422);
            }
        }

        if (!empty($employee['end_date'])) {
            try {
                $employee['end_date'] = Carbon::createFromFormat('d/m/Y', $employee['end_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'errors' => ['end_date' => ['Invalid end date format. Please use DD/MM/YYYY.']],
                ], 422);
            }
        }

        // Store data in session
        session()->put('employee_data.personal', $employee);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Personal details saved successfully.',
        ]);
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
	 public function payroll_store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'tax_residency' => 'required|in:1,2', // Changed from resident_status to match form
            'basic_salary' => 'required|numeric|min:0',
            'house_rent_allowance' => 'nullable|numeric|min:0',
            'medical_allowance' => 'nullable|numeric|min:0',
            'special_allowance' => 'nullable|numeric|min:0',
            'provident_fund_contribution' => 'nullable|numeric|min:0',
            'other_allowance' => 'nullable|numeric|min:0',
            'provident_fund_deduction' => 'nullable|numeric|min:0',
            'other_deduction' => 'nullable|numeric|min:0',
            'no_of_dependent' => 'nullable|integer|min:0',
            'hrly_salary_rate' => 'required|numeric|min:0', // Made required to match form
            'overtime_hr' => 'nullable|numeric|min:0',
            'overtime_rate' => 'nullable|numeric|min:0',
            'overtime_amt' => 'nullable|numeric|min:0',
            'sales_comm' => 'nullable|numeric|min:0',
            'electricity_allowance' => 'nullable|numeric|min:0',
            'security_allowance' => 'nullable|numeric|min:0',
            'tax_deduction_a' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'tax_deduction_b' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'hr_place' => 'required|numeric',
            'hr_area' => 'required', // Changed to numeric to match form behavior
            'hra_type' => 'required|in:1,2,3',
            'hra_amount_per_week' => 'nullable|numeric|min:0',
            'va_type' => 'required|in:1,2,3',
            'vehicle_allowance' => 'nullable|numeric|min:0',
            'meals_tag' => 'nullable|in:1', // Changed to match checkbox value
            'meals_allowance' => 'nullable|numeric|min:0',
            'annual_salary' => 'required|numeric|min:0',
            'superannuation_id' => 'required|numeric', // Added to match form
            'employer_contribution_percentage' => 'nullable|numeric|min:0',
        ], [
            'tax_residency.required' => 'The tax residency field is required.',
            'employee_type.required' => 'The employee type field is required.',
            'basic_salary.required' => 'The basic salary field is required.',
            'hr_place.required' => 'The HR place field is required.',
            'hr_area.required' => 'The HR area field is required.',
            'hra_type.required' => 'The housing allowance type field is required.',
            'va_type.required' => 'The vehicle allowance type field is required.',
            'annual_salary.required' => 'The annual salary field is required.',
            'hrly_salary_rate.required' => 'The hourly salary rate field is required.',
            'superannuation_id.required' => 'The superannuation field is required.',
            'tax_deduction_a.regex' => 'The tax deduction A must have up to two decimal places.',
            'tax_deduction_b.regex' => 'The tax deduction B must have up to two decimal places.',
        ]);

        // If validation fails, return JSON response for AJAX
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get validated data
        $salary = $validator->validated();

        // Store data in session
        session()->put('employee_data.payroll', $salary);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Payroll details saved successfully.',
        ]);
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
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'step' => 'required|in:leave',
            'leave_category_id' => 'required|array',
            'leave_category_id.*' => 'required|integer|exists:leave_categories,id',
            'leave_balance' => 'required|array',
            'leave_balance.*' => 'required|numeric|min:0',
            'leave_type' => 'required|array',
            'leave_type.*' => 'required|string|max:255',
            'leave_active' => 'array',
            'leave_active.*' => 'nullable|integer|exists:leave_categories,id',
        ], [
            'leave_category_id.required' => 'At least one leave category is required.',
            'leave_category_id.*.exists' => 'Invalid leave category selected.',
            'leave_balance.*.required' => 'Leave balance is required for all categories.',
            'leave_balance.*.numeric' => 'Leave balance must be a number.',
            'leave_balance.*.min' => 'Leave balance cannot be negative.',
            'leave_type.*.required' => 'Leave type is required for all categories.',
            'leave_type.*.string' => 'Leave type must be a string.',
            'leave_type.*.max' => 'Leave type cannot exceed 255 characters.',
            'leave_active.*.exists' => 'Invalid active leave category selected.',
        ]);

        // If validation fails, return JSON response for AJAX
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Prepare leave data for session storage
        $leaveData = [];
        foreach ($request->leave_category_id as $index => $leaveCategoryId) {
            $leaveData[$leaveCategoryId] = [
                'leave_category_id' => $leaveCategoryId,
                'leave_balance' => $request->leave_balance[$index],
                'leave_type' => $request->leave_type[$index],
                'leave_active' => in_array($leaveCategoryId, $request->leave_active ?? []) ? 1 : 0,
            ];
        }

        // Store in session
        session()->put('employee_data.leave', $leaveData);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Leave details saved successfully.',
        ]);
    }

	/**
	 * Add Employee Superannuation
	 */
	public function submitSuperannuation(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'step' => 'required|in:superannuation',
            'superannuation_id' => 'required|integer|exists:superannuations,id',
            'employer_contribution_percentage' => 'nullable|numeric|min:0',
            'employer_contribution_fixed_amount' => 'nullable|numeric|min:0',
            'bank_name' => 'nullable|string|max:255',
            'bank_address' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'employer_superannuation_no' => 'nullable|string|max:255',
        ], [
            'superannuation_id.required' => 'Superannuation selection is required.',
            'superannuation_id.exists' => 'Invalid superannuation selected.',
            'employer_contribution_percentage.numeric' => 'Employer contribution percentage must be a number.',
            'employer_contribution_percentage.min' => 'Employer contribution percentage cannot be negative.',
            'employer_contribution_fixed_amount.numeric' => 'Employer fixed contribution must be a number.',
            'employer_contribution_fixed_amount.min' => 'Employer fixed contribution cannot be negative.',
            'bank_name.max' => 'Bank name cannot exceed 255 characters.',
            'bank_address.max' => 'Bank address cannot exceed 255 characters.',
            'bank_account_number.max' => 'Bank account number cannot exceed 255 characters.',
            'employer_superannuation_no.max' => 'Employer superannuation number cannot exceed 255 characters.',
        ]);

        // If validation fails, return JSON response for AJAX
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Prepare superannuation data
        $superannuationData = $validator->validated();

        // Fetch additional details for employer_superannuation_no
        if ($request->employer_superannuation_no) {
            $employerSuperannuation = DB::table('companies')->where('superannuation_number', $request->employer_superannuation_no)->first();
            $superannuationDtls = $employerSuperannuation ? DB::table('superannuations')->where('id', $employerSuperannuation->superannuation_id)->first() : null;
            $superannuationData['employer_superannuation_id'] = $superannuationDtls->id ?? 0;
            $superannuationData['employer_superannuation_code'] = $superannuationDtls->code ?? '';
            $superannuationData['employer_superannuation_name'] = $superannuationDtls->name ?? '';
        } else {
            $superannuationData['employer_superannuation_id'] = 0;
            $superannuationData['employer_superannuation_code'] = '';
            $superannuationData['employer_superannuation_name'] = '';
        }

        // Store in session
        session()->put('employee_data.superannuation', $superannuationData);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Superannuation details saved successfully.',
        ]);
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
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'step' => 'required|in:bank',
            'bank_id' => 'required|string',
            'swift_code' => 'required|string|max:255',
            'acct_no' => 'required|string|max:255',
            'acct_name' => 'required|string|max:255',
            'acct_add' => 'nullable|string|max:255',
            'acct_city' => 'nullable|string|max:255',
            'acct_email' => 'nullable|email|max:255',
            'acct_ccode' => 'nullable|string|max:3',
        ], [
            'bank_id.required' => 'Bank selection is required.',
            'swift_code.required' => 'Swift code is required.',
            'swift_code.max' => 'Swift code cannot exceed 255 characters.',
            'acct_no.required' => 'Account number is required.',
            'acct_no.max' => 'Account number cannot exceed 255 characters.',
            'acct_name.required' => 'Account name is required.',
            'acct_name.max' => 'Account name cannot exceed 255 characters.',
            'acct_add.max' => 'Address cannot exceed 255 characters.',
            'acct_city.max' => 'City cannot exceed 255 characters.',
            'acct_email.email' => 'Email must be a valid email address.',
            'acct_email.max' => 'Email cannot exceed 255 characters.',
            'acct_ccode.max' => 'Country code cannot exceed 3 characters.',
        ]);

        // If validation fails, return JSON response for AJAX
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Parse bank_id
        $bankParts = explode('_', $request->bank_id);
        $bankId = $bankParts[0] ?? 0;
        $bankCode = $bankParts[1] ?? '';

        // Prepare bank data
        $bankData = $validator->validated();
        $bankData['bank_id'] = $bankId;
        $bankData['bank_code'] = $bankCode;

        // Store in session
        session()->put('employee_data.bank', $bankData);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Bank details saved successfully.',
            'redirect' => url('/people/employees'),
        ]);
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

	/**
	 * Get Departments
	 */
	public function getDepartments(Request $request)
    {
        $query = Department::active()->select('id', 'department');

        // Filter by cost_center_id if provided (placeholder for future relationship)
        if ($request->has('cost_center_id')) {
            // Add relationship logic if cost_centers and departments are linked
            // Example: $query->whereHas('costCenters', fn($q) => $q->where('cost_center_id', $request->cost_center_id));
        }

        // Filter by specific IDs if provided
        if ($request->has('ids')) {
            $ids = is_array($request->ids) ? $request->ids : explode(',', $request->ids);
            $query->whereIn('id', $ids);
        }

        $departments = $query->get()->map(fn($dept) => [
            'id' => $dept->id,
            'department' => $dept->department, // Match table column
        ]);

        // Return format compatible with old code
        return response()->json([
            'departments' => $departments,
            'sharePercentages' => session('employee_data.costcenter.cost_center_share_percentage', []),
        ]);
    }

	/**
     * Cost Center
     */
    public function cost_store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'payroll_location' => 'required|numeric',
            'pay_batch_number' => 'required|numeric',
            'cost_center' => 'required|numeric',
            'department' => 'required|array|min:1',
            'department.*' => 'numeric',
            'cost_center_share_percentage' => 'required|array|min:1',
            'cost_center_share_percentage.*' => 'required|numeric|min:0|max:100',
        ], [
            'payroll_location.required' => 'The payroll location field is required.',
            'pay_batch_number.required' => 'The pay batch number field is required.',
            'cost_center.required' => 'The cost center field is required.',
            'department.required' => 'At least one department must be selected.',
            'department.*.numeric' => 'Each department must be a valid ID.',
            'cost_center_share_percentage.required' => 'At least one cost center share percentage is required.',
            'cost_center_share_percentage.*.required' => 'Each cost center share percentage is required.',
            'cost_center_share_percentage.*.numeric' => 'Each cost center share percentage must be a number.',
            'cost_center_share_percentage.*.min' => 'Each cost center share percentage must be at least 0.',
            'cost_center_share_percentage.*.max' => 'Each cost center share percentage cannot exceed 100.',
        ]);

        // // Custom validation to ensure sum of percentages equals 100
        // $validator->after(function ($validator) use ($request) {
        //     $percentages = $request->input('cost_center_share_percentage', []);
        //     $total = array_sum($percentages);
        //     if (abs($total - 100) > 0.01) {
        //         $validator->errors()->add(
        //             'cost_center_share_percentage',
        //             'The sum of cost center share percentages must equal 100%.'
        //         );
        //     }

        //     // Ensure department IDs match percentage keys
        //     $departments = $request->input('department', []);
        //     $percentageKeys = array_keys($percentages);
        //     if (array_diff($percentageKeys, $departments) || array_diff($departments, $percentageKeys)) {
        //         $validator->errors()->add(
        //             'cost_center_share_percentage',
        //             'Each selected department must have a corresponding share percentage, and vice versa.'
        //         );
        //     }
        // });

        // If validation fails, return JSON response for AJAX
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get validated data
        $costData = $validator->validated();

        // Store data in session
        session()->put('employee_data.costcenter', $costData);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Cost center details saved successfully.',
        ]);
    }

	/**
	 * Employee Contacts
	 */

    public function employeeContactsAdd(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'step' => 'required|in:contact',
            'employee_contact_name' => 'required|string|max:255',
            'employee_contact_address' => 'required|string|max:255',
            'employee_contact_phone' => 'required|string|max:15',
            'employee_contact_mobile' => 'required|string|max:15',
            'employee_contact_email' => 'required|email|max:255',
            'employee_contact_relationship' => 'required|string|max:100',
        ], [
            'employee_contact_name.required' => 'The contact name is required.',
            'employee_contact_name.string' => 'The contact name must be a string.',
            'employee_contact_name.max' => 'The contact name cannot exceed 255 characters.',
            'employee_contact_address.required' => 'The contact address is required.',
            'employee_contact_address.string' => 'The contact address must be a string.',
            'employee_contact_address.max' => 'The contact address cannot exceed 255 characters.',
            'employee_contact_phone.required' => 'The contact phone number is required.',
            'employee_contact_phone.string' => 'The contact phone number must be a string.',
            'employee_contact_phone.max' => 'The contact phone number cannot exceed 15 characters.',
            'employee_contact_mobile.required' => 'The contact mobile number is required.',
            'employee_contact_mobile.string' => 'The contact mobile number must be a string.',
            'employee_contact_mobile.max' => 'The contact mobile number cannot exceed 15 characters.',
            'employee_contact_email.required' => 'The contact email is required.',
            'employee_contact_email.email' => 'The contact email must be a valid email address.',
            'employee_contact_email.max' => 'The contact email cannot exceed 255 characters.',
            'employee_contact_relationship.required' => 'The contact relationship is required.',
            'employee_contact_relationship.string' => 'The contact relationship must be a string.',
            'employee_contact_relationship.max' => 'The contact relationship cannot exceed 100 characters.',
        ]);

        // If validation fails, return JSON response for AJAX
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get validated data
        $contactData = $validator->validated();

        // Store data in session
        session()->put('employee_data.contact', $contactData);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Contact details saved successfully.',
        ]);
    }
}
