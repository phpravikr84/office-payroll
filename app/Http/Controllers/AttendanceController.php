<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\LeaveCategory;
use App\Models\SetTime;
use App\Models\User;
use App\Models\WorkingDay;
use App\Models\AttendanceReport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport; // Import your AttendanceImport class
use App\Imports\AttendanceCSVImport;
use App\Models\AttendanceRecord; // Import your model
use Carbon\Carbon;
use DB;
use PDF;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$attendenceRecords = AttendanceRecord::whereDate('created_at', Carbon::today())->get();
		return view('administrator.hrm.attendance.index', compact('attendenceRecords'));
	}

	/**
	 * Manual Settting
	 */
	public function manual_setting() {
		return view('administrator.hrm.attendance.manual_setting');
	}

	/**
	 * Attendance Manage
	 */
	public function attendance_manage() {
		$attendenceRecords = AttendanceRecord::whereDate('created_at', Carbon::today())->get();
		return view('administrator.hrm.attendance.manage_attendance', compact('attendenceRecords'));
	}

	/**
	 * Import Sheet
	 */
	// public function import(Request $request)
	// {
	// 	// Validate the uploaded file
	// 	$request->validate([
	// 		'import_file' => 'required|mimes:xlsx,xls',
	// 	]);

	// 	// Get all attendance records created today
	// 	$existingRecordsToday = AttendanceRecord::whereDate('created_at', today())->get();

	// 	// If there are records for today, delete all of them
	// 	if ($existingRecordsToday->isNotEmpty()) {
	// 		foreach ($existingRecordsToday as $record) {
	// 			$record->delete();
	// 		}
	// 	}

	// 	// Convert the Excel file to an array
	// 	$importedData = Excel::toArray(new AttendanceImport, $request->file('import_file'));

	// 	// Loop through the data array and pass it to the AttendanceImport model
	// 	foreach ($importedData[0] as $row) {
	// 		// Skip if the row is empty
	// 		if (empty(array_filter($row))) {
	// 			continue;
	// 		}
			
	// 		// Process each row using the model logic
	// 		$data = (new AttendanceImport)->model($row);
	// 	}

	// 	if($data){
	// 		$insertedRecords = AttendanceRecord::create([
	// 			'employee_id' => $row['employee_id'],
	// 			'employee_name' => $row['employee_name'],
	// 			'department' => $row['department'],
	// 			'date' => $formattedDate,
	// 			'in_time' => $checkInTime,
	// 			'out_time' => $checkOutTime,
	// 			'work_time' => $workHours,
	// 			'overtime_hours' => $row['overtime_hours'],
	// 			'attendance_status' => $row['attendance_status'],
	// 			'late' => $late,
	// 			'early' => $early,
	// 			'remarks' => $row['remarks'] ?? '-',
	// 		]);
	// 		if($insertedRecords){
	// 			// Return a success response
	// 			return response()->json(['success' => 'Attendance records imported successfully!']);
	// 		} else {
	// 			// Return a success response
	// 			return response()->json(['error' => 'Attendance records imported failed!']);
	// 		}
	// 	} else{
	// 		return response()->json(['error' => 'No records were imported.']);
	// 	}
		

		
	// }
	public function import(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'import_file' => 'required|mimes:xlsx,xls',
    ]);

    // Get all attendance records created today
    $existingRecordsToday = AttendanceRecord::whereDate('created_at', today())->get();

    // If there are records for today, delete all of them
    if ($existingRecordsToday->isNotEmpty()) {
        foreach ($existingRecordsToday as $record) {
            $record->delete();
        }
    }

    // Convert the Excel file to an array
    $importedData = Excel::toArray(new AttendanceImport, $request->file('import_file'));

    // Initialize a variable to track success
    $insertedCount = 0;

    // Loop through the data array and pass it to the AttendanceImport model
    foreach ($importedData[0] as $row) {
        // Skip if the row is empty
        if (empty(array_filter($row))) {
            continue;
        }

        // Process each row using the model logic
        $data = (new AttendanceImport)->model($row);

        // Check if data was returned and insert it into the database
        if ($data) {
            $insertedRecord = AttendanceRecord::create($data);

            // Check if the record was inserted successfully
            if ($insertedRecord) {
                $insertedCount++;
            }
        }
    }

    // Check how many records were inserted
    if ($insertedCount > 0) {
        return response()->json(['success' => "$insertedCount attendance records imported successfully!"]);
    } else {
        return response()->json(['error' => 'No records were imported.']);
    }
}


	/**
	 * Import Sheet
	 */
	public function import_csv(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'mycsv' => 'required|file|mimes:csv,txt', // Add 'txt' if necessary
        ]);

        // Import the Excel file
        Excel::import(new AttendanceCSVImport, $request->file('mycsv'));

        // Return a success response
        return response()->json(['success' => 'Attendance records imported successfully!']);
    }

	/**
	 *  Edti Attendance
	 */
	public function attendance_edit(Request $request, $id){

		  // Fetch the attendance record by ID
		  $attendance = AttendanceRecord::findOrFail($id);

		  // In your controller, when fetching the attendance record
			$attendance->in_time = \Carbon\Carbon::parse($attendance->in_time)->format('H:i');
			$attendance->out_time = \Carbon\Carbon::parse($attendance->out_time)->format('H:i');


		  // Pass the attendance record to the edit view
		  return view('administrator.hrm.attendance.edit_attendance_new', compact('attendance'));
	}

	public function attendance_edit_report(Request $request, $id){
		
		  // Fetch the attendance record by ID
		  //$attendance = AttendanceReport::findOrFail($id);
		   $attendance = DB::table('attendance_reports')
			->where('id', $id)
			->first();	  		

		  // In your controller, when fetching the attendance record
			$attendance->in_time = \Carbon\Carbon::parse($attendance->in_time)->format('H:i');
			$attendance->out_time = \Carbon\Carbon::parse($attendance->out_time)->format('H:i');


		  // Pass the attendance record to the edit view
		  return view('administrator.hrm.attendance.edit_attendance_new_rprt', compact('attendance'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function set_attendance(Request $request) {


		$attendance_day = date("D", strtotime($request->date));

		$weekly_holidays = WorkingDay::where('working_status', 0)
			->get(['day'])
			->toArray();

		$monthly_holidays = Holiday::where('date', '=', $request->date)
			->first(['date']);

		if  (!is_null($monthly_holidays)) {
		if ($monthly_holidays['date'] == $request->date or is_null($monthly_holidays['date'])) {
			return redirect('/hrm/attendance/manage')->with('exception', 'You select a holiday !');
		}}

		foreach ($weekly_holidays as $weekly_holiday) {
			if ($attendance_day == $weekly_holiday['day']) {
				return redirect('/hrm/attendance/manage')->with('exception', 'You select a holiday !');
			}
		}

		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->leftjoin('set_times as shift', 'users.shift_id', '=', 'shift.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id', 'shift.in_time', 'shift.out_time'])
			->toArray();

		$leave_categories = LeaveCategory::get()
			->where('deletion_status', 0)
			->toArray();
		$date = $request->date;

		$attendances = Attendance::where('attendance_date', $date)
			->get()
			->toArray();

		if (empty($attendances)) {
			return view('administrator.hrm.attendance.set_attendance', compact('employees', 'leave_categories', 'date'));
		}
		return view('administrator.hrm.attendance.edit_attendance', compact('employees', 'leave_categories', 'date', 'attendances'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
       
   // return $request;
		for ($i = 0; $i < count($request->user_id); $i++) {
			$stimes = User::query()
			->leftjoin('set_times as shift', 'users.shift_id', '=', 'shift.id')
			->where('users.id', $request->user_id[$i])
			->get(['shift.in_time', 'shift.out_time'])
			->toArray();
			$in_t = $stimes[0]['in_time'];
			$out_t = $stimes[0]['out_time'];
			Attendance::create([
				'created_by' => auth()->user()->id,
				'user_id' => $request->user_id[$i],
				'attendance_date' => $request->attendance_date[$i],
				'attendance_status' => $request->attendance_status[$i],
				'leave_category_id' => $request->leave_category_id[$i],
				'check_in' => $request->check_in[$i],
				'check_out' => $request->check_out[$i],
				'shift_in' => $in_t,
				'shift_out' => $out_t,				
			]);
		}
		return redirect('/hrm/attendance/manage')->with('message', 'Add successfully.');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request) {

  
		for ($i = 0; $i < count($request->user_id); $i++) {

			$attendance = Attendance::find($request->attendance_id[$i]);
			$attendance->user_id = $request->user_id[$i];
			$attendance->attendance_date = $request->attendance_date[$i];
			$attendance->attendance_status = $request->attendance_status[$i];
			$attendance->leave_category_id = $request->leave_category_id[$i];
			$attendance->check_in = $request->check_in[$i];
			$attendance->check_out = $request->check_out[$i];
			$affected_row = $attendance->save();


		}
		return redirect('/hrm/attendance/manage')->with('message', 'Update successfully.');
	}

	/**
	 *  Update Attendence Records
	 */
	public function update_new(Request $request, $id) {
		//dd($request);
		// Validate the request
		$request->validate([
			'date' => 'required|date',
			'in_time' => 'required',
			'out_time' => 'required',
			//'overtime_hours' => 'required|numeric',
			'attendance_status' => 'required|string',
			'remarks' => 'nullable|string|max:255',
		]);
	
		// Find the attendance record by ID
		$attendance = AttendanceRecord::findOrFail($id);
	
		
		// Update the fields based on the request
		$attendance->date = $request->date; // Updated field
		$attendance->in_time = $request->in_time; // Updated field
		$attendance->out_time = $request->out_time; // Updated field
		$attendance->overtime_hours = $request->overtime_hours; // Updated field
		$attendance->attendance_status = $request->attendance_status; // Updated field
		$attendance->remarks = $request->remarks; // Updated field
		// Optionally, you can calculate work time based on in_time and out_time
		$attendance->work_time = $this->calculateWorkTime($attendance->in_time, $attendance->out_time); // Example function
	
		// Save the updated record
		$attendance->save();
	
		return redirect('/hrm/attendance/manage')->with('message', 'Update successfully.');
	}
	
	// Example function to calculate work time round
	private function calculateWorkTime($in_time, $out_time) {
		// Logic to calculate work time, e.g., using Carbon
		$in = Carbon::parse($in_time);
		$out = Carbon::parse($out_time);
		return $out->diffInHours($in); // Returns the difference in hours
	}
	// Example function to calculate work time float
	private function calculateWorkTimeFlt($in_time, $out_time) {
		 // Parse the in and out times using Carbon
		 $in = Carbon::parse($in_time);
		 $out = Carbon::parse($out_time);
	 
		 // Calculate the difference in total minutes
		 $diffInMinutes = $out->diffInMinutes($in);
	 
		 // Get hours and minutes
		 $hours = floor($diffInMinutes / 60); // Whole hours
		 $minutes = $diffInMinutes % 60; // Remaining minutes
	 
		 // Format the result as 'H:MM'
		 return sprintf('%d:%02d', $hours, $minutes); // Format as 'H:MM'
	}
	

	private function calculateWorkOverTime($in_time, $out_time) {
		// Parse the input times using Carbon
		$in = Carbon::parse($in_time);
		$out = Carbon::parse($out_time);
		
		// Calculate total work time in minutes
		$totalMinutes = $out->diffInMinutes($in);
		
		// Calculate overtime
		$overtimeMinutes = 0;
		if ($totalMinutes > 540) { // 540 minutes = 9 hours
			$overtimeMinutes = $totalMinutes - 540; // Calculate overtime minutes
		}
	
		// Return both total work time in hours and overtime minutes
		return $overtimeMinutes;
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function report() {
		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();
			 // Fetch the attendance record by ID
			 $attendanceRecords = DB::table('attendance_reports')
			 ->leftJoin('leave_managements', 'attendance_reports.leave_id', '=', 'leave_managements.id')
			 ->leftJoin('leave_categories', 'attendance_reports.leave_category_id', '=', 'leave_categories.id')
			 ->select('attendance_reports.*', 'attendance_reports.id as attendance_id', 'leave_managements.leave_type', 'leave_categories.leave_category')
			 ->get();
			 //dd($employees);
			
			// return view('administrator.hrm.attendance.history');
		return view('administrator.hrm.attendance.report', compact('employees', 'attendanceRecords'));
	}

	/** Search  */
	public function searchAttendance(Request $request)
	{
		// Initialize query builder with the necessary table joins
		$attendanceQuery = DB::table('attendance_reports')
			->leftJoin('leave_managements', 'attendance_reports.leave_id', '=', 'leave_managements.id')
			->leftJoin('leave_categories', 'attendance_reports.leave_category_id', '=', 'leave_categories.id')
			->select('attendance_reports.*', 'leave_managements.leave_type', 'leave_categories.leave_category');

		// Check if emp_id is set and valid
		if ($request->filled('emp_id')) {
			$empId = $request->input('emp_id');
			$attendanceQuery->where('attendance_reports.employee_id', $empId);
		}

		// Check if start date is set
		if ($request->filled('start')) {
			$startDate = $request->input('start');
			$attendanceQuery->whereDate('attendance_reports.attendance_date', '>=', $startDate);
		}

		// Check if end date is set
		if ($request->filled('end')) {
			$endDate = $request->input('end');
			$attendanceQuery->whereDate('attendance_reports.attendance_date', '<=', $endDate);
		}

		// Fetch attendance records based on the dynamic query
		$attendanceRecords = $attendanceQuery->get();

		// Fetch all employees for the select dropdown
		$employees = DB::table('users')
			->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
			->leftJoin('set_times as shift', 'users.shift_id', '=', 'shift.id')
			->orderBy('users.name', 'ASC')
			->whereBetween('users.access_label', [2, 3])
			->select('designations.designation', 'users.name', 'users.id', 'shift.in_time', 'shift.out_time')
			->get();
		
		// Return the view with the results
		return view('administrator.hrm.attendance.report', compact('attendanceRecords', 'employees'))
			->with('query', $request->query());
	}


	public function generateAttendanceSheet(Request $request)
	{
		// Retrieve all attendance records from the database using DB query
		$attendanceRecords = DB::table('attendance_records')->where('is_process', '0')->get();

		if ($attendanceRecords->isEmpty()) {
			return response()->json(['message' => 'No attendance records to process.'], 400);
		}

		$success = true;
		$errorMessages = [];

		foreach ($attendanceRecords as $attendance) {
			$employee_id = $attendance->employee_id;
			$date = Carbon::parse($attendance->date);
			$month = $date->format('m');
			$year = $date->format('Y');

			try {
				// Call the processAttendanceRecords method to generate the attendance sheet
				$this->processAttendanceRecords($employee_id, $month, $year);
			} catch (\Exception $e) {
				// Log the error message
				Log::error('Error processing attendance for employee ID ' . $employee_id . ': ' . $e->getMessage());
				// Set the success flag to false
				$success = false;
				// Collect the error message
				$errorMessages[] = 'Error processing attendance for employee ID ' . $employee_id . ': ' . $e->getMessage();
			}
		}

		// If any errors occurred during processing
		if (!$success) {
			return response()->json([
				'message' => 'Attendance sheet generation completed with errors.',
				'errors' => $errorMessages
			], 500);
		}

		return response()->json(['message' => 'Attendance sheet generated successfully.']);
	}

	// public function generateAttendanceSheet(Request $request)
	// {
	// 	// Retrieve all attendance records from the database using DB query
	// 	$attendanceRecords = DB::table('attendance_records')->where('is_process', '0')->get();

	
	// 	if ($attendanceRecords) {
	// 		foreach ($attendanceRecords as $attendance) {
	// 			// Retrieve the employee ID, month, and year from the attendance record
	// 			$employee_id = $attendance->employee_id;
				
	// 			// Manually convert the date string to a Carbon instance
	// 			$date = Carbon::parse($attendance->date);
	
	// 			// Get the month and year from the Carbon date instance
	// 			$month = $date->format('m'); // Get month as '01', '02', etc.
	// 			$year = $date->format('Y');  // Get full year as '2024'
	
	// 			// Call the processAttendanceRecords method to generate the attendance sheet
	// 			$this->processAttendanceRecords($employee_id, $month, $year);
	// 		}
	// 	}
	
	// 	// Redirect back with a success message or to the desired view
	// 	return redirect()->back()->with('success', 'Attendance sheet generated successfully.');
	// }
	
	/**
	 * Process Attendance
	*/
	// public function processAttendanceRecords($employee_id, $month, $year)
	// {
	// 	$startDate = Carbon::create($year, $month, 1); // First day of the month
	// 	$endDate = $startDate->copy()->endOfMonth(); // Last day of the month
	// 	$dates = [];
	
	// 	// Create an array of all dates in the month.
	// 	for ($date = $startDate; $date <= $endDate; $date->addDay()) {
	// 		$dates[] = (string)$date->format('Y-m-d'); // Store the date in 'Y-m-d' format
	// 	}

	
	// 	// Step 2: Loop through each date in the month to process the attendance.
	// 	foreach ($dates as $attendance_date) {
			
	// 		// Step 3: Check if an attendance report already exists for the employee on this date.
	// 		$existingRecord = DB::table('attendance_reports')
	// 			->where('employee_id', $employee_id)
	// 			->where('attendance_date', $attendance_date)
	// 			->first();
	
	// 		if (!$existingRecord) {
	// 			// Step 4: Check if there is an attendance record for this date in the attendance_records table.
	// 			$attendanceRecord = DB::table('attendance_records')
	// 				->where('employee_id', $employee_id)
	// 				->where('date', $attendance_date)
	// 				->first();
	
	// 			if ($attendanceRecord) {
	// 				$this->updateAttendance($attendanceRecord);
	// 			} else {
	// 				// Step 5: Handle the case where there is no attendance record.
	// 				$workingDay = DB::table('working_days')
	// 							->where('day', Carbon::parse($attendance_date)->format('D'))
	// 							->first();
	// 				// Fetch the employee name
	// 				$employeeName = DB::table('users')->where('id', $employee_id)->value('name');
	// 				DB::table('attendance_reports')->insert([
	// 					'employee_id' => $employee_id,
	// 					'employee_name' => $employeeName,
	// 					'attendance_date' => $attendance_date,
	// 					'absence' => 1,
	// 					'working_days_id' => $workingDay->id,
	// 					'working_hours' => $workingDay->working_hours, 
	// 					'working_day_name' => $workingDay->day,
	// 					'created_at' => Carbon::now(),
	// 					'updated_at' => Carbon::now()
	// 				]);
					
	// 				// Step 5a: Check if the date is a public holiday.
	// 				$holiday = DB::table('holidays')
	// 					->where('date', $attendance_date)
	// 					->first();

	// 				// echo '<pre>';
	// 				// echo $attendance_date;
	// 				// print_r($holiday);
	// 				// exit;
						
	// 				if ($holiday) {
	// 					// It's a public holiday, insert holiday record.
	// 					$workingDay = DB::table('working_days')
	// 					->where('day', Carbon::parse($holiday->date)->format('D'))
	// 					->first();

	// 					// Get Report Matches date
	// 					$getReportsMatches = DB::table('attendance_reports')->where('attendance_date', $holiday->date)->get();

	// 					if ($getReportsMatches) {
	// 						foreach ($getReportsMatches as $insertedReport) {
	// 							// Assuming you want to pass the report ID to the insertHolidayRecord method
	// 							$this->insertHolidayRecord($employee_id, $attendance_date, $holiday->id, $workingDay->working_hours, $insertedReport->id);
	// 						}
	// 					}

	// 				} else {
	// 					// Step 5b: Check if the date is a weekend (Saturday or Sunday).
	// 					if ($this->isWeekend($attendance_date)) {
	// 						$dayOfWeek = Carbon::parse($attendance_date)->format('D');
	// 						//Carbon::parse($attendance_date)->dayOfWeek;
	
	// 						// Check if it's a non-working weekend in the working_days table.
	// 						$workingDays = DB::table('working_days')
	// 							->where('day', $dayOfWeek)
	// 							->where('working_status', 0) // Non-working status
	// 							->get();
					
	// 						if ($workingDays) {
	// 							foreach($workingDays as $workingDay){
	// 								// Get Report Matches date
	// 								$getReportsMatches = DB::table('attendance_reports')->where('attendance_date', $attendance_date)->get();

	// 								if ($getReportsMatches) {
	// 									foreach ($getReportsMatches as $insertedReport) {
	// 										// Assuming you want to pass the report ID to the insertHolidayRecord method
	// 										$this->insertWeekendRecord($employee_id, $attendance_date, $workingDay->id, $workingDay->working_hours, $insertedReport->id);
	// 									}
	// 								}
	// 							}
	// 						}
	// 					} else {
	// 						// Step 5c: Check if the employee was on leave during this date in the leave_managements table.
	// 						// $leave = DB::table('leave_managements')
	// 						// 	->where('user_id', $employee_id)
	// 						// 	->where('start_date', '<=', $attendance_date)
	// 						// 	->where('end_date', '>=', $attendance_date)
	// 						// 	->first();
	
	// 						// if ($leave) {
								
	// 						// 	echo '<pre>';
	// 						// 	echo 'Attendance Date'. $attendance_date;
	// 						// 	print_r($leave);
	// 						// 	// Get Report Matches date
	// 						// 	$getReportsMatches = DB::table('attendance_reports')->where('attendance_date', $attendance_date)->get();
	// 						// 	if ($getReportsMatches) {
	// 						// 		foreach ($getReportsMatches as $insertedReport) {
	// 						// 			$this->processLeaveRecord($employee_id, $attendance_date, $leave, $insertedReport->id);
	// 						// 		}
	// 						// 	}
								
	// 						// }
	// 					}
	// 				}

	// 				// Step 5c: Check if the employee was on leave during this date in the leave_managements table.
	// 				$leave = DB::table('leave_managements')
	// 				->where('user_id', $employee_id)
	// 				->where('start_date', '<=', $attendance_date)
	// 				->where('end_date', '>=', $attendance_date)
	// 				->first();

	// 			if ($leave) {
	// 				// Get Report Matches date
	// 				$getReportsMatches = DB::table('attendance_reports')->where('attendance_date', $attendance_date)->get();
	// 				if ($getReportsMatches) {
	// 					foreach ($getReportsMatches as $insertedReport) {
	// 						$this->processLeaveRecord($employee_id, $attendance_date, $leave, $insertedReport->id);
	// 					}
	// 				}
					
	// 			}


	// 			}
	// 		}
	// 	}
	// }

	public function processAttendanceRecords($employee_id, $month, $year)
	{
		$startDate = Carbon::create($year, $month, 1); // First day of the month
		$endDate = $startDate->copy()->endOfMonth(); // Last day of the month
		$dates = [];

		// Create an array of all dates in the month.
		for ($date = $startDate; $date <= $endDate; $date->addDay()) {
			$dates[] = (string)$date->format('Y-m-d'); // Store the date in 'Y-m-d' format
		}

		// Step 2: Loop through each date in the month to process the attendance.
		foreach ($dates as $attendance_date) {
			// Step 3: Check if an attendance report already exists for the employee on this date.
			try {
				$existingRecord = DB::table('attendance_reports')
					->where('employee_id', $employee_id)
					->where('attendance_date', $attendance_date)
					->first();
			} catch (Exception $e) {
				Log::error('Error fetching existing attendance record: ' . $e->getMessage());
				continue; // Skip this iteration and move to the next date
			}

			

			if (!$existingRecord) {
				// Step 4: Check if there is an attendance record for this date in the attendance_records table.
				try {
					$attendanceRecord = DB::table('attendance_records')
						->where('employee_id', $employee_id)
						->where('date', $attendance_date)
						->first();
				} catch (Exception $e) {
					Log::error('Error fetching attendance record: ' . $e->getMessage());
					continue; // Skip this iteration and move to the next date
				}

				//dd($attendanceRecord);

				if ($attendanceRecord) {
					$this->updateAttendance($attendanceRecord);
				}
			}
		}
	}


	
	// Function to update attendance report when attendance data is found in attendance_records.
	protected function updateAttendance($attendanceRecord)
	{
		// Ensure no duplicate entries.
		$existingRecord = DB::table('attendance_reports')
			->where('employee_id', $attendanceRecord->employee_id)
			->where('attendance_date', $attendanceRecord->date)
			->first();
	
		if (!$existingRecord) {
			// $startTime = $this->convertToDatabaseTime($attendanceRecord->in_time);
    		// $endTime = $this->convertToDatabaseTime($attendanceRecord->out_time);
			$startTime = $attendanceRecord->in_time;
    		$endTime = $attendanceRecord->out_time;

			// Check Late and Early leave
			$workingDay = Carbon::parse($attendanceRecord->date)->format('D');
			$late = $this->getLateEmployee($startTime, $workingDay);
			$early = $this->getEarlyLeaveEmployee($startTime, $endTime, $workingDay);

			$workingDay = DB::table('working_days')
							->where('day', Carbon::parse($attendanceRecord->date)->format('D'))
							->first();
			// Create an entry in attendance_reports with the data from attendance_records.
			$insertedId = DB::table('attendance_reports')->insertGetId([
				'employee_id' => $attendanceRecord->employee_id,
				'employee_name' => $attendanceRecord->employee_name,
				'attendance_date' => $attendanceRecord->date,
				'in_time' => $startTime,
				'out_time' => $endTime,
				'work_time' =>  $this->calculateWorkTimeFlt($attendanceRecord->in_time, $attendanceRecord->out_time), // Use the paid hours from attendance_records
				'paid_hours' => $this->calculateWorkTimeFlt($attendanceRecord->in_time, $attendanceRecord->out_time), // Use the paid hours from attendance_records
				'late' => $late,
				'early' => $early,
				'is_holiday' => 0, // Not a holiday
				'working_days_id' => $workingDay->id,
				'working_hours' => $workingDay->working_hours, 
				'working_day_name' => $workingDay->day,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			]);

			//Check if any holiday
			$holiday = DB::table('holidays')
	 					->where('date', $attendanceRecord->date)
						->first();
			if($holiday){
				// It's a public holiday, insert holiday record.
	 					$workingDay = DB::table('working_days')
	 					->where('day', Carbon::parse($holiday->date)->format('D'))
						->first();
				$this->insertHolidayRecord($attendanceRecord->employee_id, $attendanceRecord->date, $holiday->id, $workingDay->working_hours, $insertedId);
			}

			// Check if the employee was on leave during this date in the leave_managements table.
			$leave = DB::table('leave_managements')
			->where('user_id', $attendanceRecord->employee_id)
			->where('start_date', '<=', $attendanceRecord->date)
			->where('end_date', '>=', $attendanceRecord->date)
			->first();
			//echo 'userid'.$attendanceRecord->employee_id;
			//echo 'startdate'.$attendanceRecord->date;
			//dd($leave);
			if ($leave) {
				$this->processLeaveRecord($attendanceRecord->employee_id, $attendanceRecord->date, $leave, $insertedId);
			}
		}

			
	}
	
	// Function to insert a record for a public holiday.
	protected function insertHolidayRecord($employee_id, $attendance_date, $holiday_id, $working_hours, $report_id)
	{
		// Ensure no duplicate entries.
		$existingRecord = DB::table('attendance_reports')
			->where('employee_id', $employee_id)
			->where('attendance_date', $attendance_date)
			->first();
	
		if ($existingRecord) {
			// Create an entry in attendance_reports for the holiday.
			DB::table('attendance_reports')->where('id', $report_id)->update([
				'attendance_date' => $attendance_date,
				'paid_hours' => $working_hours, // Paid hours based on the working day hours
				'is_holiday' => 1, // Mark as holiday
				'holiday_id' => $holiday_id, // Reference to the holiday in holidays table
				'updated_at' => Carbon::now()
			]);

		}
	}
	
	// Function to insert a record for a weekend (non-working day).
	protected function insertWeekendRecord($employee_id, $attendance_date, $working_day_id, $working_hours, $report_id)
	{
		// Ensure no duplicate entries.
		$existingRecord = DB::table('attendance_reports')
			->where('employee_id', $employee_id)
			->where('attendance_date', $attendance_date)
			->first();
	
		if ($existingRecord) {
			// Create an entry in attendance_reports for the weekend.
			DB::table('attendance_reports')->where('id', $report_id)->update([
				'attendance_date' => $attendance_date,
				'paid_hours' => $working_hours, // Paid hours based on the working day hours
				'is_holiday' => 1, // Mark as holiday (non-working weekend)
				'working_days_id' => $working_day_id, // Reference to the working day in working_days table
				'updated_at' => Carbon::now()
			]);
		}
	}
	
	// Function to process leave data from the leave_managements table.
	// protected function processLeaveRecord($employee_id, $attendance_date, $leave, $report_id)
	// {
	// 	$workingDay = DB::table('working_days')
	// 		->where('day', Carbon::parse($attendance_date)->format('D'))
	// 		->first();
	// 	if ($leave->loss_of_pay_days == 0 && $leave->sandwich_leave_days == 0 && $leave->leave_disapprove_days == 0 && $leave->status == 2) {
	// 		$existingRecord = DB::table('attendance_reports')
	// 			->where('employee_id', $employee_id)
	// 			->where('attendance_date', $attendance_date)
	// 			->first();
	
	// 		if ($existingRecord) {
	// 			DB::table('attendance_reports')->where('id', $report_id)->update([
	// 				'attendance_date' => $attendance_date,
	// 				'absence_type' => 'leave_applied',
	// 				'leave_id' => $leave->id,
	// 				'leave_category_id' =>	$leave->leave_category_id,
	// 				'start_date' => $leave->start_date,
	// 				'end_date' => $leave->end_date,
	// 				'leave_status' =>  $leave->status,
	// 				'leave_reason' => $leave->reason,
	// 				'paid_hours' => 0, // Paid hours as per the working day
	// 				//'is_holiday' => 0, // Not a holiday
	// 				'working_days_id' => $workingDay->id, // Reference to the working day
	// 				'updated_at' => Carbon::now()
	// 			]);
	// 		}
	// 	} elseif ($leave->loss_of_pay_days != 0 || $leave->sandwich_leave_days != 0 || $leave->leave_disapprove_days != 0 && ($leave->status == 1 || $leave->status == 3)) {
	// 		$existingRecord = DB::table('attendance_reports')
	// 			->where('employee_id', $employee_id)
	// 			->where('attendance_date', $attendance_date)
	// 			->first();
	
	// 		if ($existingRecord) {
	// 			if ($leave->is_sandwich_leave){
	// 				DB::table('attendance_reports')->where('id', $report_id)->update([
	// 					'attendance_date' => $attendance_date,
	// 					'absence_type' => 'sandwitch_leave',
	// 				]);
	// 			} else {
	// 				DB::table('attendance_reports')->where('id', $report_id)->update([
	// 					'attendance_date' => $attendance_date,
	// 					'absence_type' => 'leave_applied',
	// 					'leave_id' => $leave->id,
	// 					'leave_category_id' =>	$leave->leave_category_id,
	// 					'start_date' => $leave->start_date,
	// 					'end_date' => $leave->end_date,
	// 					'leave_status' =>  $leave->status,
	// 					'leave_reason' => $leave->reason,
	// 					'paid_hours' => $workingDay->working_hours, // No paid hours as it's an unpaid leave
	// 					//'is_holiday' => 0, // Not a holiday
	// 					'working_days_id' => $workingDay->id, // Reference to the working day
	// 				]);
	// 			}
	// 		}
	// 	}
	// }

	protected function processLeaveRecord($employee_id, $attendance_date, $leave, $report_id)
	{
		
		// Fetch working day for the current attendance date
		$workingDay = DB::table('working_days')
			->where('day', Carbon::parse($attendance_date)->format('D'))
			->first();
		
		// Check the previous and next dates to determine sandwich leave
		$previousDay = Carbon::parse($attendance_date)->subDay()->format('Y-m-d');
		$nextDay = Carbon::parse($attendance_date)->addDay()->format('Y-m-d');
		
		// Fetch leave for the previous and next days
		$previousLeave = DB::table('leave_managements')
			->where('user_id', $employee_id)
			->where('start_date', '<=', $previousDay)
			->where('end_date', '>=', $previousDay)
			->first();
		
		$nextLeave = DB::table('leave_managements')
			->where('user_id', $employee_id)
			->where('start_date', '<=', $nextDay)
			->where('end_date', '>=', $nextDay)
			->first();
		
		// Fetch existing attendance report for the employee on the attendance date
		$existingRecord = DB::table('attendance_reports')
			->where('employee_id', $employee_id)
			->where('attendance_date', $attendance_date)
			->first();

		// If a leave exists for the current date and sandwich leave conditions apply
		if ($existingRecord) {
			// Check if it's a weekend (Saturday or Sunday) and if leave exists before and after the weekend
			if (
				(Carbon::parse($attendance_date)->format('D') == 'Sat' || Carbon::parse($attendance_date)->format('D') == 'Sun') 
				&& $previousLeave 
				&& $nextLeave
			) {
				// Call the updateSandwichLeave method to handle sandwich leave logic
				$this->updateSandwichLeave($report_id, $leave, $workingDay);
			} else {
				// Handle regular leave (non-sandwich)
				DB::table('attendance_reports')->where('id', $report_id)->update([
					'absence_type' => 'leave_applied',
					'leave_id' => $leave->id,
					'leave_category_id' => $leave->leave_category_id,
					'start_date' => $leave->start_date,
					'end_date' => $leave->end_date,
					'leave_status' => $leave->status,
					'leave_reason' => $leave->reason,
					'paid_hours' => $workingDay ? $workingDay->working_hours : 0, // Paid hours if it's a regular working day
					'working_days_id' => $workingDay ? $workingDay->id : null,
					'updated_at' => Carbon::now(),
				]);
			}
		}
	}

	// Example of the updateSandwichLeave method
	protected function updateSandwichLeave($report_id, $leave, $workingDay)
	{
		DB::table('attendance_reports')->where('id', $report_id)->update([
			'absence_type' => 'sandwich_leave',
			'leave_id' => $leave->id,
			'leave_category_id' => $leave->leave_category_id,
			'start_date' => $leave->start_date,
			'end_date' => $leave->end_date,
			'leave_status' => $leave->status,
			'leave_reason' => $leave->reason,
			'paid_hours' => 0, // No paid hours as it's a sandwich leave
			'working_days_id' => $workingDay ? $workingDay->id : null,
			'updated_at' => Carbon::now(),
		]);
	}


	
	// Function to check if a date falls on a weekend (Saturday or Sunday).
	protected function isWeekend($date)
	{
		$dayOfWeek = Carbon::parse($date)->dayOfWeek;
		return in_array($dayOfWeek, [0, 6]);
	}
	
	/** Convert Time */
	private function convertToDatabaseTime($timeString)
	{
		// Use Carbon to parse the time string and convert it to a database time format (H:i:s)
		$time = Carbon::createFromFormat('g:i A', $timeString);

		// Return the time in 'H:i:s' format
		return $time->format('H:i:s');
	}

	/**
	 * Get late value
	 */
	private function getLateEmployee($in_time, $day) {
		$late = "00:00:00"; // Default value for late

		// Fetch the working hours for the day
		$workingHours = DB::table('working_days')->where('day', $day)->first();

		if ($workingHours) {
			// Parse the employee's in_time (e.g. 09:45:00)
			$inTime = Carbon::parse($in_time);

			// Set the expected start time based on working hours (e.g. 09:00:00)
			$expectedStartTime = Carbon::createFromTime(9, 0, 0);  // Assuming working hours start at 9:00 AM

			// Add the grace period (e.g., 15 minutes grace)
			$expectedStartTimeWithGrace = $expectedStartTime->addMinutes($workingHours->grace_periods);

			// Check if the employee is late
			if ($inTime->greaterThan($expectedStartTimeWithGrace)) {
				// Calculate the late minutes
				$lateMinutes = $inTime->diffInMinutes($expectedStartTimeWithGrace);

				// Convert minutes into hours and minutes in "HH:MM:SS" format
				$hours = floor($lateMinutes / 60);
				$minutes = $lateMinutes % 60;
				$late = sprintf('%02d:%02d:00', $hours, $minutes); // Return in "HH:MM:SS" format
			}
		}

		return $late; // Return the late time in "HH:MM:SS" format
	}


	/**
	 * Get early leave value
	 */
	private function getEarlyLeaveEmployee($in_time, $out_time, $day) {
		$early = "00:00:00"; // Default value

		// Fetch the working hours for the day
		$workingHours = DB::table('working_days')->where('day', $day)->first();

		if ($workingHours) {
			// Parse the in_time and out_time
			$inTime = Carbon::parse($in_time);
			$outTime = Carbon::parse($out_time);

			// Define a fixed end time at 5:00 PM (or the time defined by your rule)
			$fixedEndTime = Carbon::createFromTime(17, 0, 0); // 5:00 PM

			// If the employee leaves earlier than the fixed end time (6:00 PM)
			if ($outTime->lessThan($fixedEndTime)) {
				// Calculate early leave in minutes
				$earlyMinutes = $fixedEndTime->diffInMinutes($outTime);

				// Convert minutes into hours and minutes in "HH:MM:SS" format
				$hours = floor($earlyMinutes / 60);
				$minutes = $earlyMinutes % 60;
				$early = sprintf('%02d:%02d:00', $hours, $minutes); // Return in "HH:MM:SS" format
			}
		}

		return $early; // Return early leave time in "HH:MM:SS" format
	}






	/**
	 *  OLD METHOD AVAILABLE BEWLOW
	 */

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function get_report(Request $request) {
		$date = $request->date;
		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));

		$number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		$attendances = Attendance::query()
			->leftjoin('leave_categories as leave', 'attendances.leave_category_id', '=', 'leave.id')
			->whereYear('attendances.attendance_date', '=', $year)
			->whereMonth('attendances.attendance_date', '=', $month)
			->get(['attendances.*', 'leave.leave_category'])
			->toArray();

		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();

		$weekly_holidays = WorkingDay::where('working_status', 0)
			->get()
			->toArray();

		$monthly_holidays = Holiday::whereYear('date', '=', $year)
			->whereMonth('date', '=', $month)
			->get(['date', 'holiday_name'])
			->toArray();

		return view('administrator.hrm.attendance.get_report', compact('date', 'attendances', 'employees', 'number_of_days', 'weekly_holidays', 'monthly_holidays'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

     public function timeSet(Request $request) {

     	//return $request;

     	$id=$request->id;

     	$setimes= \App\SetTime::all();

     	if($setimes->count()>0){
     	 $setimes= SetTime::find($id);
         $setimes->in_time = $request->in_time;
         $setimes->out_time = $request->out_time;
         $setimes->save();

         return redirect('hrm/attendance/manage')->with('message', 'Set Update Successful!');

     	}else{
     	
     	 $setimes= new SetTime;
         $setimes->created_by = Auth::user()->id;
         $setimes->in_time = $request->in_time;
         $setimes->out_time = $request->out_time;
         $setimes->save();

         return redirect('hrm/attendance/manage')->with('message', 'Set Successful!');
         }

     }

    public function attDetails($id){

    	$attendance = Attendance::all()->where('user_id', $id);

    	return view('administrator.hrm.attendance.detailsAttendense', compact('attendance'));
    }



    public function attDetailsReportGo(){

    	$employees = User::whereBetween('access_label', [2, 3])
			->where('deletion_status', 0)
			->select('id', 'name')
			->orderBy('id', 'DESC')
			->get()
			->toArray();
         
    return view('administrator.hrm.attendance.detailsAttendenseReportGo', compact('employees'));
    }



    public function attDetailsReport(Request $request){

    	//return $request->emp_id;
    	$employees = User::whereBetween('access_label', [2, 3])
			->where('deletion_status', 0)
			->select('id', 'name')
			->orderBy('id', 'DESC')
			->get()
			->toArray();

		$empid= $request->emp_id;
		$daterange= $request->daterange;


		// if($request->daterange=='' or $request->emp_id==0){
		if($request->daterange==''){
			return redirect('/hrm/attendance/details/report/go')->with('exception', 'Please select the Date Range');
		}else{
			$empid= $request->emp_id;
			$dates = explode(' - ', $request->daterange);

			$date1 = $dates[0];
			$date2 = $dates[1];
	
			$startdate = date("Y-m-d", strtotime($date1));
			$enddate = date("Y-m-d", strtotime($date2));

			if($empid != 0){
				// $attendance = DB::table('attendances')->whereBetween('attendance_date', [$startdate, $enddate])->where('user_id', $empid)->get(['attendances.*','(shift_in-check_in)/100 as diff_in','(shift_out-check_out)/100 as diff_out']);
				//->select('attendances.*', 'users.*', DB::raw('(shift_in - check_in) / 100 as diff_in'), DB::raw('(shift_out - check_out) / 100 as diff_out'))
				$attendance = DB::table('attendances')
				->join('users', 'attendances.user_id', '=', 'users.id')
				->whereBetween('attendance_date', [$startdate, $enddate])
				->where('user_id', $empid)
				->select('attendances.*', 'users.*')
				->get();
				$attds=  DB::table('attendances')->where('attendance_status', 1)->where('user_id', $empid)->whereBetween('attendance_date', [$startdate, $enddate])->get();
				$abs=  DB::table('attendances')->where('attendance_status', 0)->where('user_id', $empid)->whereBetween('attendance_date', [$startdate, $enddate])->get();
			} else {
				// $attendance = DB::table('attendances')->whereBetween('attendance_date', [$startdate, $enddate])->orderBY('user_id', 'ASC')->orderBY('Attendance_date', 'DESC')->get(['attendances.*',"('shift_in'-'check_in')/100 as diff_in","('shift_out'-'check_out')/100 as diff_out"]);
				//->select('attendances.*', 'users.*', DB::raw('(shift_in - check_in) / 100 as diff_in'), DB::raw('(shift_out - check_out) / 100 as diff_out'))
				$attendance = DB::table('attendances')
				->select('attendances.*', 'users.*')
				->join('users', 'attendances.user_id', '=', 'users.id')
				->whereBetween('attendance_date', [$startdate, $enddate])
				->orderBy('user_id', 'ASC')
				->orderBy('attendance_date', 'DESC')
				->get();			
				$attds=  DB::table('attendances')->where('attendance_status', 1)->whereBetween('attendance_date', [$startdate, $enddate])->orderBY('user_id', 'ASC')->orderBY('Attendance_date', 'DESC')->get();
				$abs=  DB::table('attendances')->where('attendance_status', 0)->whereBetween('attendance_date', [$startdate, $enddate])->orderBY('user_id', 'ASC')->orderBY('Attendance_date', 'DESC')->get();
			}

			return view('administrator.hrm.attendance.detailsAttendenseReport', compact('attendance', 'startdate', 'enddate', 'empid', 'attds', 'abs', 'employees', 'date1', 'date2'));
    	}
}


public function attDetailsReportPdf(Request $request){

 
	$empid= $request->emp_id;

	$startdate= $request->date1;
    $enddate= $request->date2;

	$attendance = DB::table('attendances')->whereBetween('attendance_date', [$startdate, $enddate])->where('user_id', $empid)->get();

	$attds=  DB::table('attendances')->where('attendance_status', 1)->where('user_id', $empid)->whereBetween('attendance_date', [$startdate, $enddate])->get();

	$abs=  DB::table('attendances')->where('attendance_status', 0)->where('user_id', $empid)->whereBetween('attendance_date', [$startdate, $enddate])->get();


    $pdf=PDF::loadView('administrator.hrm.attendance.detailsAttendenseReportPdf', compact('attendance', 'startdate', 'enddate', 'empid', 'attds', 'abs'));
	
	return $pdf->download('AttendenceStatement.pdf');

}
}
