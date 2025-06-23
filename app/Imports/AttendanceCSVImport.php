<?php

namespace App\Imports;

use App\Models\AttendanceRecord; // Ensure to import your model correctly
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class AttendanceCSVImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Convert time formats if necessary
        $checkInTime = Carbon::createFromFormat('g:i A', trim($row['check_in_time']));
        $checkOutTime = Carbon::createFromFormat('g:i A', trim($row['check_out_time']));
        $formattedDate = Carbon::createFromFormat('Y-m-d', trim($row['date']));

        // Check if a record already exists for the employee on that date
        $existingRecord = AttendanceRecord::where('employee_id', $row['employee_id'])
            ->where('department', $row['department'])
            ->where('date', $formattedDate)
            ->first();

        // If a record exists, delete it
        if ($existingRecord) {
            $existingRecord->delete();
        }

        // Return the new AttendanceRecord instance
        return new AttendanceRecord([
            'employee_id' => $row['employee_id'],
            'employee_name' => $row['employee_name'],
            'department' => $row['department'],
            'date' => $formattedDate,
            'in_time' => $checkInTime->format('g:i A'),
            'out_time' => $checkOutTime->format('g:i A'),
            'work_time' => $checkInTime->diff($checkOutTime)->format('%h hrs %i mins'),
            'overtime_hours' => $row['overtime_hours'],
            'attendance_status' => $row['attendance_status'],
            'late' => $this->calculateLate($checkInTime),
            'early' => $this->calculateEarly($checkOutTime),
            'remarks' => $row['remarks'] ?? '-',
        ]);
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required|string',
            'check_in_time' => 'required|string',
            'check_out_time' => 'required|string',
            'date' => 'required',
            // Add any other validation rules needed
        ];
    }

    private function calculateLate($checkInTime)
    {
        // Your existing late calculation logic
    }

    private function calculateEarly($checkOutTime)
    {
        // Your existing early calculation logic
    }
}
