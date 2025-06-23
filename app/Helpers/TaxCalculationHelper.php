<?php

namespace App\Helpers;

use App\HraRate;
use App\HraAreaPlace;
use App\TaxResident;
use App\DependentRebate;
use App\Allowance;

class TaxCalculationHelper
{
    public static function calculateHRA($rentamt, $hra_type, $areatype)
    {
        $hrarange = HraRate::where('area_type', $areatype)
            ->orderBy('wkly_hra_min_val', 'ASC')
            ->get(['hra_amt', 'chk_amt', 'wkly_hra_min_val', 'wkly_hra_max_val'])
            ->toArray();

        $hraamt = 0;
        foreach ($hrarange as $value) {
            if ($rentamt <= $value['wkly_hra_max_val']) {
                $hraamt = $value['hra_amt'];
                break;
            }
        }

        return $hraamt;
    }

    // public static function calculateTax($gross_sal, $dependent, $r_status)
    // {
    //     $gross_yr_sal = $r_status == 1 ? ($gross_sal * 26 - 200) : ($gross_sal * 26);

    //     $tax_details = TaxResident::whereRaw('? between min_amt and max_amt', [$gross_yr_sal])
    //         ->where('resi_status', $r_status)
    //         ->get(['gross_tax_per', 'deduted_amt'])
    //         ->toArray();

    //     $tax_per = 0;
    //     $deduted_amt = 0;
    //     foreach ($tax_details as $value) {
    //         $tax_per = $value['gross_tax_per'] / 100;
    //         $deduted_amt = $value['deduted_amt'];
    //     }

    //     $gr_tax_amt = ($gross_yr_sal * $tax_per) - $deduted_amt;
       

    //     if ($dependent >= 3) {
    //         $dependent = 3;
    //     }

    //     $frt_tax_amt = 0;
    //     if($dependent!=null && $dependent != 0)
    //     {
    //         $depend_qry = DependentRebate::where('no_of_dependent', $dependent)
    //             ->get(['rebate_amt1', 'rebate_amt2', 'per_of_tax'])
    //             ->toArray();

    //         $rebate_amt = 0;
    //         if (count($depend_qry) > 0) {
    //             foreach ($depend_qry as $value) {
    //                 $rebate_amt1 = $value['rebate_amt1'];
    //                 $rebate_amt2 = $value['rebate_amt2'];
    //                 $per_of_tax = $value['per_of_tax'];

    //                 $rebate_amt = ($per_of_tax / 100) * $gr_tax_amt;
    //                 //echo 'Rebate Amount 2 '.$rebate_amt."<br/>";
    //                 if ($rebate_amt > $rebate_amt2) {
    //                     $rebate_amt = $rebate_amt2;
    //                 }
    //                 if ($rebate_amt < $rebate_amt1) {
    //                     $rebate_amt = $rebate_amt1;
    //                 }
    //             }
    //         }

    //         $net_tax_amt = $gr_tax_amt - $rebate_amt;
    //         $frt_tax_amt = $net_tax_amt / 26;

    //     } else {
    //         $frt_tax_amt = $gr_tax_amt/26;
    //     }

    //     //return $frt_tax_amt;
    //       // Return an array with all calculated details
    //     return [
    //         'dependent_rebate' => $rebate_amt,
    //         'weekly_tax_amount' => $frt_tax_amt,
    //     ];
    // }
    public static function calculateTax($gross_sal, $dependent, $r_status)
    {
        // Calculate gross annual salary
        $gross_yr_sal = $r_status == 1 ? ($gross_sal * 26 - 200) : ($gross_sal * 26);

        // Fetch tax details based on the gross annual salary
        $tax_details = TaxResident::whereRaw('? between min_amt and max_amt', [$gross_yr_sal])
            ->where('resi_status', $r_status)
            ->get(['gross_tax_per', 'deduted_amt'])
            ->toArray();

        // Initialize variables
        $tax_per = 0;
        $deduted_amt = 0;
        foreach ($tax_details as $value) {
            $tax_per = $value['gross_tax_per'] / 100;
            $deduted_amt = $value['deduted_amt'];
        }

        // Calculate gross tax amount
        $gr_tax_amt = ($gross_yr_sal * $tax_per) - $deduted_amt;

       

        // Calculate Net Tax per Fortnight
        //$net_tax_amt = $gr_tax_amt / 26;

        

        // Cap the dependent value at 3 for 3 or more dependents
        $dependent = $dependent >= 3 ? 3 : $dependent;

        // Calculate the dependent rebate if there are dependents
        $rebate_amt = 0;
        if ($dependent > 0) {
            $depend_qry = DependentRebate::where('no_of_dependent', $dependent)
                ->first(['rebate_amt1', 'rebate_amt2', 'per_of_tax']);

            if ($depend_qry) {
                $rebate_amt1 = $depend_qry->rebate_amt1;
                $rebate_amt2 = $depend_qry->rebate_amt2;
                $per_of_tax = $depend_qry->per_of_tax;

                // Calculate the rebate based on percentage of Gross Tax and set minimum and maximum limits
                $calculated_rebate = ($per_of_tax / 100) * $gr_tax_amt;
                $rebate_amt = min(max($calculated_rebate, $rebate_amt1), $rebate_amt2);
            }
        }

        // Calculate final net tax after applying the rebate
        $frt_tax_amt = $gr_tax_amt - $rebate_amt;

        // echo 'Gross Enter '.$gross_sal."<br/>";
        // echo 'Gross'.$gross_yr_sal."<br/>";
        // echo 'Taxper'.$tax_per."<br/>";
        // echo 'Deducted Amount'.$deduted_amt."<br/>";
        // echo 'Dependent'.$dependent."<br/>";
        // echo 'Dependent rebate'.$rebate_amt."<br/>";
        // echo 'Gross Tax Annually Amount '.$gr_tax_amt."<br/>";
        // echo 'Net Tax Amount  with Rebate Annually'.$frt_tax_amt."<br/>";
        // exit;

        // Return an array with all calculated details
        return [
            'dependent_rebate' => $rebate_amt/26, // Per Fortnight
            'gross_tax_amount' => $gr_tax_amt/26, // Per Fortnigh
            'weekly_tax_amount' => $frt_tax_amt/26, // Per Fortnigh
        ];
    }


    public static function calculateVehicleAllowance($va_type)
    {
        $va_amount = Allowance::where('id', $va_type)->value('amount');
        return $va_amount;
    }

    public static function calculateMealsAllowance($meals_type)
    {
        $meals_amount = Allowance::where('id', $meals_type)->value('amount');
        return $meals_amount;
    }

    public static function getAreaLocation($hra_area_id)
    {
        $area_location = HraAreaPlace::where('id', $hra_area_id)->value('loca_name');
        return $area_location;
    }
}
