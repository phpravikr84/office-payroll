<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxResident;
use App\Models\DependentRebate;
use App\Models\Allowance;
use App\Models\HraRate;
use App\Models\HraAreaPlace;
use App\Models\Superannuation;
use App\Models\TaxRate;

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
            //'hr_place' => 'required|exists:hra_area_places,id',
            //'hra_type' => 'required|in:1,2,3',
            'hra_amount_per_week' => 'nullable|numeric|min:0',
            //'va_type' => 'required|in:1,2,3',
            'meals_tag' => 'nullable|in:1',
            'meals_allowance' => 'nullable|numeric|min:0',
            'medical_allowance' => 'nullable|numeric|min:0',
            'special_allowance' => 'nullable|numeric|min:0',
            'other_allowance' => 'nullable|numeric|min:0',
            'electricity_allowance' => 'nullable|numeric|min:0',
            'security_allowance' => 'nullable|numeric|min:0',
            'no_of_dependent_frm' => 'required|integer|min:0|max:5',
            //'superannuation_id' => 'required|exists:superannuations,id',
            'provident_fund_deduction' => 'nullable|numeric|min:0',
            'declaration' => 'required'
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
        $declaration = $request->declaration;
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

        $employer_ctb_perct = isset($superannuation->employer_contribution_percentage) ? $superannuation->employer_contribution_percentage : 0;
        $employee_ctb_perct = isset($superannuation->employee_contrib_percent) ? $superannuation->employee_contrib_percent : 0;

        // Calculate superannuation base (exclude optional allowances if not core)
        $superannuationBase = $grossFortnight - ($specialAllowance + $otherAllowance); // Exclude non-core allowances
        $employeeContribution = round($superannuationBase * ($employee_ctb_perct/100), 2); // 6%
        $employerContribution = round($superannuationBase * ($employer_ctb_perct/100), 2); // 8.4%

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

        // $taxData = TaxResident::whereRaw('? BETWEEN min_amt AND max_amt', [$grossYearly])
        //             ->where('resi_status', $residency)
        //             ->first();

        // $grossTax = $taxData
        //     ? (($grossYearly * ($taxData->gross_tax_per / 100)) - $taxData->deduted_amt)
        //     : 0;

        //
        $tax_per = 0;
        $deduted_amt = 0;

        $tax_detail = TaxResident::query()
            ->whereRaw('? between min_amt and max_amt', [$grossYearly])
            ->where('resi_status', $residency)
            ->select('gross_tax_per', 'deduted_amt')
            ->first();

        if ($tax_detail) {
            $tax_per = $tax_detail->gross_tax_per / 100;
            $deduted_amt = $tax_detail->deduted_amt;
        }

        $grossTax = ($grossYearly * $tax_per) - $deduted_amt;

        

        // Dependent rebate
        // $rebate = 0;
        // if ($dependents > 0) {
        //     $rebateData = DependentRebate::where('no_of_dependent', min(3, $dependents))->first();
        //     if ($rebateData) {
        //         $calculated = ($rebateData->per_of_tax / 100) * $grossTax;
        //         $rebate = max($rebateData->rebate_amt1, min($calculated, $rebateData->rebate_amt2));
        //     }
        // }

        if ($dependents >= 3) {
            $dependents = 3;
        }

        $depend_qry = DependentRebate::where('no_of_dependent', $dependents)
            ->select('rebate_amt1', 'rebate_amt2', 'per_of_tax')
            ->first();

        $rebate_amt1 = 0;
        $rebate_amt2 = 0;
        $per_of_tax = 0;
        $rebate_amt = 0;
        $rebate = 0;

        if ($depend_qry) {
            $rebate_amt1 = (float) $depend_qry->rebate_amt1; // 75
            $rebate_amt2 = (float) $depend_qry->rebate_amt2; // 750
            $per_of_tax = (float) $depend_qry->per_of_tax;

            $rebate_amt = round(($per_of_tax / 100) * $grossTax, 2);

            // $mid = ($rebate_amt1 + $rebate_amt2) / 2;

            // // If below midpoint, use min; otherwise, use max
            // $rebate = ($rebate_amt < $mid) ? $rebate_amt1 : $rebate_amt2;

            if($rebate_amt > $rebate_amt2){
				$rebate_amt = $rebate_amt2;
			}
			if($rebate_amt < $rebate_amt1){
				$rebate_amt = $rebate_amt1;
			} 

            // return response()->json([
            //     'rebate_amt1' => $rebate_amt1,
            //     'rebate_amt2' => $rebate_amt2,
            //     'rebate_amt'  => $rebate,
            //     'per_of_tax'  => $per_of_tax,
            // ]);

        } else {
            $rebate_amt = 0;
        }


        



        $netTax = $grossTax - $rebate_amt;
        $taxPerFortnight = $netTax / 26;

        // Total deductions (reference: include tax and superannuation)
        $totalDeduction = $taxPerFortnight;
        if ($taxMethod === 'post-tax' || $taxMethod === null) {
            $totalDeduction += $providentFundDeduction;
        }

        // Net salary
        $netSalary = $grossFortnight - $totalDeduction;

        // Calculate Tax 
        if ($residency == 1) {
            $residentType = 'resident';
        } else {
            $residentType = 'non-resident';
        }

        $data = $this->calculateTaxA($grossFortnight, $dependents, $residentType, );


        //Create TAX A & TAX B MATCH
        $taxA = number_format($data['tax_after_rebate'], 2, '.', '');
        $rebateAmt = number_format($taxPerFortnight, 2, '.', '');

        $match = 0;
        if($taxA > $rebateAmt){
            $diff = $taxA - $rebateAmt;
        } else {
            $diff = $rebateAmt - $taxA;
        }

        if ($diff >= 0 && $diff <= 2) {
            $match = 1;
        } else {
            $match = 0;
        }


        // Return JSON response
        return response()->json([
            'gross_salary' => number_format($grossFortnight, 2),
            'gross_annual' => number_format($grossAnnual, 2),
            'tax_deduction' => number_format($taxPerFortnight, 2),
            'tax_deduction_new' => number_format($data['tax'], 2),
            'rebate_new' => number_format($data['rebate'], 2),
            'tax_after_rebate' => number_format($data['tax_after_rebate'], 2), //fixed key name
            'total_deduction' => number_format($totalDeduction, 2),
            'net_salary' => number_format($netSalary, 2),
            'rebate' => number_format($rebate_amt, 2),
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
            'superann' => $superannuationBase,
            'grossfor' => $grossFortnight,
            'match'     => $match,
        ]);
    }

    /**
     * Calculate TAX A
     */

    // public function calculateTaxA($fortnightlyIncome = 0, $dependents = 0, $residentType = 'resident')
    // {
    //     $tax = 0.00;
    //     $rebate = 0.00;

    //     // Cap dependents at 3
    //     $effectiveDependents = min((int)$dependents, 3);

    //     if ($fortnightlyIncome <= 950) {
    //         $taxRate = TaxRate::where('salary_min', '<=', $fortnightlyIncome)
    //             ->where('salary_max', '>=', $fortnightlyIncome)
    //             ->first();

    //         if ($taxRate) {
    //             // Select column name based on dependents
    //             $taxColumn = match ($effectiveDependents) {
    //                 0 => 'tax_none',
    //                 1 => 'tax_one',
    //                 2 => 'tax_two',
    //                 default => 'tax_three_or_more',
    //             };

    //             $rebate = $taxRate->$taxColumn ?? 0.00;
    //             $tax = 115.38;
    //         }
    //     } else {
    //         // Income-based slab tax
    //         if ($fortnightlyIncome <= 1276) {
    //             $tax = 115.38 + 0.30 * ($fortnightlyIncome - 950);
    //         } elseif ($fortnightlyIncome <= 2700) {
    //             $tax = 213.46 + 0.35 * ($fortnightlyIncome - 1276);
    //         } elseif ($fortnightlyIncome <= 9623) {
    //             $tax = 711.54 + 0.40 * ($fortnightlyIncome - 2700);
    //         } else {
    //             $tax = 3480.77 + 0.42 * ($fortnightlyIncome - 9623);
    //         }

    //         $tax = max(0, round($tax, 2));

    //         // Static rebate values
    //         $rebate = match ($effectiveDependents) {
    //             1 => 17.30,
    //             2 => 28.85,
    //             3 => 40.38,
    //             default => 0.00,
    //         };
    //     }

    //     $taxAfterRebate = max(0, round($tax - $rebate, 2));

    //     // Return as array for internal use
    //     return [
    //         'fortnightly_income' => $fortnightlyIncome,
    //         'dependents' => $dependents,
    //         'resident_type' => $residentType,
    //         'tax' => $tax,
    //         'rebate' => $rebate,
    //         'tax_after_rebate' => $taxAfterRebate,
    //     ];
    // }

    // public function calculateTaxA($fortnightlyIncome = 0, $dependents = 0, $residentType = 'resident', $declaration = 'yes')
    // {
    //     $tax = 0.00;
    //     $rebate = 0.00;

    //     // Cap dependents at 3
    //     $effectiveDependents = min((int)$dependents, 3);

    //     // Use Formula 1: income ≤ 769.23 → use tax_rates table
    //     if ($fortnightlyIncome <= 769.23) {

    //         $taxRate = TaxRate::where('salary_min', '<=', $fortnightlyIncome)
    //                         ->where('salary_max', '>=', $fortnightlyIncome)
    //                         ->first();

    //         if ($residentType === 'non-resident') {
    //             $tax = $taxRate?->non_resident_taxrate ?? 0.00;

    //         } elseif ($residentType === 'resident') {
    //             if ($declaration === 'no') {
    //                 $tax = $taxRate?->no_declaration_taxrate ?? 0.00;
    //             } elseif ($declaration === 'yes') {
    //                 if ($fortnightlyIncome <= 769.23) {
    //                     // Use dependents-based tax from table
    //                     $column = match ($effectiveDependents) {
    //                         0 => 'tax_none',
    //                         1 => 'tax_one',
    //                         2 => 'tax_two',
    //                         default => 'tax_three_or_more',
    //                     };
    //                     $tax = $taxRate?->$column ?? 0.00;
    //                 }
    //             }
    //         }

    //         // Rebate for Formula 1
    //         $percentRebate = match ($effectiveDependents) {
    //             1 => 0.10,
    //             2 => 0.15,
    //             3 => 0.35,
    //             default => 0.00,
    //         };

    //         $maxRebate = match ($effectiveDependents) {
    //             1 => 17.31,
    //             2 => 28.85,
    //             3 => 40.38,
    //             default => 0.00,
    //         };

    //         $rebate = min($tax * $percentRebate, $maxRebate);
    //     }

    //     // Use Formula 2: income > 769.23
    //     else {
    //         if ($residentType === 'non-resident') {
    //             if ($fortnightlyIncome <= 1269.23) {
    //                 $tax = 169.23 + 0.30 * ($fortnightlyIncome - 769.23);
    //             } elseif ($fortnightlyIncome <= 2692.31) {
    //                 $tax = 319.22 + 0.35 * ($fortnightlyIncome - 1269.23);
    //             } elseif ($fortnightlyIncome <= 9615.38) {
    //                 $tax = 817.28 + 0.40 * ($fortnightlyIncome - 2692.31);
    //             } else {
    //                 $tax = 3586.38 + 0.42 * ($fortnightlyIncome - 9615.38);
    //             }

    //         } elseif ($residentType === 'resident') {
    //             if ($declaration === 'no') {
    //                 if ($fortnightlyIncome <= 900) {
    //                     $tax = 0.30 * ($fortnightlyIncome - 769.23);
    //                 } else {
    //                     $tax = 322.98 + 0.42 * ($fortnightlyIncome - 900);
    //                 }

    //             } elseif ($declaration === 'yes') {
    //                 if ($fortnightlyIncome <= 1269.23) {
    //                     $tax = 0.30 * ($fortnightlyIncome - 769.23);
    //                 } elseif ($fortnightlyIncome <= 2692.31) {
    //                     $tax = 149.99 + 0.35 * ($fortnightlyIncome - 1269.23);
    //                 } elseif ($fortnightlyIncome <= 9615.38) {
    //                     $tax = 648.05 + 0.40 * ($fortnightlyIncome - 2692.31);
    //                 } else {
    //                     $tax = 3417.27 + 0.42 * ($fortnightlyIncome - 9615.38);
    //                 }

    //                 // Rebate only for declared residents
    //                 $percentRebate = match ($effectiveDependents) {
    //                     1 => 0.10,
    //                     2 => 0.15,
    //                     3 => 0.35,
    //                     default => 0.00,
    //                 };

    //                 $maxRebate = match ($effectiveDependents) {
    //                     1 => 17.31,
    //                     2 => 28.85,
    //                     3 => 40.38,
    //                     default => 0.00,
    //                 };

    //                 $rebate = min($tax * $percentRebate, $maxRebate);
    //             }
    //         }
    //     }

    //     // Final adjustments
    //     $tax = round(max(0, $tax), 2);
    //     $rebate = round($rebate, 2);
    //     $taxAfterRebate = round(max(0, $tax - $rebate), 2);

    //     return [
    //         'fortnightly_income' => $fortnightlyIncome,
    //         'dependents' => $dependents,
    //         'resident_type' => $residentType,
    //         'declaration' => $declaration,
    //         'tax' => $tax,
    //         'rebate' => $rebate,
    //         'tax_after_rebate' => $taxAfterRebate,
    //     ];
    // }

    public function calculateTaxA($fortnightlyIncome = 0, $dependents = 0, $residentType = 'resident', $declaration = 'yes')
    {
        $tax = 0.00;
        $rebate = 0.00;

        $effectiveDependents = min((int)$dependents, 3);

        // Get dynamic upper bound for Formula 1 from tax_rates table
        $formula1Threshold = TaxRate::max('salary_max'); // e.g., 1269.23

        // Lookup rate row from tax table (used only in Formula 1)
        $taxRate = TaxRate::where('salary_min', '<=', $fortnightlyIncome)
                        ->where('salary_max', '>=', $fortnightlyIncome)
                        ->first();

        if ($fortnightlyIncome <= $formula1Threshold) {
            //Formula 1 - from tax_rates table
            if ($residentType === 'non-resident') {
                $tax = $taxRate?->non_resident_taxrate ?? 0.00;

            } elseif ($residentType === 'resident') {
                if ($declaration === 'no') {
                    $tax = $taxRate?->no_declaration_taxrate ?? 0.00;

                } elseif ($declaration === 'yes') {
                    $column = match ($effectiveDependents) {
                        0 => 'tax_none',
                        1 => 'tax_one',
                        2 => 'tax_two',
                        default => 'tax_three_or_more',
                    };
                    $tax = $taxRate?->$column ?? 0.00;
                }
            }

            // Apply rebate logic for Formula 1
            $percentRebate = match ($effectiveDependents) {
                1 => 0.10,
                2 => 0.15,
                3 => 0.35,
                default => 0.00,
            };

            $maxRebate = match ($effectiveDependents) {
                1 => 17.31,
                2 => 28.85,
                3 => 40.38,
                default => 0.00,
            };

            $rebate = min($tax * $percentRebate, $maxRebate);
        }
        else {
            // Formula 2 - calculated manually
            if ($residentType === 'non-resident') {
                if ($fortnightlyIncome <= 2692.31) {
                    $tax = 319.22 + 0.35 * ($fortnightlyIncome - 1269.23);
                } elseif ($fortnightlyIncome <= 9615.38) {
                    $tax = 817.28 + 0.40 * ($fortnightlyIncome - 2692.31);
                } else {
                    $tax = 3586.38 + 0.42 * ($fortnightlyIncome - 9615.38);
                }

            } elseif ($residentType === 'resident') {
                if ($declaration === 'no') {
                    if ($fortnightlyIncome <= 900) {
                        $tax = 0.30 * ($fortnightlyIncome - 769.23);
                    } else {
                        $tax = 322.98 + 0.42 * ($fortnightlyIncome - 900);
                    }

                } elseif ($declaration === 'yes') {
                    if ($fortnightlyIncome <= 2692.31) {
                        $tax = 149.99 + 0.35 * ($fortnightlyIncome - 1269.23);
                    } elseif ($fortnightlyIncome <= 9615.38) {
                        $tax = 648.05 + 0.40 * ($fortnightlyIncome - 2692.31);
                    } else {
                        $tax = 3417.27 + 0.42 * ($fortnightlyIncome - 9615.38);
                    }

                    // Rebate for declaration = yes
                    $percentRebate = match ($effectiveDependents) {
                        1 => 0.10,
                        2 => 0.15,
                        3 => 0.35,
                        default => 0.00,
                    };

                    $maxRebate = match ($effectiveDependents) {
                        1 => 17.31,
                        2 => 28.85,
                        3 => 40.38,
                        default => 0.00,
                    };

                    $rebate = min($tax * $percentRebate, $maxRebate);
                }
            }
        }

        // Final calculations
        $tax = round(max(0, $tax), 2);
        $rebate = round($rebate, 2);
        $taxAfterRebate = round(max(0, $tax - $rebate), 2);

        return [
            'fortnightly_income' => $fortnightlyIncome,
            'dependents' => $dependents,
            'resident_type' => $residentType,
            'declaration' => $declaration,
            'tax' => $tax,
            'rebate' => $rebate,
            'tax_after_rebate' => $taxAfterRebate,
        ];
    }




    public function hra_area_name($hra_area_id)
    {
        $area_location = HraAreaPlace::query()
			->where('id', $hra_area_id)
			->get(['id', 'loca_name', 'places'])
			->toArray();

		foreach ($area_location as $key => $value) {
				$area_location1 = $value['loca_name'];
		}
		return response([$area_location1]);
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

    public function meals($mealsType)
    {
        $mealsAmount = Allowance::where('id', $mealsType)->value('amount');
        return response()->json(['amount' => $mealsAmount ?? 0]);
    }
}