<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PayReferencePaySlip;
use DB;

class SuperAnnuationReportController extends Controller
{
    public function index(Request $request)
    {
        $employees = User::whereNotNull('employee_id')->get(); // Get employees list

        //dd($employees);
        $superannuationData = [];
        if ($request->employee_id) {
            $superannuationData = PayReferencePaySlip::where('employee_id', $request->employee_id)
                ->join('users', 'users.employee_id', '=', 'pay_reference_pay_slips.employee_id')
                ->select(
                    'users.name as employee_name',
                    'pay_reference_pay_slips.superannuation_id',
                    'pay_reference_pay_slips.superannuation_name',
                    'pay_reference_pay_slips.super_employer_amount',
                    'pay_reference_pay_slips.super_employee_amount'
                )
                ->get();
        }

        return view('administrator.report.superannuation.employee_superannuation_report', [
            'employees' => $employees,
            'superannuationData' => $superannuationData,
            'selectedEmployee' => $request->employee_id ?? 0
        ]);
    }

    public function showSuperannuationReport(Request $request)
    {
        $employees = User::whereNotNull('employee_id')->get(); // Get employees list

        $superannuationData = [];
        if ($request->user_id) {
            
            $superannuationData = DB::table('pay_reference_pay_slips')->where('pay_reference_pay_slips.employee_id', $request->user_id)
                ->leftJoin('users', 'users.id', '=', 'pay_reference_pay_slips.employee_id')
                ->select(
                    'users.id as employee_id',
                    'users.name as employee_name',
                    'pay_reference_pay_slips.superannuation_id',
                    'pay_reference_pay_slips.superannuation_name',
                    'pay_reference_pay_slips.super_employer_amount',
                    'pay_reference_pay_slips.super_employee_amount',
                    'pay_reference_pay_slips.created_at'
                )
                ->get();
        }

        return view('administrator.report.superannuation.employee_superannuation_report', [
            'employees' => $employees,
            'superannuationData' => $superannuationData,
            'selectedEmployee' => $request->user_id ?? 0
        ]);
    }
}
