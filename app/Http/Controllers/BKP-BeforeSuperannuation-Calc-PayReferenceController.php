<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PayslipsExport;
use App\Models\PayReference;
use App\Models\Branch;
use App\Models\PayBatchNumber;
use App\Models\Department;
use App\Models\PayLocation;
use App\Models\PayReferenceDepartmentRel;
use App\Models\PayReferencePayLocationRel;
use App\Models\PayReferenceEmplRelation;
use App\Models\PeriodDefinationRate;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\EmployeeBankRel;
use App\Models\Users;
use App\Models\Bank;
use App\Models\PayReferencePayItem;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Helpers\TaxCalculationHelper;

class PayReferenceController extends Controller
{
    protected $workingHours;

    public function __construct()
    {
        $this->workingHours = config('constants.WORKING_HOURS');
    }
    /**
     * Display a listing of the pay references.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pay_references = PayReference::join('branches', 'pay_references.branch_id', '=', 'branches.id')
            ->leftJoin('pay_batch_numbers', 'pay_references.payroll_number', '=', 'pay_batch_numbers.id')
            ->select('pay_references.*', 'branches.branch_name as branch_name', 'pay_batch_numbers.pay_batch_number_name as payroll_number')
            ->get();

        return view('administrator.hrm.pay_references.index', compact('pay_references'));
    }

    /**
     * Payref Status Enquiry
     */
    public function payrefStatusEnquiry(Request $request){
        $pay_references = PayReference::join('branches', 'pay_references.branch_id', '=', 'branches.id')
        ->leftJoin('pay_batch_numbers', 'pay_references.payroll_number', '=', 'pay_batch_numbers.id')
        ->select('pay_references.*', 'branches.branch_name as branch_name', 'pay_batch_numbers.pay_batch_number_name as payroll_number')
        ->get();

        return view('administrator.hrm.pay_references.payref_status_enquiry', compact('pay_references'));
    }
    
    /**
     * Show the form for creating a new pay reference.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $pay_batch_numbers = PayBatchNumber::all();
        $departments = Department::all();
        $pay_locations = PayLocation::all();

        return view('administrator.hrm.pay_references.create', compact('branches', 'pay_batch_numbers', 'departments', 'pay_locations'));
    }

    /**
     * Store a newly created pay reference in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'pay_reference_name' => 'required|string|max:255',
            'pay_period_start_date' => 'required|date',
            'pay_period_end_date' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'payroll_number_id' => 'required|exists:pay_batch_numbers,id',
        ]);

        // Create the pay reference
        $pay_reference = PayReference::create([
            'pay_reference_name' => $request->pay_reference_name,
            'pay_period_start_date' => Carbon::parse($request->pay_period_start_date)->format('Y-m-d'),
            'pay_period_end_date' => Carbon::parse($request->pay_period_end_date)->format('Y-m-d'),
            'branch_id' => $request->branch_id,
            'payroll_number' => $request->payroll_number_id,
        ]);

        // Attach departments
        if ($request->has('departments')) {
            foreach ($request->departments as $department_id) {
                PayReferenceDepartmentRel::create([
                    'pay_reference_id' => $pay_reference->id,
                    'pay_reference_department_id' => $department_id,
                ]);
            }
        }

        // Attach pay locations
        if ($request->has('pay_locations')) {
            foreach ($request->pay_locations as $pay_location_id) {
                PayReferencePayLocationRel::create([
                    'pay_reference_id' => $pay_reference->id,
                    'pay_reference_pay_location_id' => $pay_location_id,
                ]);
            }
        }

        return redirect()->route('pay_references.index')->with('success', 'Pay Reference created successfully.');
    }

    /**
     * Display the specified pay reference.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get pay reference details
        //$pay_reference = DB::table('pay_references')->find($id);
        $pay_reference = DB::table('pay_references')
        ->join('branches', 'pay_references.branch_id', '=', 'branches.id')
        ->join('pay_batch_numbers', 'pay_references.payroll_number', '=', 'pay_batch_numbers.id')
        ->where('pay_references.id', $id)
        ->select('pay_references.*', 'branches.branch_name', 'pay_batch_numbers.pay_batch_number_name')
        ->first();

        // Get department, branch, and location IDs related to this pay reference
        $departmentIds = DB::table('pay_reference_department_rels')
            ->where('pay_reference_id', $pay_reference->id)
            ->pluck('pay_reference_department_id');

        $branchIds = DB::table('pay_references')
            ->where('id', $pay_reference->id)
            ->pluck('branch_id');

        $locationIds = DB::table('pay_reference_pay_location_rels')
            ->where('pay_reference_id', $pay_reference->id)
            ->pluck('pay_reference_pay_location_id');

        // Fetch included employees
        //Check Pay Reference ID exist
        $includedEmpByPayRef = PayReferenceEmplRelation::where('pay_reference_id', $pay_reference->id)
        ->pluck('emp_id');
        if($includedEmpByPayRef){
            $includedEmployees = DB::table('users')
            ->join('employee_relations', 'users.id', '=', 'employee_relations.emp_id')
            ->whereIn('employee_relations.department_id', $departmentIds)
            ->whereIn('employee_relations.branch_id', $branchIds)
            ->whereIn('employee_relations.payroll_location_id', $locationIds)
            ->where('employee_relations.payroll_batch_id', $pay_reference->payroll_number)
            ->whereIn('users.id', $includedEmpByPayRef)
            ->select('users.id', 'users.employee_id', 'users.name')
            ->get(); // Execute the query to get actual results
        } else {
            $includedEmployees = DB::table('users')
            ->join('employee_relations', 'users.id', '=', 'employee_relations.emp_id')
            ->whereIn('employee_relations.department_id', $departmentIds)
            ->whereIn('employee_relations.branch_id', $branchIds)
            ->whereIn('employee_relations.payroll_location_id', $locationIds)
            ->where('employee_relations.payroll_batch_id', $pay_reference->payroll_number)
            ->select('users.id', 'users.employee_id', 'users.name')
            ->get(); // Execute the query to get actual results
        }


        // Debug output for department, branch, location, and payroll number
        // echo 'Department Ids: ';
        // print_r($departmentIds->toArray());
        // echo 'Branch Ids: ';
        // print_r($branchIds->toArray());
        // echo 'Location Ids: ';
        // print_r($locationIds->toArray());
        // echo 'Payroll Number: ';
        // echo $pay_reference->payroll_number;
        // echo '<br>';

    

        // Fetch excluded employees (those not in the included list)
        $excludedEmployeeIds = $includedEmployees->pluck('id')->toArray();
        $excludedEmployees = DB::table('users')
        ->join('employee_relations', 'users.id', '=', 'employee_relations.emp_id')
            ->whereNotIn('users.id', $excludedEmployeeIds)
            ->whereIn('employee_relations.department_id', $departmentIds)
            ->whereIn('employee_relations.branch_id', $branchIds)
            ->whereIn('employee_relations.payroll_location_id', $locationIds)
            ->where('employee_relations.payroll_batch_id', $pay_reference->payroll_number)
            ->select('users.id', 'users.employee_id', 'users.name')
            ->get();
        // $excludedEmployees = [];

        //Check Leave Button Add Employee Exist
        $addLeaveButtonExist = $this->getLeaveDetailsByPayReference($pay_reference->id) ? $this->getLeaveDetailsByPayReference($pay_reference->id) : false;

        $payrefPayslipExist = DB::table('pay_reference_pay_slips')->where('pay_ref_id',$pay_reference->id)->first();

        //Add Pay Items
        $payItems =  DB::table('pay_items')->get();

        // Pass both included and excluded employees to the view
        return view('administrator.hrm.pay_references.show', compact('pay_reference', 'includedEmployees', 'excludedEmployees', 'addLeaveButtonExist', 'payrefPayslipExist',  'payItems'));
    }




    // public function show($id)
    // {
    //     $pay_references = PayReference::join('branches', 'pay_references.branch_id', '=', 'branches.id')
    //     ->leftJoin('pay_batch_numbers', 'pay_references.payroll_number', '=', 'pay_batch_numbers.id')
    //     ->where('pay_references.id', $id)
    //     ->select('pay_references.*', 'branches.branch_name as branch_name', 'pay_batch_numbers.pay_batch_number_name as payroll_number')
    //     ->get();
    //     return view('administrator.hrm.pay_references.show', compact('pay_references'));
    // }

    /**
     * Show the form for editing the specified pay reference.
     *
     * @param  \App\Models\PayReference  $payReference
     * @return \Illuminate\Http\Response
     */
    public function edit(PayReference $payReference)
    {
        $branches = Branch::all();
        $pay_batch_numbers = PayBatchNumber::all();
        $departments = Department::all();
        $pay_locations = PayLocation::all();

        $selected_departments = $payReference->departments()->pluck('id')->toArray();
        $selected_pay_locations = $payReference->payLocations()->pluck('id')->toArray();

        $payrefPayslipExist = DB::table('pay_reference_pay_slips')->where('pay_ref_id',$payReference->id)->first();

        return view('administrator.hrm.pay_references.show', compact('payReference', 'branches', 'pay_batch_numbers', 'departments', 'pay_locations', 'selected_departments', 'selected_pay_locations', 'payrefPayslipExist'));
    }

    /**
     * Update the specified pay reference in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PayReference  $payReference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayReference $payReference)
    {
        // Validate the request data
        $request->validate([
            'pay_reference_name' => 'required|string|max:255',
            'pay_period_start_date' => 'required|date',
            'pay_period_end_date' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'payroll_number_id' => 'required|exists:pay_batch_numbers,id',
        ]);

        // Update the pay reference
        $payReference->update([
            'pay_reference_name' => $request->pay_reference_name,
            'pay_period_start_date' => $request->pay_period_start_date,
            'pay_period_end_date' => $request->pay_period_end_date,
            'branch_id' => $request->branch_id,
            'payroll_number' => $request->payroll_number_id,
        ]);

        // Update departments
        $payReference->departments()->sync($request->departments);

        // Update pay locations
        $payReference->payLocations()->sync($request->pay_locations);

        return redirect()->route('pay_references.index')->with('success', 'Pay Reference updated successfully.');
    }

    /**
     * Remove the specified pay reference from storage.
     *
     * @param  \App\Models\PayReference  $payReference
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayReference $payReference)
    {
        $payReference->departments()->detach();
        $payReference->payLocations()->detach();
        $payReference->delete();

        return redirect()->route('pay_references.index')->with('success', 'Pay Reference deleted successfully.');
    }

    /**
     * Pay Reference Employee Included
     */
    public function savePayReferenceEmployees(Request $request)
    {
        $pay_reference_id = $request->pay_reference_id;
        $employees = $request->employees;

        $employees_exclude = $request->employees_exclude;

        //Check exclude employees exist
        if($employees_exclude){
            //Delete exclude Employees
            foreach ($employees_exclude as $emp_exclude_id) {
                //Delete
                PayReferenceEmplRelation::where('pay_reference_id', $pay_reference_id)
                ->where('emp_id', $emp_exclude_id)
                ->delete();
            }
        }

        foreach ($employees as $emp_id) {
            // Check if the record already exists
            $existing = PayReferenceEmplRelation::where('pay_reference_id', $pay_reference_id)
                ->where('emp_id', $emp_id)
                ->first();

            // If no record exists, insert new one
            if (!$existing) {
                PayReferenceEmplRelation::create([
                    'pay_reference_id' => $pay_reference_id,
                    'emp_id' => $emp_id
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Employees saved successfully.']);
    }

    /**
     * Get Leave Details Pay Reference
     */
    public function getLeaveDetailsByPayReference($payReferenceId )
    {
        // Step 1: Fetch pay reference details
        $payReference = DB::table('pay_references')->where('id', $payReferenceId)->first();



        // Step 2: Get all employee IDs associated with the pay_reference_id
        $employeeIds = DB::table('pay_reference_empl_relations')
                        ->where('pay_reference_id', $payReferenceId)
                        ->pluck('emp_id');

        // Initialize leave summary array
        $leaveSummary = [];

        // Step 3: Iterate over employee IDs and calculate leave details
        foreach ($employeeIds as $employeeId) {

            // Step 6: Check if this employee record already exists in pay_reference_update_leaves
            $exists = DB::table('pay_reference_update_leaves')
                        ->where('pay_reference_id', $payReferenceId)
                        ->where('employee_id', $employeeId)
                        ->exists();

            // Step 7: Insert into pay_reference_update_leaves if not already exists
            if ($exists) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Add Leave Details Pay Reference
     */
    public function addLoanDetailsByPayReference(Request $request)
    {
        $payReferenceId = $request->pay_reference_id;
        if (!$payReferenceId) {
            return response()->json(['error' => 'Pay Reference ID not found'], 404);
        }

        // Step 1: Fetch pay reference details
        $payReference = DB::table('pay_references')->where('id', $payReferenceId)->first();

        if (!$payReference) {
            return response()->json(['error' => 'Pay Reference not found'], 404);
        }

        // Step 2: Get all employee IDs associated with the pay_reference_id
        $employeeIds = DB::table('pay_reference_empl_relations')
                        ->where('pay_reference_id', $payReferenceId)
                        ->pluck('emp_id');


        // Step 3: Iterate over employee IDs and calculate leave details
        foreach ($employeeIds as $employeeId) {
            // Fetch all leave records within the pay period date range for the employee
            $loans = DB::table('loans')
                        ->where('user_id', $employeeId)
                        ->whereBetween('deduction_start_date', [$payReference->pay_period_start_date, $payReference->pay_period_end_date])
                        ->where('loan_status', 1) // Loan status must equal 1
                        ->get();
            foreach ($loans as $loan) {
                // Handle null or missing fields
                $loan_id = $loan->id ?? 0;
                $loan_name = $loan->loan_name ?? null;
                $loan_master_id = $loan->loan_master_id ?? 0;
                $loan_date = $loan->loan_date ?? null;  // Set null if loan_date is not available
                $deduction_start_date = $loan->deduction_start_date ?? null;  // Set null if deduction_start_date is not available
                $deduction_amount = $loan->deduction_amount ?? 0;
                $outstanding_amount = $loan->outstanding_amount ?? 0;

                // // Step 4: Store loan summary for this employee
                // $loanSummary[] = [
                //     'loan_id'               => $loan_id,
                //     'user_id'               => $employeeId,
                //     'loan_name'             => $loan_name,
                //     'loan_master_id'        => $loan_master_id,
                //     'loan_date'             => $loan_date,
                //     'deduction_start_date'  => $deduction_start_date,
                //     'deduction_amount'      => $deduction_amount,
                //     'outstanding_amount'    => $outstanding_amount,
                // ];

                // Step 5: Check if this employee record already exists in pay_reference_update_loans
                $exists = DB::table('pay_reference_update_loans')
                            ->where('pay_reference_id', $payReferenceId)
                            ->where('user_id', $employeeId)
                            ->exists();

                // Step 6: Insert into pay_reference_update_loans if not already exists
                if (!$exists) {
                    DB::table('pay_reference_update_loans')->insert([
                        'pay_reference_id'      => $payReferenceId,
                        'loan_id'               => $loan_id,
                        'user_id'               => $employeeId,
                        'loan_name'             => $loan_name,
                        'loan_master_id'        => $loan_master_id,
                        'loan_date'             => $loan_date,  // Ensure valid or null date
                        'deduction_start_date'  => $deduction_start_date,  // Ensure valid or null date
                        'deduction_amount'      => $deduction_amount,
                        'outstanding_amount'    => $outstanding_amount,
                        'created_at'            => now(),
                        'updated_at'            => now(),
                    ]);
                }
            }
        }

        return response()->json(['success' => 'Loans details processed successfully']);
    }

     /**
     * Add Leave Details Pay Reference
     */
    public function addLeaveDetailsByPayReference(Request $request)
    {
        $payReferenceId = $request->pay_reference_id;
        if (!$payReferenceId) {
            return response()->json(['error' => 'Pay Reference ID not found'], 404);
        }
        // Step 1: Fetch pay reference details
        $payReference = DB::table('pay_references')->where('id', $payReferenceId)->first();

        if (!$payReference) {
            return response()->json(['error' => 'Pay Reference not found'], 404);
        }

        // Step 2: Get all employee IDs associated with the pay_reference_id
        $employeeIds = DB::table('pay_reference_empl_relations')
                        ->where('pay_reference_id', $payReferenceId)
                        ->pluck('emp_id');

        // Initialize leave summary array
        $leaveSummary = [];

        // Step 3: Iterate over employee IDs and calculate leave details
        foreach ($employeeIds as $employeeId) {
            // Fetch all leave records within the pay period date range for the employee
            $leaves = DB::table('leave_managements')
                        ->where('user_id', $employeeId)
                        ->where(function ($query) use ($payReference) {
                            $query->whereBetween('start_date', [$payReference->pay_period_start_date, $payReference->pay_period_end_date])
                                ->orWhereBetween('end_date', [$payReference->pay_period_start_date, $payReference->pay_period_end_date]);
                        })
                        ->where('status', '!=', 3) // Status not equal to 3 (disapproved)
                        ->get();

            // Step 4: Calculate leave metrics for each employee
            $totalLossOfPayDays = 0;
            $totalSandwichLeaveDays = 0;
            $totalHolidayCount = 0;
            $totalLeaveAppliedDays = 0;
            $totalPendingLeave = 0;
            $totalLeaveCancelDays = 0;
            $totalLeaveDisapproveDays = 0;

            foreach ($leaves as $leave) {
                $totalLossOfPayDays += $leave->loss_of_pay_days;
                $totalSandwichLeaveDays += $leave->sandwich_leave_days ?? 0;
                $totalHolidayCount += $leave->holiday_count ?? 0;
                $totalLeaveAppliedDays += $leave->leave_applied_days ?? 0;
                $totalPendingLeave += $leave->pending_leave ?? 0;
                $totalLeaveCancelDays += $leave->leave_cancel_days ?? 0;
                $totalLeaveDisapproveDays += $leave->leave_disapprove_days ?? 0;
            }

            // Step 5: Store the leave summary for this employee
            $leaveSummary[] = [
                'employee_id'            => $employeeId,
                'total_loss_of_pay_days'  => $totalLossOfPayDays,
                'total_sandwich_leave'    => count($leaves->where('is_sandwich_leave', 'true')),
                'total_sandwich_leave_days' => $totalSandwichLeaveDays,
                'total_holiday_count'     => $totalHolidayCount,
                'total_leave_applied_days' => $totalLeaveAppliedDays,
                'total_pending_leave'     => $totalPendingLeave,
                'total_leave_cancel_days' => $totalLeaveCancelDays,
                'total_leave_disapprove_days' => $totalLeaveDisapproveDays,
            ];

            // Step 6: Check if this employee record already exists in pay_reference_update_leaves
            $exists = DB::table('pay_reference_update_leaves')
                        ->where('pay_reference_id', $payReferenceId)
                        ->where('employee_id', $employeeId)
                        ->exists();

            // Step 7: Insert into pay_reference_update_leaves if not already exists
            if (!$exists) {
                DB::table('pay_reference_update_leaves')->insert([
                    'pay_reference_id'        => $payReferenceId,
                    'employee_id'             => $employeeId,
                    'total_loss_of_pay_days'  => $totalLossOfPayDays,
                    'total_sandwich_leave'    => count($leaves->where('is_sandwich_leave', 'true')),
                    'total_sandwich_leave_days' => $totalSandwichLeaveDays,
                    'total_holiday_count'     => $totalHolidayCount,
                    'total_leave_applied_days' => $totalLeaveAppliedDays,
                    'total_pending_leave'     => $totalPendingLeave,
                    'total_leave_cancel_days' => $totalLeaveCancelDays,
                    'total_leave_disapprove_days' => $totalLeaveDisapproveDays,
                    'created_at'              => now(),
                    'updated_at'              => now(),
                ]);
            }
        }

        return response()->json(['success' => 'Leave details processed successfully', 'data' => $leaveSummary]);
    }

    /** 
     * Generate PaySlip
    */
    // public function showPaymentSlip($employee_id, $pay_ref_id)
    // {
    //     // Get pay period based on pay_ref_id from pay_references table
    //     $payReference = DB::table('pay_references')
    //         ->where('id', $pay_ref_id)
    //         ->first(['pay_period_start_date', 'pay_period_end_date']);

    //     if (!$payReference) {
    //         return back()->with('error', 'Pay reference not found.');
    //     }

    //     // Get attendance data for the given employee and pay period
    //     $attendanceData = DB::table('attendance_reports')
    //         ->where('employee_id', $employee_id)
    //         ->whereBetween('attendance_date', [$payReference->pay_period_start_date, $payReference->pay_period_end_date])
    //         ->get();

    //     // Check if attendance data exists
    //     if ($attendanceData->isEmpty()) {
    //         return back()->with('error', 'No attendance data found for this period.');
    //     }

    //     // Calculate Total Working Hours (sum of paid_hours)
    //     $totalWorkingHours = $attendanceData->filter(function ($row) {
    //         return !is_null($row->paid_hours) && $row->paid_hours != '0';
    //     })->sum(function ($row) {
    //         $hours = explode(':', $row->paid_hours);
    //         $hours[1] = $hours[1] ?? 0; // Set minutes to 0 if it doesn't exist
    //         return (float) $hours[0] + ($hours[1] / 60); // Convert minutes to a fraction of an hour
    //     });
        
    //     // Calculate Late Days and Deductions
    //     $lateDays = $attendanceData->filter(function ($row) {
    //         return $row->late && $row->late != '00:00:00';
    //     })->count();

    //     $lateDeductionDays = intdiv($lateDays, 3); // 3 late days = 1 deduction day

    //     //dd($lateDeductionDays);

    //     // Calculate Sandwich Days
    //     $sandwichDays = 0;
    //     foreach ($attendanceData as $index => $row) {
    //         if ($row->absence_type == 'sandwich_leave') {
    //             $sandwichDays++;
    //         }
    //     }

    //     // Calculate Unpaid Leave Days
    //     $unpaidLeaveDays=0;
    //     foreach ($attendanceData as $index => $row) {
    //         if ($row->leave_status !== null && $row->leave_status == 0) {
    //             if($row->working_day_name != 'Sat' || $row->working_day_name != 'Sun'){
    //                 $unpaidLeaveDays++;
    //             }
    //         }
    //     }

    //     // $unpaidLeaveDays = $attendanceData->filter(function ($row) {
    //     //     return $row->leave_status == 0 && $row->leave_status != null;
    //     // })->count();

    //     //dd($unpaidLeaveDays);
    //     // Get hourly salary rate from payrolls table for this employee
    //     $payroll = DB::table('payrolls')->where('user_id', $employee_id)->first(['hrly_salary_rate']);
    //     if (!$payroll) {
    //         return back()->with('error', 'Payroll data not found for this employee.');
    //     }
    //     $hourlyRate = $payroll->hrly_salary_rate;

    //     // Calculate Deductions
    //     $lateDeduction = $lateDeductionDays * 9 * $hourlyRate;
    //     $sandwichLeaveDeduction = $sandwichDays * 9 * $hourlyRate;
    //     $unpaidLeaveDeduction = $unpaidLeaveDays * 9 * $hourlyRate;

    //     // Gross total payable after deductions
    //     $totalPayable = ($totalWorkingHours * $hourlyRate) - ($lateDeduction + $sandwichLeaveDeduction + $unpaidLeaveDeduction);

    //     $employee_name =  $attendanceData->first()->employee_name;
    //     $pay_period_start = $payReference->pay_period_start_date;
    //     $pay_period_end =  $payReference->pay_period_end_date;

        
    //     /**
    //      * -----------------------------
    //      */
    //     /** Other Vlues selected */
    //     $pay_reference = DB::table('pay_references')
    //     ->join('branches', 'pay_references.branch_id', '=', 'branches.id')
    //     ->join('pay_batch_numbers', 'pay_references.payroll_number', '=', 'pay_batch_numbers.id')
    //     ->where('pay_references.id', $pay_ref_id)
    //     ->select('pay_references.*', 'branches.branch_name', 'pay_batch_numbers.pay_batch_number_name')
    //     ->first();

    //     // Get department, branch, and location IDs related to this pay reference
    //     $departmentIds = DB::table('pay_reference_department_rels')
    //         ->where('pay_reference_id', $pay_reference->id)
    //         ->pluck('pay_reference_department_id');

    //     $branchIds = DB::table('pay_references')
    //         ->where('id', $pay_reference->id)
    //         ->pluck('branch_id');

    //     $locationIds = DB::table('pay_reference_pay_location_rels')
    //         ->where('pay_reference_id', $pay_reference->id)
    //         ->pluck('pay_reference_pay_location_id');

    //     // Fetch included employees
    //     //Check Pay Reference ID exist
    //     $includedEmpByPayRef = PayReferenceEmplRelation::where('pay_reference_id', $pay_reference->id)
    //     ->pluck('emp_id');
    //     if($includedEmpByPayRef){
    //         $includedEmployees = DB::table('users')
    //         ->join('employee_relations', 'users.id', '=', 'employee_relations.emp_id')
    //         ->whereIn('employee_relations.department_id', $departmentIds)
    //         ->whereIn('employee_relations.branch_id', $branchIds)
    //         ->whereIn('employee_relations.payroll_location_id', $locationIds)
    //         ->where('employee_relations.payroll_batch_id', $pay_reference->payroll_number)
    //         ->whereIn('users.id', $includedEmpByPayRef)
    //         ->select('users.id', 'users.employee_id', 'users.name')
    //         ->get(); // Execute the query to get actual results
    //     } else {
    //         $includedEmployees = DB::table('users')
    //         ->join('employee_relations', 'users.id', '=', 'employee_relations.emp_id')
    //         ->whereIn('employee_relations.department_id', $departmentIds)
    //         ->whereIn('employee_relations.branch_id', $branchIds)
    //         ->whereIn('employee_relations.payroll_location_id', $locationIds)
    //         ->where('employee_relations.payroll_batch_id', $pay_reference->payroll_number)
    //         ->select('users.id', 'users.employee_id', 'users.name')
    //         ->get(); // Execute the query to get actual results
    //     }

    //     // Fetch excluded employees (those not in the included list)
    //     $excludedEmployeeIds = $includedEmployees->pluck('id')->toArray();
    //     $excludedEmployees = DB::table('users')
    //     ->join('employee_relations', 'users.id', '=', 'employee_relations.emp_id')
    //         ->whereNotIn('users.id', $excludedEmployeeIds)
    //         ->whereIn('employee_relations.department_id', $departmentIds)
    //         ->whereIn('employee_relations.branch_id', $branchIds)
    //         ->whereIn('employee_relations.payroll_location_id', $locationIds)
    //         ->where('employee_relations.payroll_batch_id', $pay_reference->payroll_number)
    //         ->select('users.id', 'users.employee_id', 'users.name')
    //         ->get();
    //     // $excludedEmployees = [];

    //     //Check Leave Button Add Employee Exist
    //     $addLeaveButtonExist = $this->getLeaveDetailsByPayReference($pay_reference->id) ? $this->getLeaveDetailsByPayReference($pay_reference->id) : false;


    //     // Return the data to the view
    //     return view('administrator.hrm.pay_references.show', compact(
    //         'pay_reference', 
    //         'includedEmployees', 
    //         'excludedEmployees', 
    //         'addLeaveButtonExist',
    //         'employee_id',
    //         'employee_name',
    //         'pay_period_start',
    //         'pay_period_end',
    //         'totalWorkingHours',
    //         'lateDeduction',
    //         'sandwichLeaveDeduction',
    //         'unpaidLeaveDeduction',
    //         'hourlyRate',
    //         'totalPayable',
    //     ));
    // }

    public function showPaymentSlip(Request $request, $employee_id, $pay_ref_id)
    {
        // Get pay period based on pay_ref_id from pay_references table
        $payReference = DB::table('pay_references')
            ->where('id', $pay_ref_id)
            ->first(['pay_period_start_date', 'pay_period_end_date']);

        if (!$payReference) {
            // Handle for both AJAX and non-AJAX requests
            if ($request->ajax()) {
                return response()->json(['error' => 'Pay reference not found.'], 404);
            }
            return back()->with('error', 'Pay reference not found.');
        }

        // Get attendance data for the given employee and pay period
        $attendanceData = DB::table('attendance_reports')
            ->where('employee_id', $employee_id)
            ->whereBetween('attendance_date', [$payReference->pay_period_start_date, $payReference->pay_period_end_date])
            ->get();

        // Check if attendance data exists
        if ($attendanceData->isEmpty()) {
            if ($request->ajax()) {
                return response()->json(['error' => 'No attendance data found for this period.'], 404);
            }
            return back()->with('error', 'No attendance data found for this period.');
        }
        // Calculate Total Working Hours (sum of paid_hours)
        $totalWorkingHours = $attendanceData->filter(function ($row) {
            return !is_null($row->paid_hours) && $row->paid_hours != '0' && $row->absence == '0';
        })->sum(function ($row) {
            $hours = explode(':', $row->paid_hours);
            $hours[1] = $hours[1] ?? 0; // Set minutes to 0 if it doesn't exist
            return (float) $hours[0] + ($hours[1] / 60); // Convert minutes to a fraction of an hour
        });

        // Calculate whole hours and total minutes
        $wholeHours = floor($totalWorkingHours); // Get the whole hours part
        $totalMinutes = round(($totalWorkingHours - $wholeHours) * 60); // Get the total minutes part

        // Format total hours and minutes as H:MM
        $totalHoursFormatted = sprintf('%d:%02d', $wholeHours, $totalMinutes);
        // Now you can use $totalDecimalHours for display or further processing

        


        // Calculate Late Days and Deductions
        $lateDays = $attendanceData->filter(function ($row) {
            return $row->late && $row->late != '00:00:00';
        })->count();

        $lateDeductionDays = intdiv($lateDays, 3); // 3 late days = 1 deduction day

        // Calculate Sandwich Days
        $sandwichDays = $attendanceData->filter(function ($row) {
            return $row->absence_type == 'sandwich_leave';
        })->count();

        // Calculate Unpaid Leave Days
        $unpaidLeaveDays = $attendanceData->filter(function ($row) {
            return $row->leave_status === 0 && !in_array($row->working_day_name, ['Sat', 'Sun']);
        })->count();

        // Get hourly salary rate from payrolls table for this employee
        $payroll = DB::table('payrolls')->where('user_id', $employee_id)->first();
        if (!$payroll) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Payroll data not found for this employee.'], 404);
            }
            return back()->with('error', 'Payroll data not found for this employee.');
        }
        $hourlyRate = $payroll->hrly_salary_rate;

          //Get all Allowances from Payroll
          $house_rent_allowance = $payroll->house_rent_allowance;
          $medical_allowance = $payroll->medical_allowance;
          $special_allowance = $payroll->special_allowance;
          $other_allowance = $payroll->other_allowance;
          $electricity_allowance = $payroll->electricity_allowance;
          $security_allowance = $payroll->security_allowance;
          $tax_deduction_a = $payroll->tax_deduction_a;
          $hra_type = $payroll->hra_type;
          $va_type = $payroll->va_type;
          $vechile_allowance = $payroll->vehicle_allowance;
          $meal_tag = $payroll->meals_tag;
          $meals_allowance = $payroll->meals_allowance;
  
          //Get Vechile Allowance on base of working days
          if($vechile_allowance!=0){ 
              $oneDayVechileAllowance = $vechile_allowance/14;
              $hourlyVechileAllowance = $oneDayVechileAllowance/24;
              $totalVechileAllowance = $totalWorkingHours * $hourlyVechileAllowance;
  
          } else {
              $totalVechileAllowance = 0;
          }
          //Total Benefits
          $totalBenefits = $house_rent_allowance+$medical_allowance+$special_allowance+$other_allowance+$electricity_allowance+$security_allowance+$totalVechileAllowance+$meals_allowance;
  
          //Total Tax Deduction Amount
        //   if($tax_deduction_a!=0){
        //       $oneDayTaxDeductionAmt = $tax_deduction_a/14;
        //       $hourlyTaxDeductionAmt = $oneDayTaxDeductionAmt/24;
        //       $totalCalculatedTax = $totalWorkingHours * $hourlyTaxDeductionAmt;
        //   } else {
        //       $totalCalculatedTax = 0;
        //   }
        

        // Calculate Deductions
        $lateDeduction = $lateDeductionDays * $this->workingHours * $hourlyRate;
        $sandwichLeaveDeduction = $sandwichDays * $this->workingHours * $hourlyRate;
        $unpaidLeaveDeduction = $unpaidLeaveDays * $this->workingHours * $hourlyRate;

        // Gross total payable after deductions
        $totalPayable = ($totalWorkingHours * $hourlyRate) - ($lateDeduction + $sandwichLeaveDeduction + $unpaidLeaveDeduction);

        // Get employee and pay period details
        $employee_name = $attendanceData->first()->employee_name;
        $pay_period_start = $payReference->pay_period_start_date;
        $pay_period_end = $payReference->pay_period_end_date;

        // Get Loan Taken By Employee
        $loans = DB::table('pay_reference_update_loans')
        ->where('pay_reference_id', $pay_ref_id)
        ->where('user_id', $employee_id,)
        ->get();

        //By Deductioin Installment
        $loan_deduction_installment = 0;
        //Check if not empty
        if($loans){
            foreach($loans as $loan){
                $loan_deduction_installment += $loan->deduction_amount;
            }
        }

        //Get PayItems Paid
        $payItems = DB::table('pay_reference_payitems')
        ->leftJoin('pay_items', 'pay_items.id', '=', 'pay_reference_payitems.pay_item_id')
        ->select('pay_reference_payitems.*', 'pay_items.code', 'pay_items.name')
        ->where('pay_reference_id', $pay_ref_id)
        ->where('empid', $employee_id)
        ->get();
    
        // if($payItems){
        //     // Calculate total pay item amounts
        //     $totalPayable += $payItems->sum('payitem_amount');
        // }
        //Rounded hours

        // Step 1: Split the string into hours and minutes
        list($hours, $minutes) = explode(':', $totalHoursFormatted);

        // Step 2: Convert hours and minutes to total hours (as a decimal)
        $totalHoursAsDecimal = $hours + ($minutes / 60);

        // Step 3: Divide total hours by the number of working hours in a day (e.g., 9)
        $days = $totalHoursAsDecimal / $this->workingHours; // Assuming a 9-hour workday

        // Step 4: Round the result to 2 decimal places
        $daysRounded = round($days);


        // Step 5: Calculate the total salary
        $totalSalary = $totalHoursAsDecimal * $hourlyRate;

        // Step 6: Format the result to 2 decimal places
        $totalSalaryFormatted = number_format($totalSalary, 2);

        /**
         * Calculate Total Payable
         */
        $allDeduction = round($lateDeduction+$sandwichLeaveDeduction+$unpaidLeaveDeduction, 2);
        // Step 7: Calculate the total payable amount
        // echo '1- '.$totalSalary."<br/>";
        // echo '2- '.$totalBenefits."<br/>";
        // echo '3- '.$loan_deduction_installment."<br/>";
        // echo '4- '.$totalCalculatedTax."<br/>";
        // echo '5- '.$allDeduction;
        // exit;
        //All type of Deduction

       // Assuming $employee_id and $totalSalary are defined somewhere above this code
       $empDetails = DB::table('users')->where('id', $employee_id)->first();

       $dependents = 0; // Initialize variable
       $residentialStatus = null; // Initialize variable
   
       if ($empDetails) {
           $dependents = $empDetails->no_of_dependent;
           $residentialStatus = $empDetails->resident_status;
       }
   
       $totalCalculatedTax = 0; // Add missing semicolon
       
       $rentamt = $house_rent_allowance;
        
       $grossSalary = $totalSalary + $totalBenefits; 
       $taxAmount = TaxCalculationHelper::calculateTax($grossSalary, $dependents, $residentialStatus);
   
       if ($taxAmount) {
           $totalCalculatedTax = $taxAmount;
       }
   

        $totalPayable = round((($totalSalary + $totalBenefits) - $allDeduction) - $totalCalculatedTax, 2);


        // Prepare data for the payslip view
        $payslipData = compact(
            'employee_id',
            'employee_name',
            'pay_period_start',
            'pay_period_end',
            'totalWorkingHours',
            'totalHoursFormatted',
            'daysRounded',
            'lateDeduction',
            'sandwichLeaveDeduction',
            'unpaidLeaveDeduction',
            'hourlyRate',
            'grossSalary',
            'totalSalaryFormatted',
            'house_rent_allowance',
            'medical_allowance',
            'special_allowance',
            'other_allowance',
            'electricity_allowance',
            'security_allowance',
            'totalVechileAllowance',
            'meals_allowance',
            'totalBenefits',
            'taxAmount',
            'totalCalculatedTax',
            'loan_deduction_installment',
            'payItems',
            'totalPayable'
        );

        // Handle AJAX request or return normal view
        if ($request->ajax()) {
            // Render only the partial payslip view for AJAX requests
            return view('administrator.hrm.pay_references.payslip', $payslipData);
        } else {
            // Render the full view for non-AJAX requests, which includes the payslip partial view
            return view('administrator.hrm.pay_references.show', $payslipData);
        }
    }
/**
     * Submit Pay of Pay Reference
     */
    public function submitPayRef(Request $request, $pay_reference_id)
    {
        // Fetch employees related to the pay reference
        $payRefByEmployees = DB::table('pay_reference_empl_relations')
            ->where('pay_reference_id', $pay_reference_id)
            ->get();

        // Initialize an array to hold payslips
        $payrefEmplPayslips = [];

        if ($payRefByEmployees->isNotEmpty()) {
            foreach ($payRefByEmployees as $payRefByEmployee) {
                // Get the payslip data for each employee
                $payrefEmplPayslip = $this->getPaymentSlip($payRefByEmployee->emp_id, $pay_reference_id);

                // Check for duplicate pay reference and employee ID before inserting
                $existingRecord = DB::table('pay_reference_pay_slips')
                    ->where('pay_ref_id', $pay_reference_id)
                    ->where('employee_id', $payRefByEmployee->emp_id)
                    ->first();

                if (!$existingRecord) {
                    // Insert the payslip data if no existing record found
                    DB::table('pay_reference_pay_slips')->insert([
                        'pay_ref_id' => $pay_reference_id,
                        'employee_id' => $payRefByEmployee->emp_id,
                        'hourly_rate' => $payrefEmplPayslip['hourlyRate'],
                        'total_working_hours' => round($payrefEmplPayslip['totalWorkingHours'], 2),
                        'total_working_days' => $payrefEmplPayslip['totalWorkingDays'] ?? 0,
                        'late_count' => $payrefEmplPayslip['lateCount'] ?? 0,
                        'late_deduction' => round($payrefEmplPayslip['lateDeduction'], 2),
                        'sandwich_leave_count' => $payrefEmplPayslip['sandwichLeaveCount'] ?? 0,
                        'sandwich_leave_deduction' => $payrefEmplPayslip['sandwichLeaveDeduction'],
                        'loss_of_pay_days' => $payrefEmplPayslip['lossOfPayDays'] ?? 0,
                        'loss_of_pay_amount' => $payrefEmplPayslip['lossOfPayAmount'] ?? 0,
                        'house_rent_allowance' => $payrefEmplPayslip['house_rent_allowance'] ?? 0,
                        'medical_allowance' => $payrefEmplPayslip['medical_allowance'] ?? 0,
                        'special_allowance'=> $payrefEmplPayslip['special_allowance'] ?? 0,
                        'other_allowance'=> $payrefEmplPayslip['other_allowance'] ?? 0,
                        'electricity_allowance' => $payrefEmplPayslip['electricity_allowance'] ?? 0,
                        'security_allowance' => $payrefEmplPayslip['security_allowance'] ?? 0,
                        'tax_deduction_a' => $payrefEmplPayslip['tax_deduction_a'] ?? 0,
                        'hra_type' => $payrefEmplPayslip['hra_type'] ?? 0,
                        'va_type' => $payrefEmplPayslip['va_type'] ?? 0,
                        'vehicle_allowance' => $payrefEmplPayslip['vehicle_allowance'] ?? 0,
                        'meal_tag' => $payrefEmplPayslip['meal_tag'] ?? 0,
                        'meals_allowance' => $payrefEmplPayslip['meals_allowance'] ?? 0,
                        'total_benefits_payable' => $payrefEmplPayslip['total_benefits_payable'] ?? 0,
                        'total_taxable_deduct_wdays' =>  $payrefEmplPayslip['total_taxable_deduct_wdays'] ?? 0,
                        'loan_deduction_installment' =>  $payrefEmplPayslip['loan_deduction_installment'] ?? 0,
                        'payItems' => $payrefEmplPayslip['payItems'],
                        'total_payable_amount' => round($payrefEmplPayslip['totalPayable'], 2),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    DB::table('pay_reference_pay_slips')
                    ->where('pay_ref_id', $pay_reference_id)
                    ->where('employee_id', $payRefByEmployee->emp_id)
                    ->delete();

                    // Insert the payslip data if no existing record found
                    DB::table('pay_reference_pay_slips')->insert([
                        'pay_ref_id' => $pay_reference_id,
                        'employee_id' => $payRefByEmployee->emp_id,
                        'hourly_rate' => $payrefEmplPayslip['hourlyRate'],
                        'total_working_hours' => round($payrefEmplPayslip['totalWorkingHours'], 2),
                        'total_working_days' => $payrefEmplPayslip['totalWorkingDays'] ?? 0,
                        'late_count' => $payrefEmplPayslip['lateCount'] ?? 0,
                        'late_deduction' => round($payrefEmplPayslip['lateDeduction'], 2),
                        'sandwich_leave_count' => $payrefEmplPayslip['sandwichLeaveCount'] ?? 0,
                        'sandwich_leave_deduction' => $payrefEmplPayslip['sandwichLeaveDeduction'],
                        'loss_of_pay_days' => $payrefEmplPayslip['lossOfPayDays'] ?? 0,
                        'loss_of_pay_amount' => $payrefEmplPayslip['lossOfPayAmount'] ?? 0,
                        'house_rent_allowance' => $payrefEmplPayslip['house_rent_allowance'] ?? 0,
                        'medical_allowance' => $payrefEmplPayslip['medical_allowance'] ?? 0,
                        'special_allowance'=> $payrefEmplPayslip['special_allowance'] ?? 0,
                        'other_allowance'=> $payrefEmplPayslip['other_allowance'] ?? 0,
                        'electricity_allowance' => $payrefEmplPayslip['electricity_allowance'] ?? 0,
                        'security_allowance' => $payrefEmplPayslip['security_allowance'] ?? 0,
                        'tax_deduction_a' => $payrefEmplPayslip['tax_deduction_a'] ?? 0,
                        'hra_type' => $payrefEmplPayslip['hra_type'] ?? 0,
                        'va_type' => $payrefEmplPayslip['va_type'] ?? 0,
                        'vehicle_allowance' => $payrefEmplPayslip['vehicle_allowance'] ?? 0,
                        'meal_tag' => $payrefEmplPayslip['meal_tag'] ?? 0,
                        'meals_allowance' => $payrefEmplPayslip['meals_allowance'] ?? 0,
                        'total_benefits_payable' => $payrefEmplPayslip['total_benefits_payable'] ?? 0,
                        'total_taxable_deduct_wdays' =>  $payrefEmplPayslip['total_taxable_deduct_wdays'] ?? 0,
                        'loan_deduction_installment' =>  $payrefEmplPayslip['loan_deduction_installment'] ?? 0,
                        'payItems' => $payrefEmplPayslip['payItems'],
                        'total_payable_amount' => round($payrefEmplPayslip['totalPayable'], 2),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Redirect or return success message here
        return back()->with('success', 'Pay slips submitted successfully.');
    }

    private function getPaymentSlip($employee_id, $pay_ref_id)
    {
        echo 'payrefid'.$pay_ref_id;
        // Get pay period based on pay_ref_id from pay_references table
        $payReference = DB::table('pay_references')
            ->where('id', $pay_ref_id)
            ->first(['pay_period_start_date', 'pay_period_end_date']);

        if (!$payReference) {
            return [
                'error' => 'Pay reference not found.'
            ];
        }

        // Get attendance data for the given employee and pay period
        $attendanceData = DB::table('attendance_reports')
            ->where('employee_id', $employee_id)
            ->whereBetween('attendance_date', [$payReference->pay_period_start_date, $payReference->pay_period_end_date])
            ->get();

        // Check if attendance data exists
        if ($attendanceData->isEmpty()) {
            return [
                'error' => 'No attendance data found for this period.'
            ];
        }

        // Calculate Total Working Hours (sum of paid_hours)
        $totalWorkingHours = $attendanceData->filter(function ($row) {
            return !is_null($row->paid_hours) && $row->paid_hours != '0' && $row->absence == '0';
        })->sum(function ($row) {
            $hours = explode(':', $row->paid_hours);
            $hours[1] = $hours[1] ?? 0; // Set minutes to 0 if it doesn't exist
            return (float)$hours[0] + ($hours[1] / 60); // Convert minutes to a fraction of an hour
        });

        // Calculate Late Days and Deductions
        $lateDays = $attendanceData->filter(function ($row) {
            return $row->late && $row->late != '00:00:00';
        })->count();

        $lateDeductionDays = intdiv($lateDays, 3); // 3 late days = 1 deduction day

        // Calculate Sandwich Days
        $sandwichDays = $attendanceData->filter(function ($row) {
            return $row->absence_type == 'sandwich_leave';
        })->count();

        // Calculate Unpaid Leave Days
        $unpaidLeaveDays = $attendanceData->filter(function ($row) {
            return $row->leave_status === 0 && !in_array($row->working_day_name, ['Sat', 'Sun']);
        })->count();

        // Get hourly salary rate from payrolls table for this employee
        $payroll = DB::table('payrolls')->where('user_id', $employee_id)->first();
        if (!$payroll) {
            return [
                'error' => 'Payroll data not found for this employee.'
            ];
        }
        $hourlyRate = $payroll->hrly_salary_rate;
        //Get all Allowances from Payroll
        $house_rent_allowance = $payroll->house_rent_allowance;
        $medical_allowance = $payroll->medical_allowance;
        $special_allowance = $payroll->special_allowance;
        $other_allowance = $payroll->other_allowance;
        $electricity_allowance = $payroll->electricity_allowance;
        $security_allowance = $payroll->security_allowance;
        $tax_deduction_a = $payroll->tax_deduction_a;
        $hra_type = $payroll->hra_type;
        $va_type = $payroll->va_type;
        $vechile_allowance = $payroll->vehicle_allowance;
        $meal_tag = $payroll->meals_tag;
        $meals_allowance = $payroll->meals_allowance;

        //Get Vechile Allowance on base of working days
        if($vechile_allowance!=0){ 
            $oneDayVechileAllowance = $vechile_allowance/14;
            $hourlyVechileAllowance = $oneDayVechileAllowance/24;
            $totalVechileAllowance = $totalWorkingHours * $hourlyVechileAllowance;

        } else {
            $totalVechileAllowance = 0;
        }
        //Total Benefits
        $totalBenefits = $house_rent_allowance+$medical_allowance+$special_allowance+$other_allowance+$electricity_allowance+$security_allowance+$totalVechileAllowance+$meals_allowance;

        //Total Tax Deduction Amount
        if($tax_deduction_a!=0){
            $oneDayTaxDeductionAmt = $tax_deduction_a/14;
            $hourlyTaxDeductionAmt = $oneDayTaxDeductionAmt/24;
            $totalCalculatedTax = $totalWorkingHours * $hourlyTaxDeductionAmt;
        } else {
            $totalCalculatedTax = 0;
        }

        // Calculate Deductions
        $lateDeduction = $lateDeductionDays * $this->workingHours * $hourlyRate;
        $sandwichLeaveDeduction = $sandwichDays * $this->workingHours * $hourlyRate;
        $unpaidLeaveDeduction = $unpaidLeaveDays * $this->workingHours * $hourlyRate;

        // Gross total payable after deductions
        $totalPayable = ($totalWorkingHours * $hourlyRate) - ($lateDeduction + $sandwichLeaveDeduction + $unpaidLeaveDeduction);

        // Get employee and pay period details
        $employee_name = $attendanceData->first()->employee_name;
        $pay_period_start = $payReference->pay_period_start_date;
        $pay_period_end = $payReference->pay_period_end_date;
        

         // Get Loan Taken By Employee $employee_id, $pay_ref_id
         $loans = DB::table('pay_reference_update_loans')
         ->where('pay_reference_id', $pay_ref_id)
         ->where('user_id', $employee_id,)
         ->get();
    

 
         //By Deductioin Installment
         $loan_deduction_installment = 0;
         //Check if not empty
         if($loans){
             foreach($loans as $loan){
                 $loan_deduction_installment += $loan->deduction_amount;
             }
         }

          //Get PayItems Paid
        $payItems = DB::table('pay_reference_payitems')
        ->leftJoin('pay_items', 'pay_items.id', '=', 'pay_reference_payitems.pay_item_id')
        ->select('pay_reference_payitems.*', 'pay_items.code', 'pay_items.name')
        ->where('pay_reference_id', $pay_ref_id)
        ->where('empid', $employee_id)
        ->get();
    
        if($payItems){
            // Calculate total pay item amounts
            $totalPayable += $payItems->sum('payitem_amount');
        }

        // Prepare data for the payslip view
        return [
            'employee_id' => $employee_id,
            'employee_name' => $employee_name,
            'pay_period_start' => $pay_period_start,
            'pay_period_end' => $pay_period_end,
            'totalWorkingHours' => $totalWorkingHours,
            'lateCount' => $lateDeductionDays,
            'lateDeduction' => $lateDeduction,
            'sandwichLeaveCount' => $sandwichDays,
            'sandwichLeaveDeduction' => $sandwichLeaveDeduction,
            'lossOfPayDays' => $unpaidLeaveDays,
            'lossOfPayAmount' => $unpaidLeaveDeduction,
            'hourlyRate' => $hourlyRate,
            'house_rent_allowance' => $house_rent_allowance,
            'medical_allowance' => $medical_allowance,
            'special_allowance'=> $special_allowance,
            'other_allowance'=> $other_allowance,
            'electricity_allowance' => $electricity_allowance,
            'security_allowance' => $security_allowance,
            'tax_deduction_a' => $tax_deduction_a,
            'hra_type' => $hra_type,
            'va_type' => $va_type,
            'vehicle_allowance' => $vechile_allowance,
            'meal_tag' => $meal_tag,
            'meals_allowance' => $meals_allowance,
            'total_benefits_payable' => $totalBenefits,
            'total_taxable_deduct_wdays' =>  $totalCalculatedTax,
            'loan_deduction_installment' => $loan_deduction_installment,
            'payItems' => json_encode($payItems),
            'totalPayable' => $totalPayable,
        ];
    }

    /**
     * PaySlip Generation
     */
    public function viewpaySlipsByPayRef(Request $request){
        $pay_references = PayReference::join('branches', 'pay_references.branch_id', '=', 'branches.id')
        ->leftJoin('pay_batch_numbers', 'pay_references.payroll_number', '=', 'pay_batch_numbers.id')
        ->select('pay_references.*', 'branches.branch_name as branch_name', 'pay_batch_numbers.pay_batch_number_name as payroll_number')
        ->get();

        return view('administrator.hrm.pay_references.payslip-ref', compact('pay_references'));
    }

    /**
     * PaySlip Generation
     */
    public function viewAllpaySlipsByPayRef($pay_reference_id)
    {
        // Fetch the pay reference details with related branch and batch number
        $pay_reference = PayReference::join('branches', 'pay_references.branch_id', '=', 'branches.id')
            ->leftJoin('pay_batch_numbers', 'pay_references.payroll_number', '=', 'pay_batch_numbers.id')
            ->select('pay_references.*', 'branches.branch_name as branch_name', 'pay_batch_numbers.pay_batch_number_name as payroll_number')
            ->where('pay_references.id', $pay_reference_id)
            ->first();  // First as you're fetching a single record by ID

        // Fetch employees related to the pay reference
        $payRefByEmployees = DB::table('pay_reference_empl_relations')
            ->where('pay_reference_id', $pay_reference_id)
            ->get();

        // Initialize an array to hold payslips
        $payrefEmplPayslips = [];

        if ($payRefByEmployees->isNotEmpty()) {
            foreach ($payRefByEmployees as $payRefByEmployee) {
                // Get the payslip data for each employee
                $payrefEmplPayslip = $this->getPaymentSlip($payRefByEmployee->emp_id, $pay_reference_id);
                // Add each payslip to the array
                $payrefEmplPayslips[] = $payrefEmplPayslip;
            }
        }

        return view('administrator.hrm.pay_references.allpayslips', compact('pay_reference', 'payrefEmplPayslips'));
    }

    /**
     * Export Payslips for a given Pay Reference ID to Excel.
     */
    public function exportPayslips($pay_reference_id)
    {
      
        // Fetch the payslip data based on the pay_reference_id
        $payReference = PayReference::findOrFail($pay_reference_id);



        // Fetch employee payslips for this pay reference
        $payRefByEmployees = PayReferenceEmplRelation::where('pay_reference_id', $pay_reference_id)->get();

        if ($payRefByEmployees->isEmpty()) {
            return redirect()->back()->with('error', 'No employees found for this Pay Reference.');
        }

        // Collect the payslip data
        $payslipData = [];

        $month = date('F', strtotime($payReference->pay_period_start_date)); // Get month from Pay Period Start

        // Fetch the pay reference data
        $payReference = PayReference::where('pay_period_start_date', $payReference->pay_period_start_date)
            ->where('pay_period_end_date', $payReference->pay_period_end_date)
            ->where('id', $pay_reference_id)
            ->first();

        if (!$payReference) {
            return redirect()->back()->with('error', 'Pay Reference not found.');
        }

        // Fetch employee payslips for this pay reference
        $payRefByEmployees = PayReferenceEmplRelation::where('pay_reference_id', $payReference->id)
            ->leftJoin('users', 'pay_reference_empl_relations.emp_id', '=', 'users.id')
            ->leftJoin('employee_bank_rels', 'users.id', '=', 'employee_bank_rels.emp_id')
            ->leftJoin('bank_list', 'employee_bank_rels.bank_id', '=', 'bank_list.id')
            ->get([
                'pay_reference_empl_relations.*',
                'users.id as emp_id',
                'users.name as employee_name',
                'employee_bank_rels.account_no',
                'employee_bank_rels.bank_code',
                'employee_bank_rels.ifsc_code',
                'employee_bank_rels.swift_code',
                'employee_bank_rels.account_holder_name',
                'employee_bank_rels.address',
                'employee_bank_rels.city',
                'employee_bank_rels.state',
                'employee_bank_rels.branch_name',
                'employee_bank_rels.email_address',
                'employee_bank_rels.country_code',
                'bank_list.bank_name as bank_name'
            ]);

        if ($payRefByEmployees->isEmpty()) {
            return redirect()->back()->with('error', 'No employees found for this Pay Reference.');
        }


        foreach ($payRefByEmployees as $employeeRel) {

            // Use the getPaymentSlip function to retrieve the necessary employee payslip data
            $payslip = $this->getPaymentSlip($employeeRel->emp_id, $payReference->id);
        
       
            // Skip if any error occurred while fetching payslip data
            if (isset($payslip['error'])) {
                continue;
            }

              //Get PayItems Paid
                $payItems = DB::table('pay_reference_payitems')
                ->leftJoin('pay_items', 'pay_items.id', '=', 'pay_reference_payitems.pay_item_id')
                ->select('pay_reference_payitems.*', 'pay_items.code', 'pay_items.name')
                ->where('pay_reference_id', $payReference->id)
                ->where('empid', $employeeRel->emp_id)
                ->get();
            
                if($payItems){
                    // Calculate total pay item amounts
                    $payslip['totalPayable'] += $payItems->sum('payitem_amount');
                }


            // Append each payslip to the export data array
            $payslipData[] = [
                'Employee ID' => $payslip['employee_id'],
                'Employee Name' => $payslip['employee_name'],
                'Pay Period Start' => $payslip['pay_period_start'],
                'Pay Period End' => $payslip['pay_period_end'],
                'Total Working Hours' => round($payslip['totalWorkingHours'], 2),
                'Total Payable (before deductions)' => round($payslip['totalWorkingHours'] * $payslip['hourlyRate'], 2),
                'Total Benefits' => round($payslip['total_benefits_payable'], 2),
                'Late Deduction' => $payslip['lateDeduction'],
                'Sandwich Leave Deduction' => $payslip['sandwichLeaveDeduction'],
                'Unpaid Leave Deduction' => round($payslip['lossOfPayAmount'], 2),
                'IRC Tax Deduction' => round($payslip['total_taxable_deduct_wdays'], 2),
                'Loan Installment' => round($payslip['loan_deduction_installment'], 2),
                'Total Payable (after deductions)' => round((($payslip['totalPayable'] + $payslip['total_benefits_payable'])-$payslip['loan_deduction_installment']) - $payslip['total_taxable_deduct_wdays'], 2),
                'Bank Name' => $employeeRel->bank_name,
                'Bank Account No' => $employeeRel->account_no,
                'Bank Code' => $employeeRel->bank_code,
                'IFSC Code' => $employeeRel->ifsc_code,
                'SWIFT Code' => $employeeRel->swift_code,
                'Account Holder Name' => $employeeRel->account_holder_name,
                'Branch Name' => $employeeRel->branch_name,
                'Address' => $employeeRel->address,
                'City' => $employeeRel->city,
                'State' => $employeeRel->state,
                'Email Address' => $employeeRel->email_address,
                'Country Code' => $employeeRel->country_code,
            ];
        }

        // Export the data using the PayslipsExport class
        return Excel::download(new PayslipsExport($payslipData, $month, $payslip['pay_period_start'], $payslip['pay_period_end']), 'payslips_' . $payReference->id . '.xlsx');
    }

    /**
     * Get pay reference duration
     */
    public function getPayReferenceDuration(){
        // Get Period Definition Rate
        $period_defination = PeriodDefinationRate::first();

        if($period_defination){
            $salary_days_count = $period_defination->salary_days_count;
        } else {
            $salary_days_count = 0;
        }
        
        return response()->json(['message' => 'success', 'days_count' => $salary_days_count]);
    }

    

        /**
     * Pay Reference PayItems
     */
    public function storePayItem(Request $request)
    {
        // Use the validate method directly on the request
        $validatedData = $request->validate([
             'payrefid' => 'required',
            'payref_payitems' => 'required',
            'payref_payitem_unit' => 'required|integer|min:1',
            'pay_item_amount' => 'required|numeric|min:0',
            'paid_on' => 'required|date',
            'pay_item_summary' => 'required|string|max:255',
        ]);

        // Since validation is successful, create the PayReferencePayItem
         // Since validation is successful, use DB query to insert the PayReferencePayItem
        DB::table('pay_reference_payitems')->insert([
            'pay_reference_id' => $request->payrefid,
            'pay_item_id' => $request->payref_payitems,
            'empid' => $request->empid,
            'payitem_unit' => $request->payref_payitem_unit,
            'payitem_amount' => $request->pay_item_amount,
            'paid_on'   => $request->paid_on,
            'payitem_summary' => $request->pay_item_summary,
            'created_at' => now(), // If you're using timestamps
            'updated_at' => now()  // If you're using timestamps
        ]);

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Pay item successfully added.'
        ]);
        
    }


}
