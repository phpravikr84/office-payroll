<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\PersonalEvent;
use App\Models\User;
use Carbon\Carbon;
use App\Models\SalaryPayment;
use App\Models\Attendance;
use App\Models\LeaveManagement;
use App\Models\Department;
use App\Models\AttendanceReport;
use App\Models\Notice;
use Illuminate\Support\Facades\DB;

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
	// public function index()
    // {
    //     $today = Carbon::now();
    //     $date_today = $today->toDateString();

    //     // Fetch upcoming personal events
    //     $personal_events = PersonalEvent::query()
    //         ->leftJoin('users', 'users.id', '=', 'personal_events.created_by')
    //         ->orderBy('personal_events.start_date', 'ASC')
    //         ->where('personal_events.deletion_status', 0)
    //         ->where('personal_events.start_date', '>=', $date_today)
    //         ->get([
    //             'personal_events.*',
    //             'users.name',
    //         ]);

    //     // Fetch employees
    //     $employees = User::where('access_label', '>=', 2)
    //         ->where('access_label', '<=', 3)
    //         ->where('deletion_status', 0)
    //         ->get();

    //     // Fetch salary data for the current year (grouped by month)
    //     $current_year = $today->year;
    //     $salaries = SalaryPayment::selectRaw('MONTH(payment_month) as month, SUM(payment_amount) as total')
	// 				->whereYear('payment_month', $current_year)
	// 				->groupBy('month')
	// 				->orderBy('month')
	// 				->get();

    //     // Fetch attendance data for the current month
    //     $attendance = Attendance::selectRaw('attendance_status as status, COUNT(*) as count')
	// 				->whereMonth('attendance_date', $today->month)
	// 				->whereYear('attendance_date', $current_year)
	// 				->groupBy('attendance_status')
	// 				->get();

    //     // Fetch leave data for the current year
    //     $leaves = LeaveManagement::selectRaw('status, COUNT(*) as count')
	// 				->whereYear('start_date', $current_year)
	// 				->groupBy('status')
	// 				->get();

    //     return view('administrator.dashboard.dashboard', compact(
    //         'personal_events',
    //         'employees',
    //         'salaries',
    //         'attendance',
    //         'leaves'
    //     ));
    // }

     public function index()
    {
        $today = Carbon::now();
        $date_today = $today->toDateString();

        // Fetch upcoming personal events
        $personal_events = DB::table('personal_events')
                        ->leftJoin('users', 'users.id', '=', 'personal_events.created_by')
                        ->where('personal_events.deletion_status', 0)
                        ->whereDate('personal_events.start_date', '>=', $date_today)
                        ->orderBy('personal_events.start_date', 'ASC')
                        ->select(
                            'personal_events.*',
                            'users.name'
                        )
                        ->get();

        // Fetch employees
        $employees = User::where('access_label', '>=', 2)
            ->where('access_label', '<=', 3)
            ->where('deletion_status', 0)
            ->get();

        // Fetch departments
        $departments = Department::where('deletion_status', 0)->get();

        // Fetch today's attendance from attendance_reports
        $today_attendance = DB::table('attendance_reports')
            ->leftJoin('users', 'users.id', '=', 'attendance_reports.employee_id')
            ->whereDate('attendance_reports.attendance_date', $date_today)
            ->select(
                'attendance_reports.employee_name as name',
                'users.avatar',
                'attendance_reports.in_time',
                'attendance_reports.out_time',
                'attendance_reports.late_count_flag as late'
            )
            ->get();

         

    

        // Fetch present and absent counts for today
        // Present count
        $present_count = DB::table('attendance_reports')
            ->whereDate('attendance_date', $date_today)
            ->where('absence', 0)
            ->count();

        // Absent count
        $absent_count = DB::table('attendance_reports')
            ->whereDate('attendance_date', $date_today)
            ->where('absence', 1)
            ->count();
                        
        // Fetch upcoming birthdays (within the next 30 days)
        $upcoming_birthdays = User::where('access_label', '>=', 2)
            ->where('access_label', '<=', 3)
            ->where('deletion_status', 0)
            ->whereRaw('MONTH(date_of_birth) = ? OR MONTH(date_of_birth) = ?', [$today->month, $today->copy()->addMonth()->month])
            ->whereRaw('DAY(date_of_birth) >= ? AND DAY(date_of_birth) <= ?', [$today->day, $today->copy()->addDays(30)->day])
            ->get(['name', 'avatar', 'date_of_birth', 'gender']);

        // Fetch notices
        $notices = Notice::where('deletion_status', 0)
            ->orderBy('publication_date', 'DESC')
            ->get(['notice_title', 'description', 'created_at as publication_date', 'created_by']);



        $upcoming_holidays = DB::table('holidays')
            ->leftJoin('users', 'users.id', '=', 'holidays.created_by')
            ->where('holidays.publication_status', 1)
            ->where('holidays.deletion_status', 0)
            ->whereDate('holidays.date', '>=', $date_today)
            ->orderBy('holidays.date', 'ASC')
            ->select(
                'holidays.holiday_name',
                'holidays.date',
                'holidays.description',
                'users.name as created_by_name'
            )
            ->get();



        return view('administrator.dashboard.dashboard', compact(
            'personal_events',
            'employees',
            'departments',
            'today_attendance',
            'present_count',
            'absent_count',
            'upcoming_birthdays',
            'notices',
            'upcoming_holidays'
        ));
    }

}
