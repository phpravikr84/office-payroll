<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}',
        routes: {
            LeaveCalculationShow: '{{ url("/hrm/leave/calculate") }}',
            TakenDatesByUser: '{{ url('/hrm/leave/taken-dates/' . auth()->id()) }}',
            GetBankTransferSetup: '{{ url("/setting/get-bank-transfer-setup")}}',
            CheckBankExists: "{{ url('/setting/check-bank-exists')}}",
            BspBankTransferSetupStore: '{{ url("/setting/bsp_bank_transfer_setups/store_setting") }}',
            BspBankTransferSetupRemove: "{{ url('/setting/bsp_bank_transfer_setups/remove')}}",
            BspBankTransferSetupUpdate: "{{ url('/setting/bsp_bank_transfer_setups/update')}}",
            BspBankSettingStore: '{{ url("/setting/bsp_bank_transfer_setups/store_bank") }}',
            
            GetAnzBankTransferSetup: '{{ url("/setting/get-anz-bank-transfer-setup") }}',
            CheckAnzBankExists: '{{ url("/setting/check-anz-bank-exists") }}',
            AnzBankTransferSetupStore: '{{ url("/setting/anz_bank_transfer_setups/store_setting") }}',
            AnzBankTransferSetupRemove: "{{ url('/setting/anz_bank_transfer_setups/remove') }}",
            AnzBankTransferSetupUpdate: "{{ url('/setting/anz_bank_transfer_setups/update') }}",
            AnzBankSettingStore: '{{ url("/setting/anz_bank_transfer_setups/store_bank") }}',

             // WPAC Bank Transfer Setup
            GetWpacBankTransferSetup: '{{ url("/setting/get-wpac-bank-transfer-setup") }}',
            CheckWpacBankExists: '{{ url("/setting/check-wpac-bank-exists") }}',
            WpacBankTransferSetupStore: '{{ url("/setting/wpac_bank_transfer_setups/store_setting") }}',
            WpacBankTransferSetupRemove: "{{ url('/setting/wpac_bank_transfer_setups/remove') }}",
            WpacBankTransferSetupUpdate: "{{ url('/setting/wpac_bank_transfer_setups/update') }}",
            WpacBankSettingStore: '{{ url("/setting/wpac_bank_transfer_setups/store_bank") }}',

            // Kina Bank Transfer Setup
            GetKinaBankTransferSetup: '{{ url("/setting/get-kina-bank-transfer-setup") }}',
            CheckKinaBankExists: '{{ url("/setting/check-kina-bank-exists") }}',
            KinaBankTransferSetupStore: '{{ url("/setting/kina_bank_transfer_setups/store_setting") }}',
            KinaBankTransferSetupRemove: "{{ url('/setting/kina_bank_transfer_setups/remove') }}",
            KinaBankTransferSetupUpdate: "{{ url('/setting/kina_bank_transfer_setups/update') }}",
            KinaBankSettingStore: '{{ url("/setting/kina_bank_transfer_setups/store_bank") }}',
            
            //Pay Item
            PayItemEdit :'{{ url("/setting/pay_items/edit") }}',
            PayItemDel :'{{ url("/setting/pay_items/destroy") }}',
            PayItemUpdate :'{{ url("/setting/pay_items/update") }}',
            PayItemAdd : '{{ url("/setting/pay_items/store") }}',

            //Pay Reference
            SavePayRefInclEmpl : '{{ url("/process_pay/pay_references/save_pay_reference") }}',
            PayRefAddLeaveRoute: '{{ url("/process_pay/pay_references/pay_reference_add_leave") }}',
            PayRefSlip: '{{ url("/process_pay/pay_references/pay_reference_add_leave") }}',

            //Attendance
            AttendanceSearch: '{{ url("/hrm/attendance/search") }}',
        }
    };
</script>