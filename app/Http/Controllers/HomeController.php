<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\PersonalEvent;
use App\Models\User;
use Carbon\Carbon;
use App\Models\SalaryPayment;
use App\Models\Attendance;
use App\Models\LeaveManagement;

class HomeController extends Controller {

/**
 * Create a new controller instance.
 *
 * @return void
 */
	public function __construct() {
		$this->middleware('auth');
	}

/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
	public function index()
    {
        $today = Carbon::now();
        $date_today = $today->toDateString();

        // Fetch upcoming personal events
        $personal_events = PersonalEvent::query()
            ->leftJoin('users', 'users.id', '=', 'personal_events.created_by')
            ->orderBy('personal_events.start_date', 'ASC')
            ->where('personal_events.deletion_status', 0)
            ->where('personal_events.start_date', '>=', $date_today)
            ->get([
                'personal_events.*',
                'users.name',
            ]);

        // Fetch employees
        $employees = User::where('access_label', '>=', 2)
            ->where('access_label', '<=', 3)
            ->where('deletion_status', 0)
            ->get();

        // Fetch salary data for the current year (grouped by month)
        $current_year = $today->year;
        $salaries = SalaryPayment::selectRaw('MONTH(payment_month) as month, SUM(payment_amount) as total')
					->whereYear('payment_month', $current_year)
					->groupBy('month')
					->orderBy('month')
					->get();

        // Fetch attendance data for the current month
        $attendance = Attendance::selectRaw('attendance_status as status, COUNT(*) as count')
					->whereMonth('attendance_date', $today->month)
					->whereYear('attendance_date', $current_year)
					->groupBy('attendance_status')
					->get();

        // Fetch leave data for the current year
        $leaves = LeaveManagement::selectRaw('status, COUNT(*) as count')
					->whereYear('start_date', $current_year)
					->groupBy('status')
					->get();

        return view('administrator.dashboard.dashboard', compact(
            'personal_events',
            'employees',
            'salaries',
            'attendance',
            'leaves'
        ));
    }

}
