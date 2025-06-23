<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxResident;
use App\Models\DependentRebate;
use App\Models\Allowance;
use App\Models\HraRate;
use App\Models\HraAreaPlace;
use App\Models\Superannuation;

class SalaryCalculatorController extends Controller
{
    public function index()
    {
        $loca_places = HraAreaPlace::query()
            ->orderBy('loca_name', 'ASC')
            ->orderBy('places', 'ASC')
            ->get(['id', 'loca_name', 'places']);
        $vehicleTypes = Allowance::all();
        $superannuations = Superannuation::all();
        return view('administrator.dashboard.salary_calculator', compact('vehicleTypes', 'loca_places', 'superannuations'));
    }

    public function calculate(Request $request)
    {
        // Validate inputs
        $request->validate([
            'employee_type' => 'required|in:0',
            'tax_residency' => 'required|in:1,2',
            'basic_salary' => 'required|numeric|min:0',
            'annual_salary' => 'nullable|numeric|min:0',
            'hrly_salary_rate' => 'nullable|numeric|min:0',
            'hr_place' => 'required|exists:hra_area_places,id',
            'hra_type' => 'required|in:1,2,3',
            'hra_amount_per_week' => 'nullable|numeric|min:0',
            'va_type' => 'required|in:1,2,3',
            'meals_tag' => 'nullable|in:1',
            'meals_allowance' => 'nullable|numeric|min:0',
            'medical_allowance' => 'nullable|numeric|min:0',
            'special_allowance' => 'nullable|numeric|min:0',
            'other_allowance' => 'nullable|numeric|min:0',
            'electricity_allowance' => 'nullable|numeric|min:0',
            'security_allowance' => 'nullable|numeric|min:0',
            'no_of_dependent_frm' => 'required|integer|min:0|max:5',
            'superannuation_id' => 'required|exists:superannuations,id',
            'provident_fund_deduction' => 'nullable|numeric|min:0',
        ]);

        // Assign and cast values
        $basicSalary = (float) $request->basic_salary;
        $annualSalary = (float) ($request->annual_salary ?? 0);
        $hrlySalaryRate = (float) ($request->hrly_salary_rate ?? 0);
        $residency = (int) $request->tax_residency;
        $hrPlace = (int) $request->hr_place;
        $hraType = (int) $request->hra_type;
        $hraAmountPerWeek = (float) ($request->hra_amount_per_week ?? 0);
        $vaType = (int) $request->va_type;
        $mealsTag = $request->meals_tag ? 1 : 0;
        $mealsAllowance = (float) ($request->meals_allowance ?? 0);
        $medicalAllowance = (float) ($request->medical_allowance ?? 0);
        $specialAllowance = (float) ($request->special_allowance ?? 0);
        $otherAllowance = (float) ($request->other_allowance ?? 0);
        $electricityAllowance = (float) ($request->electricity_allowance ?? 0);
        $securityAllowance = (float) ($request->security_allowance ?? 0);
        $dependents = (int) $request->no_of_dependent_frm;
        $superannuationId = (int) $request->superannuation_id;
        $providentFundDeductionInput = (float) ($request->provident_fund_deduction ?? 0);

        // Calculate daily rate (reference: $basicSalary / 14)
        $dailyRate = $basicSalary / 14;

        // Fetch area name
        $area = HraAreaPlace::find($hrPlace);
        $areaName = $area ? $area->loca_name : '';

        // Calculate HRA
        $houseRentAllowance = 0;
        if ($hraType != 3 && $hraAmountPerWeek > 0) {
            $hrarange = HraRate::where('area_type', $areaName)
                ->orderBy('wkly_hra_min_val', 'ASC')
                ->get(['hra_amt', 'wkly_hra_min_val', 'wkly_hra_max_val'])
                ->toArray();
            foreach ($hrarange as $value) {
                if ($hraAmountPerWeek <= $value['wkly_hra_max_val']) {
                    $houseRentAllowance = $value['hra_amt'];
                    break;
                }
            }
        }

        // Vehicle allowance (reference: scale by working hours)
        $vehicleAllowance = 0;
        if ($vaType != 3) {
            $vaAmount = Allowance::where('id', $vaType)->value('amount') ?? 0;
            // Assume 80 hours per fortnight (from "FN - Fortnightly 80 Hours")
            $workingHoursPerDay = 80 / 14; // Approx 5.71 hours/day
            $oneDayVehicleAllowance = $vaAmount / 14;
            $hourlyVehicleAllowance = $oneDayVehicleAllowance / $workingHoursPerDay;
            $vehicleAllowance = round(80 * $hourlyVehicleAllowance, 2); // Full fortnight
        }

        // Meals allowance
        if ($mealsTag && !$mealsAllowance) {
            $mealsAmount = Allowance::where('id', 1)->value('amount'); // Adjust ID as needed
            $mealsAllowance = $mealsAmount ?? 0;
        }

        // Total benefits (reference: sum of allowances)
        $totalBenefits = $houseRentAllowance + $vehicleAllowance + $mealsAllowance +
                         $medicalAllowance + $specialAllowance + $otherAllowance +
                         $electricityAllowance + $securityAllowance;

        // Gross salary (reference: $totalSalary + $totalBenefits)
        $totalSalary = round(14 * $dailyRate, 2); // Full fortnight
        $grossFortnight = $totalSalary + $totalBenefits;

        // Superannuation (reference: 6% employee, 8.4% employer, excluding certain items)
        $superannuation = Superannuation::find($superannuationId);
        $taxMethod = $superannuation ? $superannuation->tax_method_for_employee_contribution : null;

        // Calculate superannuation base (exclude optional allowances if not core)
        $superannuationBase = $grossFortnight - ($specialAllowance + $otherAllowance); // Exclude non-core allowances
        $employeeContribution = round($superannuationBase * 0.06, 2); // 6%
        $employerContribution = round($superannuationBase * 0.084, 2); // 8.4%

        // Use input provident_fund_deduction if provided, else calculated employee contribution
        $providentFundDeduction = $providentFundDeductionInput > 0 ? $providentFundDeductionInput : $employeeContribution;

        // Adjust for superannuation tax method
        $preTaxGross = $grossFortnight;
        if ($taxMethod === 'pre-tax') {
            $preTaxGross -= $providentFundDeduction;
        }

        // Tax calculation (reference: inspired by TaxCalculationHelper)
        $grossAnnual = $preTaxGross * 26;
        $grossYearly = $residency === 1 ? $grossAnnual - 200 : $grossAnnual;

        $taxData = TaxResident::whereRaw('? BETWEEN min_amt AND max_amt', [$grossYearly])
                    ->where('resi_status', $residency)
                    ->first();

        $grossTax = $taxData
            ? (($grossYearly * ($taxData->gross_tax_per / 100)) - $taxData->deduted_amt)
            : 0;

        // Dependent rebate
        $rebate = 0;
        if ($dependents > 0) {
            $rebateData = DependentRebate::where('no_of_dependent', min(3, $dependents))->first();
            if ($rebateData) {
                $calculated = ($rebateData->per_of_tax / 100) * $grossTax;
                $rebate = max($rebateData->rebate_amt1, min($calculated, $rebateData->rebate_amt2));
            }
        }

        $netTax = $grossTax - $rebate;
        $taxPerFortnight = $netTax / 26;

        // Total deductions (reference: include tax and superannuation)
        $totalDeduction = $taxPerFortnight;
        if ($taxMethod === 'post-tax' || $taxMethod === null) {
            $totalDeduction += $providentFundDeduction;
        }

        // Net salary
        $netSalary = $grossFortnight - $totalDeduction;

        // Return JSON response
        return response()->json([
            'gross_salary' => number_format($grossFortnight, 2),
            'gross_annual' => number_format($grossAnnual, 2),
            'tax_deduction' => number_format($taxPerFortnight, 2),
            'total_deduction' => number_format($totalDeduction, 2),
            'net_salary' => number_format($netSalary, 2),
            'rebate' => number_format($rebate, 2),
            'gross_tax' => number_format($grossTax / 26, 2), // Fortnightly gross tax
            'basic_salary' => number_format($basicSalary, 2),
            'house_rent_allowance' => number_format($houseRentAllowance, 2),
            'vehicle_allowance' => number_format($vehicleAllowance, 2),
            'meals_allowance' => number_format($mealsAllowance, 2),
            'medical_allowance' => number_format($medicalAllowance, 2),
            'special_allowance' => number_format($specialAllowance, 2),
            'other_allowance' => number_format($otherAllowance, 2),
            'electricity_allowance' => number_format($electricityAllowance, 2),
            'security_allowance' => number_format($securityAllowance, 2),
            'provident_fund_deduction' => number_format($providentFundDeduction, 2),
            'employee_contribution' => number_format($employeeContribution, 2),
            'employer_contribution' => number_format($employerContribution, 2),
            'area_name' => $areaName,
            'tax_method' => $taxMethod,
        ]);
    }

    public function hra_area_src(Request $request)
    {
        $hraId = $request->id;
        $area = HraAreaPlace::find($hraId);
        return response()->json(['area_name' => $area ? $area->loca_name : '']);
    }

    public function hra(Request $request)
    {
        $rentAmt = (float) $request->amount;
        $hraType = (int) $request->hra_type;
        $areaType = $request->area_type;

        $hraAmount = 0;
        if ($hraType != 3) {
            $hrarange = HraRate::where('area_type', $areaType)
                ->orderBy('wkly_hra_min_val', 'ASC')
                ->get(['hra_amt', 'wkly_hra_min_val', 'wkly_hra_max_val'])
                ->toArray();
            foreach ($hrarange as $value) {
                if ($rentAmt <= $value['wkly_hra_max_val']) {
                    $hraAmount = $value['hra_amt'];
                    break;
                }
            }
        }
        return response()->json(['amount' => $hraAmount]);
    }

    public function vehicle(Request $request)
    {
        $vaType = (int) $request->type;
        $vaAmount = Allowance::where('id', $vaType)->value('amount');
        return response()->json(['amount' => $vaAmount ?? 0]);
    }

    public function meals(Request $request)
    {
        $mealsType = (int) ($request->type ?? 1);
        $mealsAmount = Allowance::where('id', $mealsType)->value('amount');
        return response()->json(['amount' => $mealsAmount ?? 0]);
    }
}