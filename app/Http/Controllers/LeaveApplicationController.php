<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveManagement;
use App\Models\LeaveCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        if(Auth::user()->access_label==1){

            $employees = User::query()
                ->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
                ->orderBy('users.name', 'ASC')
                ->where('users.access_label', '>=', 2)
                ->where('users.access_label', '<=', 3)
                ->get(['designations.designation', 'users.name', 'users.id'])
                ->toArray();
          

            $leaveApplications = DB::table('leave_managements')->join('leave_categories', function($join) {
                $join->on('leave_categories.id', '=', 'leave_managements.leave_category_id');
            })
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'leave_managements.user_id');
            })
            ->where('leave_categories.publication_status', '!=', 0)
            ->select('leave_managements.*', 'users.name', 'leave_categories.leave_category')
            ->get();
            //dd($leaveApplications);

        } else {

            $employees = User::query()
                ->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
                ->orderBy('users.name', 'ASC')
                ->where('users.access_label', '>=', 2)
                ->where('users.access_label', '<=', 3)
                ->where('users.id', Auth::user()->id)
                ->get(['designations.designation', 'users.name', 'users.id'])
                ->toArray();

            $leaveApplications = DB::table('leave_managements')->join('leave_categories', function($join) {
                $join->on('leave_categories.id', '=', 'leave_managements.leave_category_id');
            })
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'leave_managements.user_id');
            })
            ->where('leave_managements.user_id', Auth::user()->id)
            ->where('leave_categories.publication_status', '!=', 0)
            ->select('leave_managements.*', 'users.name', 'leave_categories.leave_category')
            ->get();

        }
        

        return view('administrator.hrm.leave.index', compact('leaveApplications', 'employees'));
    }
   
    public function create()
    {
        if(Auth::user()->access_label==1){
        $employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();
        } else{
            $employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
            ->where('users.id', Auth::user()->id)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();
        }
        $leaveCategories = LeaveCategory::where('publication_status', 1)->get();

        return view('administrator.hrm.leave.create', compact('leaveCategories', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'leave_category_id' => 'required|exists:leave_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        $leaveCategory = LeaveCategory::findOrFail($request->leave_category_id);

        // Calculate the number of leave days
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $interval = $startDate->diff($endDate);
        $daysRequested = $interval->days + 1; // Include the start date

        // Calculate monthly leave entitlement
        $monthlyLeaveEntitlement = $leaveCategory->qty / 12;

        // Calculate loss of pay days
        $lossOfPayDays = $request->loss_of_pay_days;
 

        LeaveManagement::create([
            'user_id' => $request->user_id,
            'leave_category_id' => $request->leave_category_id,
            'leave_type' => $leaveCategory->leave_category,
            'leave_option' =>$request->leave_duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'loss_of_pay_days' => $lossOfPayDays,
            'is_sandwich_leave' => $request->is_sandwich_leave,
            'sandwich_leave_days' => $request->sandwich_leave_days,
            'holiday_count' => $request->holiday_count,
            'pending_leave' => $request->pending_leave,
            'leave_applied_days' => $request->leave_applied_days,
            'status' => 0, // Pending
            'applied_by' => $request->user_id,
        ]);

        return redirect()->route('leave.index')->with('success', 'Leave application submitted successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3', // 0: pending, 1: approved, 2: canceled, 3: rejected
        ]);

        $leaveApplication = LeaveManagement::findOrFail($id);
        $leaveApplication->status = $request->status;
        $leaveApplication->save();

        return redirect()->route('leave.index')->with('success', 'Leave status updated successfully.');
    }

    // public function calculateLeave(Request $request)
    // {
    //     $leaveCategoryId = $request->get('leave_category_id');
    //     $startDate = $request->get('start_date');
    //     $endDate = $request->get('end_date');

    
    //     $leaveCategory = LeaveCategory::find($leaveCategoryId);
    //     if (!$leaveCategory) {
    //         return response()->json(['error' => 'Leave category not found'], 404);
    //     }
    //     if($leaveCategory->id===2 && $request->get('leave_duration')){

    //         $totalLeavePerYear = $leaveCategory->qty; // Total annual leave
    //         $leavePerMonth = $totalLeavePerYear / 12;
        
    //         $startDate = Carbon::parse($startDate);
    //         $endDate = Carbon::parse($endDate);
    //         $diffInDays = $endDate->diffInDays($startDate) + 1; // Include the end date

    //         if($diffInDays > $request->get('leave_duration')){
    //               // Calculations
    //             $totalLeaveDays = $diffInDays - $request->get('leave_duration');
            
    //             $pendingLeave = $totalLeavePerYear - $totalLeaveDays;
    //             $lossOfPayDays = $totalLeaveDays > $leavePerMonth ? $totalLeaveDays - $leavePerMonth : 0;
            

    //         } else {

    //                 // Calculations
    //             $totalLeaveDays = $diffInDays;
            
    //             $pendingLeave = $totalLeavePerYear - $totalLeaveDays;
    //             $lossOfPayDays = $totalLeaveDays > $leavePerMonth ? $totalLeaveDays - $leavePerMonth : 0;
            
    //         }
        
          

    //     } else {
    //         $totalLeavePerYear = $leaveCategory->qty; // Total annual leave
    //         $leavePerMonth = $totalLeavePerYear / 12;
        
    //         $startDate = Carbon::parse($startDate);
    //         $endDate = Carbon::parse($endDate);
    //         $diffInDays = $endDate->diffInDays($startDate) + 1; // Include the end date
        
    //         // Calculations
    //         $totalLeaveDays = $diffInDays;
        
    //         $pendingLeave = $totalLeavePerYear - $totalLeaveDays;
    //         $lossOfPayDays = $totalLeaveDays > $leavePerMonth ? $totalLeaveDays - $leavePerMonth : 0;
        
    //     }
    
      
    //     return response()->json([
    //         'pending_leave' => max(round($pendingLeave, 1), 0),
    //         'loss_of_pay_days' => round($lossOfPayDays, 1),
    //     ]);
    // }

    // public function calculateLeave(Request $request)
    // {
    //     $userId = $request->get('user_id');
    //     $leaveCategoryId = $request->get('leave_category_id');
    //     $startDate = $request->get('start_date');
    //     $endDate = $request->get('end_date');
    //     $leaveDuration = $request->get('leave_duration'); // No default value

    //     $leaveCategory = LeaveCategory::find($leaveCategoryId);
    //     if (!$leaveCategory) {
    //         return response()->json(['error' => 'Leave category not found'], 404);
    //     }

    //     // Check total leave per year if not exist in the table leave_managements
    //     // Get total leave per year from leave_categories table
    //     $totalLeavePerYear = $leaveCategory->qty;

    //     // Get total leave taken by user from leave_managements
    //     $leaveTaken = DB::table('leave_managements')
    //         ->where('user_id', $userId)
    //         ->where('leave_category_id', $leaveCategoryId)
    //         ->sum('leave_applied_days');

    //         // Calculate pending leave and ensure it's not negative
    //         $pendingLeave = max($totalLeavePerYear - $leaveTaken, 0);

    //     $leavePerMonth = $totalLeavePerYear / 12;

    //     $startDate = Carbon::parse($startDate);
    //     $endDate = Carbon::parse($endDate);
    //     $diffInDays = $endDate->diffInDays($startDate) + 1; // Include the end date

    //     if ($leaveCategoryId == 2 && $leaveDuration) {
    //         $leaveDuration = $leaveDuration == 1 ? 0 : $leaveDuration;
           
    //         // Adjust the leave days based on leave duration
    //         $totalLeaveDays = $diffInDays - $leaveDuration;

    //          //Check Any pending leave
    //          if( $pendingLeave != 0) {
    //             // echo 'total leave per year'.$totalLeavePerYear.'<br/>';
    //             // echo 'leave taken'. $leaveTaken.'<br/>';
    //             // echo 'pending leave'.$pendingLeave.'<br/>';
    //               // Loss of pay days are determined if total leave exceeds allocated leave
    //             $lossOfPayDays = $totalLeaveDays > $leavePerMonth ? $totalLeaveDays - round($leavePerMonth) : 0;
    //         } else {
              
    //               // Loss of pay days are determined if total leave exceeds allocated leave
    //             $lossOfPayDays = $totalLeaveDays;
    //         }

          
    //     } else {
    //         $totalLeaveDays = $diffInDays;
    //         if( $pendingLeave != 0) {
    //         $lossOfPayDays = $totalLeaveDays > $leavePerMonth ? $totalLeaveDays - round($leavePerMonth) : 0;
    //         } else {
    //             $lossOfPayDays = $totalLeaveDays;
    //         }
    //     }

    //     // Update pending leave after calculating leave
    //     $pendingLeave -= $totalLeaveDays;



    //     return response()->json([
    //         'pending_leave' => max(round($pendingLeave, 2), 0),
    //         'loss_of_pay_days' => round($lossOfPayDays, 2),
    //         'leave_applied_days' => round($totalLeaveDays, 2)
    //     ]);
    // }

    // public function calculateLeave(Request $request)
    // {
    //     $userId = $request->get('user_id');
    //     $leaveCategoryId = $request->get('leave_category_id');
    //     $startDate = $request->get('start_date');
    //     $endDate = $request->get('end_date');
    //     $leaveDuration = $request->get('leave_duration'); // No default value

    //     $leaveCategory = LeaveCategory::find($leaveCategoryId);
    //     if (!$leaveCategory) {
    //         return response()->json(['error' => 'Leave category not found'], 404);
    //     }

    //     // Check total leave per year if not exist in the table leave_managements
    //     // Get total leave per year from leave_categories table
    //     $totalLeavePerYear = $leaveCategory->qty;

    //     // Get total leave taken by user from leave_managements
    //     $leaveTaken = DB::table('leave_managements')
    //         ->where('user_id', $userId)
    //         ->where('leave_category_id', $leaveCategoryId)
    //         ->sum('leave_applied_days');

    //     // Calculate pending leave and ensure it's not negative
    //     $pendingLeave = max($totalLeavePerYear - $leaveTaken, 0);

    //     $leavePerMonth = $totalLeavePerYear / 12;

    //     $startDate = Carbon::parse($startDate);
    //     $endDate = Carbon::parse($endDate);
    //     $diffInDays = $endDate->diffInDays($startDate) + 1; // Include the end date

    //     // Fetch all holidays in the range
    //     $holidays = DB::table('holidays')
    //         ->where('publication_status', 1)
    //         ->whereBetween('date', [$startDate, $endDate])
    //         ->pluck('date')
    //         ->toArray();

    //     // Calculate leave days considering Sandwich policy
    //     $totalLeaveDays = 0;
    //     for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
    //         $dayOfWeek = $date->dayOfWeek;
    //         $isWeekend = ($dayOfWeek == Carbon::SATURDAY || $dayOfWeek == Carbon::SUNDAY);
    //         $isHoliday = in_array($date->toDateString(), $holidays);

    //         if ($isWeekend || $isHoliday) {
    //             // Check if this is a sandwich day
    //             if (
    //                 ($date->copy()->subDay()->isWeekday() && $date->copy()->addDay()->isWeekday()) ||
    //                 (in_array($date->copy()->subDay()->toDateString(), $holidays) && in_array($date->copy()->addDay()->toDateString(), $holidays))
    //             ) {
    //                 // Add sandwich days
    //                 $totalLeaveDays++;
    //             }
    //         } else {
    //             // Regular leave day
    //             $totalLeaveDays++;
    //         }
    //     }

    //     // Adjust the leave days based on leave duration
    //     if ($leaveCategoryId == 2 && $leaveDuration) {
    //         $leaveDuration = $leaveDuration == 1 ? 0 : $leaveDuration;
    //         $totalLeaveDays -= $leaveDuration;
    //     }

    //     // Loss of pay days calculation
    //     if ($pendingLeave != 0) {
    //         // Loss of pay days are determined if total leave exceeds allocated leave
    //         $lossOfPayDays = $totalLeaveDays > $pendingLeave ? $totalLeaveDays - $pendingLeave : 0;
    //     } else {
    //         $lossOfPayDays = $totalLeaveDays;
    //     }

    //     // Update pending leave after calculating leave
    //     $pendingLeave -= $totalLeaveDays;

    //     return response()->json([
    //         'pending_leave' => max(round($pendingLeave, 2), 0),
    //         'loss_of_pay_days' => round($lossOfPayDays, 2),
    //         'leave_applied_days' => round($totalLeaveDays, 2)
    //     ]);
    // }
    
    //     public function calculateLeave(Request $request)
    // {
    //     $userId = $request->get('user_id');
    //     $leaveCategoryId = $request->get('leave_category_id');
    //     $startDate = Carbon::parse($request->get('start_date'));
    //     $endDate = Carbon::parse($request->get('end_date'));
    //     $leaveDuration = $request->get('leave_duration'); // No default value

    //     $leaveCategory = LeaveCategory::find($leaveCategoryId);
    //     if (!$leaveCategory) {
    //         return response()->json(['error' => 'Leave category not found'], 404);
    //     }

    //     $totalLeavePerYear = $leaveCategory->qty;
    //     $leaveTaken = DB::table('leave_managements')
    //         ->where('user_id', $userId)
    //         ->where('leave_category_id', $leaveCategoryId)
    //         ->sum('leave_applied_days');

    //     $pendingLeave = max($totalLeavePerYear - $leaveTaken, 0);

    //     // Fetch all holidays in the range
    //     $holidays = DB::table('holidays')
    //         ->where('publication_status', 1)
    //         ->select('date')
    //         ->get()->toArray();

    //     // Initialize total leave days
    //     $totalLeaveDays = 0;
    //     $sandwichLeaveDays = 0;

    //     // Calculate leave days considering Sandwich policy
    //     for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
    //         $dayOfWeek = $date->dayOfWeek;
    //         $isWeekend = ($dayOfWeek == Carbon::SATURDAY || $dayOfWeek == Carbon::SUNDAY);
    //         $isHoliday = in_array($date->toDateString(), $holidays);
    //         $isLeaveDay = $startDate->diffInDays($date) == 0 || $endDate->diffInDays($date) == 0;

    //         // Check if it's a working day
    //         $isWorkingDay = !$isWeekend && !$isHoliday;

    //         if ($isLeaveDay || $isHoliday || $isWeekend) {
    //             $prevDay = $date->copy()->subDay();
    //             $nextDay = $date->copy()->addDay();

    //             $prevIsLeaveOrHoliday = ($prevDay->isWeekday() && in_array($prevDay->toDateString(), $holidays)) || $prevDay->isWeekday() && !$prevDay->isWeekend();
    //             $nextIsLeaveOrHoliday = ($nextDay->isWeekday() && in_array($nextDay->toDateString(), $holidays)) || $nextDay->isWeekday() && !$nextDay->isWeekend();

    //             // Check if the day is sandwiched between leave days or holidays
    //             if ($isWeekend && $prevIsLeaveOrHoliday && $nextIsLeaveOrHoliday) {
    //                 $sandwichLeaveDays++;
    //             } elseif ($isWorkingDay) {
    //                 $totalLeaveDays++;
    //             }
    //         }
    //     }

    //     // Add sandwich days to total leave days
    //     $totalLeaveDays += $sandwichLeaveDays;

    //     // Handle specific leave category duration logic
    //     if ($leaveCategoryId == 2 && $leaveDuration) {
    //         $leaveDuration = $leaveDuration == 1 ? 0 : $leaveDuration;
    //         $totalLeaveDays -= $leaveDuration;
    //     }

    //     // Loss of pay days calculation
    //     $lossOfPayDays = $totalLeaveDays > $pendingLeave ? $totalLeaveDays - $pendingLeave : 0;

    //     // Update pending leave after calculating leave
    //     $pendingLeave = max($pendingLeave - $totalLeaveDays, 0);

    //     return response()->json([
    //         'pending_leave' => max(round($pendingLeave, 2), 0),
    //         'loss_of_pay_days' => round($lossOfPayDays, 2),
    //         'leave_applied_days' => round($totalLeaveDays, 2),
    //         'sandwich_leave_days' => round($sandwichLeaveDays, 2)
    //     ]);
    // }

    public function calculateLeave(Request $request)
    {
        $userId = $request->get('user_id');
        $leaveCategoryId = $request->get('leave_category_id');
        $startDate = Carbon::parse($request->get('start_date'));
        $endDate = Carbon::parse($request->get('end_date'));
        $leaveDuration = $request->get('leave_duration'); // No default value
    
        $leaveCategory = LeaveCategory::find($leaveCategoryId);
        if (!$leaveCategory) {
            return response()->json(['error' => 'Leave category not found'], 404);
        }
    
        $totalLeavePerYear = $leaveCategory->qty;
        $leaveTaken = DB::table('leave_managements')
            ->where('user_id', $userId)
            ->where('leave_category_id', $leaveCategoryId)
            ->sum('leave_applied_days');
    
        $pendingLeave = max($totalLeavePerYear - $leaveTaken, 0);
        $leavePerMonth = $totalLeavePerYear / 12; // Monthly leave allocation
    
        // Fetch all holidays as an array of date strings
        $holidays = DB::table('holidays')
            ->where('publication_status', 1)
            ->pluck('date')
            ->map(function($date) {
                return Carbon::parse($date)->toDateString();
            })
            ->toArray();
    
        $totalLeaveDays = 0;
        $sandwichLeaveDays = 0;
        $holidayCount = 0;
        $isSandwich = false;
    
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dayOfWeek = $date->dayOfWeek;
            $isWeekend = ($dayOfWeek == Carbon::SATURDAY || $dayOfWeek == Carbon::SUNDAY);
            $isHoliday = in_array($date->toDateString(), $holidays);
    
            if ($isHoliday) {
                $holidayCount++;
            }
    
            if ($isWeekend || $isHoliday) {
                $prevDay = $date->copy()->subDay();
                $nextDay = $date->copy()->addDay();
    
                $prevIsLeaveOrHoliday = (
                    !$prevDay->isWeekend() &&
                    (in_array($prevDay->toDateString(), $holidays) || $prevDay->between($startDate, $endDate))
                );
    
                $nextIsLeaveOrHoliday = (
                    !$nextDay->isWeekend() &&
                    (in_array($nextDay->toDateString(), $holidays) || $nextDay->between($startDate, $endDate))
                );
    
                if ($prevIsLeaveOrHoliday || $nextIsLeaveOrHoliday) {
                    $isSandwich = true;
                }
    
                $sandwichLeaveDays++;
            } else {
                $totalLeaveDays++;
            }
        }
    
        if ($isSandwich) {
            $totalLeaveDays = $endDate->diffInDays($startDate) + 1;
        } else {
            $totalLeaveDays += $holidayCount;
        }
    
        if ($leaveCategoryId == 2 && $leaveDuration) {
            $leaveDuration = $leaveDuration == 1 ? 0 : $leaveDuration;
            $totalLeaveDays -= $leaveDuration;
        }
    
        // Calculate loss of pay days considering monthly leave allowance
        $appliedMonth = $startDate->month;
        $allowedLeaveForMonth = $leavePerMonth;
        $leaveUsedForMonth = DB::table('leave_managements')
            ->where('user_id', $userId)
            ->where('leave_category_id', $leaveCategoryId)
            ->whereMonth('start_date', $appliedMonth)
            ->sum('leave_applied_days');
    
        $availableLeaveForMonth = $allowedLeaveForMonth - $leaveUsedForMonth;
        $payLossLeaves = max($totalLeaveDays - $availableLeaveForMonth, 0);

         // Round the loss of pay days as per your requirement
        $roundedLossOfPayDays = ($payLossLeaves - floor($payLossLeaves) >= 0.5) 
        ? ceil($payLossLeaves) 
        : floor($payLossLeaves);
        
        // Adjust pending leave considering total yearly allowance
        $pendingLeave = max($pendingLeave - $totalLeaveDays, 0);
    
        return response()->json([
            'pending_leave' => max(round($pendingLeave, 2), 0),
            'loss_of_pay_days' => round($roundedLossOfPayDays, 2),
            'leave_applied_days' => round($totalLeaveDays, 2),
            'is_sandwich_leave' => $isSandwich,
            'sandwich_leave_days' => round($sandwichLeaveDays, 2),
            'holiday_count' => $holidayCount
        ]);
    }
    





    public function getTakenDates(Request $request, $id)
    {

        $user_id = $request->query('user_id');
        $leaveDates = LeaveManagement::where('user_id', $user_id)
            ->select('start_date', 'end_date')
            ->get();

        // Format the data to be an array of objects with start and end dates
        $dates = $leaveDates->map(function($leave) {
            return [
                'start_date' => Carbon::parse($leave->start_date)->format('Y-m-d'),
                'end_date' => Carbon::parse($leave->end_date)->format('Y-m-d'),
            ];
        })->toArray();

        return response()->json(['dates' => $dates]);
    }


    // Show the edit form for changing status
    public function edit($id)
    {
        $leave = LeaveManagement::findOrFail($id);
        $employees = User::query()
        ->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
        ->orderBy('users.name', 'ASC')
        ->where('users.access_label', '>=', 2)
        ->where('users.access_label', '<=', 3)
        ->where('users.id', $leave->user_id)
        ->get(['designations.designation', 'users.name', 'users.id'])
        ->toArray();
        $leaveCategories = LeaveCategory::where('publication_status', 1)->get();
        return view('administrator.hrm.leave.edit', compact('leave', 'employees', 'leaveCategories'));
    }

    // Update the leave status
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3',
            'message' => 'nullable|string',
        ]);
        

        $leave = LeaveManagement::findOrFail($id);
        $leaveCategory = LeaveCategory::find($leave->leave_category_id);

        if (!$leaveCategory) {
            return response()->json(['error' => 'Leave category not found'], 404);
        }

        // Update leave status based on selection
        if ($request->status == 1) {
            // Approved
            $leave->status = 1;
            $leave->leave_cancel_days = null;
            $leave->leave_disapprove_days = null;
        } elseif ($request->status == 2) {
            // Disapprove
            $leave->status = 2;
            $leave->leave_cancel_days = null;
            $leave->leave_disapprove_days = $leave->leave_applied_days;

            if (auth()->user()->id == $leave->user_id || auth()->user()->user_type == 1) {
                $leave->status = 2;
            }
            
            // Additional logic for disapprove
            if ($leave->leave_disapprove_days !== null) {
                // Deduct disapprove days from pending leave
                $leave->pending_leave = max($leave->pending_leave - $leave->leave_disapprove_days, 0);
                
                // Update loss of pay days if needed
                if ($leave->loss_of_pay_days < $leave->leave_disapprove_days) {
                    $leave->loss_of_pay_days = $leave->leave_disapprove_days;
                }
            }
        } elseif ($request->status == 3) {
            // Cancel
            $leave->status = 3;
            $leave->leave_cancel_days = $leave->leave_applied_days;
            $leave->leave_disapprove_days = null;

            if (auth()->user()->id == $leave->user_id || auth()->user()->user_type == 1) {
                $leave->status = 3;
            }

            // Additional logic for cancel
            if ($leave->leave_cancel_days !== null) {
                $new_pending_leave = $leave->pending_leave + $leave->leave_cancel_days;

                // Check if pending_leave should be adjusted
                if ($leave->leave_applied_days >= $leaveCategory->qty) {
                    // Adjust pending_leave if it exceeds the leave category qty
                    $leave->pending_leave = max($leave->pending_leave - $leave->leave_cancel_days, 0);
                } else {
                    $leave->pending_leave = min($new_pending_leave, $leaveCategory->qty);
                }
                
                // Set loss_of_pay_days to 0 for canceled leaves
                $leave->loss_of_pay_days = 0;
            }
        } elseif ($request->status == 0) {
            // Pending or initial state
            $leave->status = 0;
            $leave->leave_cancel_days = null;
            $leave->leave_disapprove_days = null;
        }

        // Ensure pending_leave does not exceed the leave category quantity
        $leave->pending_leave = min($leave->pending_leave, $leaveCategory->qty);

        $leave->message = $request->message;
        $leave->applied_by =  $leave->user_id;
        $leave->authorize_by =  auth()->user()->id;
        $leave->save();

        return redirect()->route('leave.index')->with('success', __('Leave status updated successfully.'));
    }



}
