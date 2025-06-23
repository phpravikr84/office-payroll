<?php

namespace App\Imports;

use App\AttendanceRecord; // Import your model
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PHPExcel_Shared_Date;
use Carbon\Carbon;

class AttendanceImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        // Shift times
        $shiftInTime = Carbon::createFromTime(9, 0, 0); // Shift starts at 9:00 AM
        $shiftOutTime = Carbon::createFromTime(18, 0, 0); // Shift ends at 6:00 PM

        // Convert Excel date to Carbon instance
        // Check if the date is numeric (Excel's serial date format)
        if (is_numeric($row['date'])) {
            // Check if the Excel date is valid and handle the conversion manually
            $excelDate = (int)$row['date'];
            
            if ($excelDate > 0) {
                // Calculate the PHP timestamp from the Excel serial date
                $timestamp = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelDate)->getTimestamp();
                $formattedDate = Carbon::createFromTimestamp($timestamp)->format('Y-m-d');
            } else {
                // Log invalid date
                \Log::error('Invalid Excel date number: ' . $row['date']);
                $formattedDate = null;
            }
        } else {
            // Handle date in d/m/Y format (common in Excel)
            try {
                $formattedDate = Carbon::createFromFormat('d/m/Y', $row['date'])->format('Y-m-d');
            } catch (\Exception $e) {
                \Log::error('Error parsing date: ' . $row['date'] . '. Error: ' . $e->getMessage());
                $formattedDate = null;
            }
        }

        // Convert check-in and check-out time fractions to Carbon instances
        $checkInTime = $this->convertExcelTimeToCarbon($row['check_in_time']);
        $checkOutTime = $this->convertExcelTimeToCarbon($row['check_out_time']);
        // Calculate work hours if check-in and check-out times are valid
        if ($checkInTime && $checkOutTime) {
            // Parse the times as Carbon instances for correct time difference calculation
            $checkInTimeObj = Carbon::createFromFormat('g:i A', $checkInTime);
            $checkOutTimeObj = Carbon::createFromFormat('g:i A', $checkOutTime);

            // Calculate the time difference
            $timeDiff = $checkInTimeObj->diff($checkOutTimeObj);
            $workHours = $timeDiff->format('%h hrs %i mins');
        } else {
            $workHours = 'N/A'; // If invalid or null times
        }

        //Return with proper data
        $data = [
            'employee_id' => $row['employee_id'],
            'employee_name' => $row['employee_name'],
            'department' => $row['department'],
            'date' => $formattedDate, // Date in 'Y-m-d' format
            'in_time' => $checkInTime ? Carbon::createFromFormat('g:i A', $checkInTime)->format('H:i:s') : null,
                'out_time' => $checkOutTime ? Carbon::createFromFormat('g:i A', $checkOutTime)->format('H:i:s') : null,
            'work_time' => $workHours,
            'overtime_hours' => $row['overtime_hours'], // Assuming overtime is already calculated in the file
            'attendance_status' => $row['attendance_status'],
            'late' => $this->calculateLate($checkInTime), // Late in minutes
            'early' => $this->calculateEarly($checkOutTime), // Early in minutes
            'remarks' => $row['remarks'] ?? '-',
        ];

        return $data;
    }

    /**
     * Convert Excel time to Carbon instance
     */
    private function convertExcelTimeToCarbon($excelTime)
    {
        if (is_numeric($excelTime)) {
            // Excel time is represented as a fraction of a day
        $timeInSeconds = $excelTime * 86400; // Convert fraction of a day into seconds

        // Create a DateTime instance from the seconds since midnight
        $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelTime);

        // Return the time in "H:i A" (e.g., 10:00 AM) format, without any timezone changes
        return $dateTime->format('g:i A'); // Or 'H:i' for 24-hour format
        } else {
            \Log::error('Invalid time: ' . $excelTime);
            return null; // Handle invalid time accordingly
        }
    }

    

    /**
     * Calculate Late
     */
    private function calculateLate($checkInTime)
    {
        // Trim whitespace from the time strings
        $checkInTime = trim($checkInTime);
        
        // Create the shift in time using the correct format
        $shiftInTime = Carbon::createFromFormat('g:i A', '9:00 AM');

        try {
            // Parse the check-in time, ensuring it is trimmed
            $checkIn = Carbon::createFromFormat('g:i A', $checkInTime);

            // Debugging output
            \Log::info("Check In Time: " . $checkIn->toTimeString());
            \Log::info("Shift In Time: " . $shiftInTime->toTimeString());

            // Check if checkIn is after the shiftIn
            if ($checkIn->gt($shiftInTime)) {
                $lateMinutes = $checkIn->diffInMinutes($shiftInTime);
                \Log::info("Late Minutes: " . $lateMinutes);
                return $lateMinutes; // Calculate how many minutes they checked in late
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error("Error parsing time: " . $checkInTime . ". Error: " . $e->getMessage());
            return 0; // Return 0 if there was an error
        }
        
        return 0; // No late check-in if checkIn is before or on time
    }

    /**
     * Calculate Early
     */
    private function calculateEarly($checkOutTime)
    {
        // Trim whitespace from the time strings
        $checkOutTime = trim($checkOutTime);
        
        // Create the shift out time using the correct format
        $shiftOutTime = Carbon::createFromFormat('g:i A', '5:00 PM');

        try {
            // Parse the check-out time, ensuring it is trimmed
            $checkOut = Carbon::createFromFormat('g:i A', $checkOutTime);

            // Debugging output
            \Log::info("Check Out Time: " . $checkOut->toTimeString());
            \Log::info("Shift Out Time: " . $shiftOutTime->toTimeString());

            // Check if checkOut is before the shiftOut
            if ($checkOut->lt($shiftOutTime)) {
                $earlyMinutes = $shiftOutTime->diffInMinutes($checkOut);
                \Log::info("Early Minutes: " . $earlyMinutes);
                return $earlyMinutes; // Calculate how many minutes they left early
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error("Error parsing time: " . $checkOutTime . ". Error: " . $e->getMessage());
            return 0; // Return 0 if there was an error
        }
        
        return 0; // No early leave if checkOut is after shiftOut
    }

}
