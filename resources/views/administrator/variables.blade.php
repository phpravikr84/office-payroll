<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}',
        routes: {
            LeaveCalculationShow: '{{ url("/hrm/leave/calculate") }}',
            TakenDatesByUser: '{{ url("/hrm/leave/taken-dates/" . auth()->id()) }}',
            GetBankTransferSetup: '{{ url("/setting/bsp_bank_transfer_setups/get-bank-transfer-setup")}}',    //-----------
            CheckBankExists: '{{ url("/setting/bsp_bank_transfer_setups/check-bank-exists")}}',
            BspBankTransferSetupStore: '{{ url("/setting/bsp_bank_transfer_setups/store_setting") }}',
            BspBankTransferSetupRemove: '{{ url("/setting/bsp_bank_transfer_setups/remove")}}',
            BspBankTransferSetupUpdate: '{{ url("/setting/bsp_bank_transfer_setups/update")}}',
            BspBankSettingStore: '{{ url("/setting/bsp_bank_transfer_setups/store_bank") }}',
            
            GetAnzBankTransferSetup: '{{ url("/setting/anz_bank_transfer_setups/get-anz-bank-transfer-setup") }}',   //--------------
            CheckAnzBankExists: '{{ url("/setting/anz_bank_transfer_setups/check-anz-bank-exists") }}',
            AnzBankTransferSetupStore: '{{ url("/setting/anz_bank_transfer_setups/store_setting") }}',
            AnzBankTransferSetupRemove: '{{ url("/setting/anz_bank_transfer_setups/remove") }}',
            AnzBankTransferSetupUpdate: '{{ url("/setting/anz_bank_transfer_setups/update") }}',
            AnzBankSettingStore: '{{ url("/setting/anz_bank_transfer_setups/store_bank") }}',

             // WPAC Bank Transfer Setup
            GetWpacBankTransferSetup: '{{ url("/setting/wpac_bank_transfer_setups/get-wpac-bank-transfer-setup") }}',   //------------
            CheckWpacBankExists: '{{ url("/setting/wpac_bank_transfer_setups/check-wpac-bank-exists") }}',
            WpacBankTransferSetupStore: '{{ url("/setting/wpac_bank_transfer_setups/store_setting") }}',
            WpacBankTransferSetupRemove: '{{ url("/setting/wpac_bank_transfer_setups/remove") }}',
            WpacBankTransferSetupUpdate: '{{ url("/setting/wpac_bank_transfer_setups/update") }}',
            WpacBankSettingStore: '{{ url("/setting/wpac_bank_transfer_setups/store_bank") }}',

            // Kina Bank Transfer Setup
            GetKinaBankTransferSetup: '{{ url("/setting/kina_bank_transfer_setups/get-kina-bank-transfer-setup") }}',   //-------------------
            CheckKinaBankExists: '{{ url("/setting/kina_bank_transfer_setups/check-kina-bank-exists") }}',
            KinaBankTransferSetupStore: '{{ url("/setting/kina_bank_transfer_setups/store_setting") }}',
            KinaBankTransferSetupRemove: '{{ url("/setting/kina_bank_transfer_setups/remove") }}',
            KinaBankTransferSetupUpdate: '{{ url("/setting/kina_bank_transfer_setups/update") }}',
            KinaBankSettingStore: '{{ url("/setting/kina_bank_transfer_setups/store_bank") }}',
            
            //Pay Item
            PayItemEdit : '{{ url("/setting/pay_items/edit") }}',
            PayItemDel : '{{ url("/setting/pay_items/destroy") }}',
            PayItemUpdate : '{{ url("/setting/pay_items/update") }}',
            PayItemAdd :  '{{ url("/setting/pay_items/store") }}',

            //Pay Reference
            SavePayRefInclEmpl : '{{ url("/process_pay/pay_references/save_pay_reference") }}',
            PayRefAddLoanRoute: '{{ url("/process_pay/pay_references/pay_reference_add_loan") }}',
            PayRefAddLeaveRoute: '{{ url("/process_pay/pay_references/pay_reference_add_leave") }}',
            PayRefEmpSlip: '{{ url("/process_pay/pay_references/payslip") }}',
            PayRefSalaryDays: '{{ url("/process_pay/pay_references/salary_days_count") }}',    //---------------
            PayRefPayItems: '{{ url("/process_pay/pay_references/submit_pay_reference_payitems") }}',
            PayRefPayItemSubmit: '{{ url("/process_pay/pay_references/payref_approved")}}',
            PayRefPayItemReject: '{{ url("/process_pay/pay_references/payref_rejected")}}',
            //Employee Payroll Calculation Route
            EmplPayrollHRAAreaSrc: "{{ url('/hrm/payroll/hra_area_src') }}",
            EmplPayrollHRA: "{{ url('/hrm/payroll/hra') }}",
            EmplPayrollVehicle: "{{ url('/hrm/payroll/vehicle') }}",
            EmplPayrollMeals: "{{ url('/hrm/payroll/meals') }}",
            EmplPayrollTaxCal: "{{ url('/hrm/payroll/taxcal') }}",

            //Attendance
            AttendanceSearch: '{{ url("/hrm/attendance/search") }}',
             //PayLocation
            PayLocationBankDetails: '{{ url("/setting/pay_locations/bank_detail") }}',
            
            
            //Company
            CompanyBankDetails: '{{ url("/setting/company/bank_detail/") }}',

            //Salary Calculator
            SalaryCalculator: '{{ url("/salary-calculator/calculate") }}',
            SalaryCalculatorHRArea: '{{ url("/salary-calculator/hra_area_name") }}',
            SalaryCalculatorHRA: '{{ url("/salary-calculator/hra") }}',
            SalaryCalculatorVehicle: '{{ url("/salary-calculator/vehicle") }}',
            SalaryCalculatorMeals: '{{ url("/salary-calculator/meals") }}',

        }
    };
</script>