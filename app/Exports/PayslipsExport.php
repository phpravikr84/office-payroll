<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Collection;

class PayslipsExport implements FromCollection, WithHeadings, WithEvents
{
    protected $payslips;
    protected $month;
    protected $payPeriodStart;
    protected $payPeriodEnd;
    protected $companyInfo; // New property for dynamic company info

    public function __construct($payslips, $month, $payPeriodStart, $payPeriodEnd, $companyInfo)
    {
        $this->payslips = $payslips;
        $this->month = $month;
        $this->payPeriodStart = $payPeriodStart;
        $this->payPeriodEnd = $payPeriodEnd;
        $this->companyInfo = $companyInfo; // Assign dynamic company info
    }

    public function collection()
    {
        return new Collection($this->payslips);
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Pay Period Start',
            'Pay Period End',
            'Total Working Days',
            'Salary Calculated (before deductions)',
            'Sandwitch Leave',
            'Unpaid Leave',
            'Late Deduction',
            'Taxable Income',
            'Total Benefits',
            'Dependent',
            'Dependent Rebate',
            'Net Tax',
            'Loan Installment',
            'Superannuation Name (if any)',
            'Employee Contribution Amount',
            'Employer Contribution Amount',
            'Net Payable',
            'Bank Name',
            'Bank Account No',
            'Bank Code',
            'IFSC Code',
            'SWIFT Code',
            'Account Holder Name',
            'Address',
            'City',
            'State',
            'Branch Name',
            'Email Address',
            'Country Code',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set Company Name and Address on the left-hand side
                $event->sheet->setCellValue('A1', $this->companyInfo['company_bank_name'] ?? '');
                $event->sheet->setCellValue('A2', $this->companyInfo['company_bank_address'] ?? '');
                $event->sheet->setCellValue('A3', $this->companyInfo['company_bank_phone'] ?? '');
                $event->sheet->setCellValue('A4', $this->companyInfo['company_bank_email'] ?? '');

                $event->sheet->setCellValue('A5', $this->companyInfo['company_bank_detail_code'] ?? '');
                $event->sheet->setCellValue('A6', $this->companyInfo['company_bank_bsp_number'] ?? '');

                $event->sheet->setCellValue('A7', $this->companyInfo['company_bank_account_no'] ?? '');
                $event->sheet->setCellValue('A8', $this->companyInfo['company_bank_transaction_fee'] ?? '');
    
                // Format the company name
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => ['horizontal' => 'left'],
                ]);

                // Set Salary Month of Pay Period
                $event->sheet->setCellValue('A8', "Salary Month of: " . $this->month);
                $event->sheet->mergeCells('A8:B8');
                $event->sheet->getStyle('A8')->getFont()->setSize(12);

                // Format the headers for employee data
                $headerRange = 'A1:x1';
                $event->sheet->getStyle($headerRange)->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => 'center'],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFFF00'], // Yellow background
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Employer Bank details at the bottom
                $rowCount = count($this->payslips) + 1; // Adjust based on the row structure
                $event->sheet->setCellValue('A' . ($rowCount + 1), 'Employer Bank Name: Kina Bank');
                $event->sheet->setCellValue('A' . ($rowCount + 2), 'Account No: 1125869936');
                $event->sheet->setCellValue('A' . ($rowCount + 3), 'Swift Code: 258963');

                // Adjust column widths for better visibility
                foreach (range('A', 'X') as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
