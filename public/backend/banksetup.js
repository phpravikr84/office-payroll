$(function () {
    // Fetch data from bsp_bank_transfer_setups and fill the form
    $.ajax({
        url: window.Laravel.routes.GetBankTransferSetup,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        },
        success: function (response) {
            if (response.exists) {
                $('#id').val(response.data.id);
                $('#bsp_customer_reference').val(response.data.bsp_customer_reference);
                $('#bsp_folder_directory').val(response.data.bsp_folder_directory);
                $('#gl_account_code').val(response.data.gl_account_code);
                
                $('#modify_setting').show();
                $('#save_setting').hide();
                $('#cancel_setting').hide();
                $('#bsp_customer_reference').attr('readonly', true);
                $('#bsp_folder_directory').attr('readonly', true);
                $('#gl_account_code').attr('readonly', true);
            } else {
                $('#modify_setting').hide();
                $('#save_setting').show();
                $('#cancel_setting').show();
                $('#bsp_customer_reference').attr('readonly', false);
                $('#bsp_folder_directory').attr('readonly', false);
                $('#gl_account_code').attr('readonly', false);
            }
        }
    });

    //Save Setting button clicked
    // Add selected bank
        $(document).on('click', '#save_setting', function () {
            // Get Value
            let bspSettingId = $('#id').val();
            let bspCustomerRef = $('#bsp_customer_reference').val();
            let bspFolderDir = $('#bsp_folder_directory').val();
            let glAccountCode = $('#gl_account_code').val();
        
            // Add Setting
            $.ajax({
                url: window.Laravel.routes.BspBankSettingStore,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                data: {
                    id: bspSettingId,
                    bsp_customer_reference: bspCustomerRef,
                    bsp_folder_directory: bspFolderDir,
                    gl_account_code: glAccountCode
                },
                success: function (response) {
                    if (response.exists) {
                        Swal.fire('Bank already added', '', 'warning');
                    }
                }.bind(this),
                error: function (xhr, status, error) {
                    Swal.fire('Failed to save settings', error, 'error');
                }
            });
        });
        
    // Modify setting button clicked
    $('#modify_setting').click(function () {
        $('#save_setting').show();
        $('#cancel_setting').show();
        $('#modify_setting').hide();
        $('#bsp_customer_reference').attr('readonly', false);
        $('#bsp_folder_directory').attr('readonly', false);
        $('#gl_account_code').attr('readonly', false);
    });

    // Add selected bank
    $(document).on('click', '.selectedBank', function () {
        let bankId = $(this).data('bank-id');
        let bsp_setting_id = $('#id').val();

        // Check if bank already exists
        $.ajax({
            url: window.Laravel.routes.CheckBankExists,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: { bank_id: bankId },
            success: function (response) {
                if (response.exists) {
                    Swal.fire('Bank already added', '', 'warning');
                } else {
                    let bankCode = $(this).data('bank-code');
                    let bankName = $(this).data('bank-name');
                    let table = $('#selectedBanks tbody');

                    let $tblRow = `
                        <tr data-bank-id="${bankId}">
                            <td>${bankId}</td>
                            <td>${bankCode} - ${bankName}</td>
                            <td class="transaction-fee">0</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary pull-right edit-btn">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger pull-right remove-btn">Remove</a>
                            </td>
                        </tr>`;

                    table.append($tblRow);
                    console.log(window.Laravel.csrfToken);

                    // Save the bank to the database
                    $.ajax({
                        url: window.Laravel.routes.BspBankTransferSetupStore,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        data: {
                            bsp_setting_id : bsp_setting_id,
                            bank_id: bankId,
                            transaction_fee: 0
                        },
                        success: function () {
                            Swal.fire('Bank added successfully', '', 'success');
                        }
                    });
                }
            }.bind(this)
        });
    });

    // Remove bank row
    $(document).on('click', '.remove-btn', function (e) {
        e.preventDefault();

        let $row = $(this).closest('tr');
        let bankId = $row.data('bank-id');

        $.ajax({
            url: window.Laravel.routes.BspBankTransferSetupRemove,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: { bank_id: bankId },
            success: function () {
                $row.remove();
                Swal.fire('Bank removed successfully', '', 'success');
            }
        });
    });

    // Edit transaction fee
    $(document).on('click', '.edit-btn', function (e) {
        e.preventDefault();

        let $row = $(this).closest('tr');
        let currentFee = $row.find('.transaction-fee').text();
        let bankId = $row.data('bank-id');

        Swal.fire({
            title: 'Enter new transaction fee',
            input: 'text',
            inputValue: currentFee,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                let newFee = result.value;
                $row.find('.transaction-fee').text(newFee);

                // Update transaction fee in the database
                $.ajax({
                    url: window.Laravel.routes.BspBankTransferSetupUpdate,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                    },
                    data: {
                        bank_id: bankId,
                        transaction_fee: newFee
                    },
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                             text: 'Transaction fee updated successfully.',
                           confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                           });
                    }
                });

            }
        });
    });

    // Cancel setting
    $('#cancel_setting').click(function () {
        $('#save_setting').hide();
        $('#cancel_setting').hide();
        $('#modify_setting').show();
    });
});

//ANZ
$(function () {
    // Fetch data from anz_bank_transfer_setups and fill the form
    $.ajax({
        url: window.Laravel.routes.GetAnzBankTransferSetup,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        },
        success: function (response) {
            if (response.exists) {
                $('#anz_id').val(response.data.id);
                $('#anz_customer_reference').val(response.data.anz_customer_reference);
                $('#anz_folder_directory').val(response.data.anz_folder_directory);
                $('#gl_code_id').val(response.data.gl_code_id);
                
                $('#anz_modify_setting').show();
                $('#anz_save_setting').hide();
                $('#anz_cancel_setting').hide();
                $('#anz_customer_reference').attr('readonly', true);
                $('#anz_folder_directory').attr('readonly', true);
                $('#gl_code_id').attr('readonly', true);
            } else {
                $('#anz_modify_setting').hide();
                $('#anz_save_setting').show();
                $('#anz_cancel_setting').show();
                $('#anz_customer_reference').attr('readonly', false);
                $('#anz_folder_directory').attr('readonly', false);
                $('#gl_code_id').attr('readonly', false);
            }
        }
    });

    // Save Setting button clicked
    $(document).on('click', '#anz_save_setting', function () {
        // Get Value
        let anzSettingId = $('#anz_id').val();
        let anzCustomerRef = $('#anz_customer_reference').val();
        let anzFolderDir = $('#anz_folder_directory').val();
        let glAccountCode = $('#gl_code_id').val();

        // Add Setting
        $.ajax({
            url: window.Laravel.routes.AnzBankTransferSetupStore,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: {
                id: anzSettingId,
                anz_customer_reference: anzCustomerRef,
                anz_folder_directory: anzFolderDir,
                gl_code_id: glAccountCode
            },
            success: function (response) {
                if (response.updated) {
                    Swal.fire('Settings updated successfully', '', 'success');
                    $('#anz_modify_setting').show();
                    $('#anz_save_setting').hide();
                    $('#anz_cancel_setting').hide();
                    $('#anz_customer_reference').attr('readonly', true);
                    $('#anz_folder_directory').attr('readonly', true);
                    $('#gl_code_id').attr('readonly', true);
                } else if (response.created) {
                    Swal.fire('New settings added successfully', '', 'success');
                    $('#anz_modify_setting').show();
                    $('#anz_save_setting').hide();
                    $('#anz_cancel_setting').hide();
                    $('#anz_customer_reference').attr('readonly', true);
                    $('#anz_folder_directory').attr('readonly', true);
                    $('#gl_code_id').attr('readonly', true);
                } else if (response.warning) {
                    Swal.fire('New Setting added issue', '', 'warning');
                }
            }.bind(this),
            error: function (xhr, status, error) {
                Swal.fire('Failed to save settings', error, 'error');
            }
        });
    });


    // Modify setting button clicked
    $('#anz_modify_setting').click(function () {
        $('#anz_save_setting').show();
        $('#anz_cancel_setting').show();
        $('#anz_modify_setting').hide();
        $('#anz_customer_reference').attr('readonly', false);
        $('#anz_folder_directory').attr('readonly', false);
        $('#gl_code_id').attr('readonly', false);
    });

    // Add selected bank
    $(document).on('click', '.anzSelectedBank', function () {
        let bankId = $(this).data('bank-id');
        let anz_setting_id = $('#anz_id').val();

        // Check if bank already exists
        $.ajax({
            url: window.Laravel.routes.CheckAnzBankExists,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: { bank_id: bankId },
            success: function (response) {
                if (response.exists) {
                    Swal.fire('Bank already added', '', 'warning');
                } else {
                    let bankCode = $(this).data('bank-code');
                    let bankName = $(this).data('bank-name');
                    let table = $('#selectedBanks tbody');

                    let $tblRow = `
                        <tr data-bank-id="${bankId}">
                            <td>${bankId}</td>
                            <td>${bankCode} - ${bankName}</td>
                            <td class="transaction-fee">0</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary pull-right anz-edit-btn">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger pull-right anz-remove-btn">Remove</a>
                            </td>
                        </tr>`;

                    table.append($tblRow);

                    // Save the bank to the database
                    $.ajax({
                        url: window.Laravel.routes.AnzBankSettingStore,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        data: {
                            anz_setting_id: anz_setting_id,
                            bank_id: bankId,
                            transaction_fee: 0
                        },
                        success: function () {
                            Swal.fire('Bank added successfully', '', 'success');
                        }
                    });
                }
            }.bind(this)
        });
    });

    // Remove bank row
    $(document).on('click', '.anz-remove-btn', function (e) {
        e.preventDefault();

        let $row = $(this).closest('tr');
        let bankId = $row.data('bank-id');

        $.ajax({
            url: window.Laravel.routes.AnzBankTransferSetupRemove,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: { bank_id: bankId },
            success: function () {
                $row.remove();
                Swal.fire('Bank removed successfully', '', 'success');
            }
        });
    });

    // Edit transaction fee
    $(document).on('click', '.anz-edit-btn', function (e) {
        e.preventDefault();

        let $row = $(this).closest('tr');
        let currentFee = $row.find('.transaction-fee').text();
        let bankId = $row.data('bank-id');
        Swal.fire({
            title: 'Enter new transaction fee',
            input: 'text',
            inputValue: currentFee,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                let newFee = result.value;
                $row.find('.transaction-fee').text(newFee);
              
                // Update transaction fee in the database
                $.ajax({
                    url: window.Laravel.routes.AnzBankTransferSetupUpdate,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                    },
                    data: {
                        bank_id: bankId,
                        transaction_fee: newFee
                    },
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                             text: 'Transaction fee updated successfully.',
                           confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                           });
                    },
                    error: function () {
                        Swal.fire('Failed to update transaction fee', '', 'error');
                    }
                });
            }
        });
    });
});

$(function () {
    // WPAC
    // Fetch data from wpac_bank_transfer_setups and fill the form
    $.ajax({
        url: window.Laravel.routes.GetWpacBankTransferSetup,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        },
        success: function (response) {
            if (response.exists) {
                $('#wpac_id').val(response.data.id);
                $('#wpac_customer_reference').val(response.data.wpac_customer_reference);
                $('#wpac_folder_directory').val(response.data.wpac_folder_directory);
                $('#gl_code_id').val(response.data.gl_code_id);

                $('#wpac_modify_setting').show();
                $('#wpac_save_setting').hide();
                $('#wpac_cancel_setting').hide();
                $('#wpac_customer_reference').attr('readonly', true);
                $('#wpac_folder_directory').attr('readonly', true);
                $('#wpac_gl_code_id').attr('readonly', true);
            } else {
                $('#wpac_modify_setting').hide();
                $('#wpac_save_setting').show();
                $('#wpac_cancel_setting').show();
                $('#wpac_customer_reference').attr('readonly', false);
                $('#wpac_folder_directory').attr('readonly', false);
                $('#wpac_gl_code_id').attr('readonly', false);
            }
        }
    });

    // Save Setting button clicked for WPAC
    $(document).on('click', '#wpac_save_setting', function () {
        let wpacSettingId = $('#wpac_id').val();
        let wpacCustomerRef = $('#wpac_customer_reference').val();
        let wpacFolderDir = $('#wpac_folder_directory').val();
        let wpacGlAccountCode = $('#gl_code_id').val();

        $.ajax({
            url: window.Laravel.routes.WpacBankTransferSetupStore,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: {
                id: wpacSettingId,
                wpac_customer_reference: wpacCustomerRef,
                wpac_folder_directory: wpacFolderDir,
                gl_code_id: wpacGlAccountCode
            },
            success: function (response) {
                if (response.updated) {
                    Swal.fire('WPAC settings updated successfully', '', 'success');
                    $('#wpac_modify_setting').show();
                    $('#wpac_save_setting').hide();
                    $('#wpac_cancel_setting').hide();
                    $('#wpac_customer_reference').attr('readonly', true);
                    $('#wpac_folder_directory').attr('readonly', true);
                    $('#gl_code_id').attr('readonly', true);
                } else if (response.created) {
                    Swal.fire('New WPAC settings added successfully', '', 'success');
                    $('#wpac_modify_setting').show();
                    $('#wpac_save_setting').hide();
                    $('#wpac_cancel_setting').hide();
                    $('#wpac_customer_reference').attr('readonly', true);
                    $('#wpac_folder_directory').attr('readonly', true);
                    $('#gl_code_id').attr('readonly', true);
                } else if (response.warning) {
                    Swal.fire('Issue adding new WPAC setting', '', 'warning');
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Failed to save WPAC settings', error, 'error');
            }
        });
    });

    // Modify setting button clicked for WPAC
    $('#wpac_modify_setting').click(function () {
        $('#wpac_save_setting').show();
        $('#wpac_cancel_setting').show();
        $('#wpac_modify_setting').hide();
        $('#wpac_customer_reference').attr('readonly', false);
        $('#wpac_folder_directory').attr('readonly', false);
        $('#gl_code_id').attr('readonly', false);
    });

    // Add selected bank for WPAC
    $(document).on('click', '.wpacSelectedBank', function () {
        let bankId = $(this).data('bank-id');
        let wpac_setting_id = $('#wpac_id').val();
        let bankCode = $(this).data('bank-code');
        let bankName = $(this).data('bank-name');

        // Check if bank already exists
        $.ajax({
            url: window.Laravel.routes.CheckWpacBankExists,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: { bank_id: bankId },
            success: function (response) {
                if (response.exists) {
                    Swal.fire('WPAC Bank already added', '', 'warning');
                } else {
                  
                    let table = $('#selectedWpacBanks tbody');

                    let $tblRow = `
                        <tr data-bank-id="${bankId}">
                            <td>${bankId}</td>
                            <td>${bankCode} - ${bankName}</td>
                            <td class="transaction-fee">0</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary pull-right wpac-edit-btn">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger pull-right wpac-remove-btn">Remove</a>
                            </td>
                        </tr>`;

                    table.append($tblRow);

                    // Save the bank to the database
                    $.ajax({
                        url: window.Laravel.routes.WpacBankSettingStore,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        data: {
                            wpac_setting_id: wpac_setting_id,
                            bank_id: bankId,
                            transaction_fee: 0
                        },
                        success: function () {
                            Swal.fire('WPAC Bank added successfully', '', 'success');
                        }
                    });
                }
            }
        });
    });

    // Remove bank row for WPAC
    $(document).on('click', '.wpac-remove-btn', function (e) {
        e.preventDefault();

        let $row = $(this).closest('tr');
        let bankId = $row.data('bank-id');

        $.ajax({
            url: window.Laravel.routes.WpacBankTransferSetupRemove,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: { bank_id: bankId },
            success: function () {
                $row.remove();
                Swal.fire('WPAC Bank removed successfully', '', 'success');
            }
        });
    });

    // Edit transaction fee for WPAC
    $(document).on('click', '.wpac-edit-btn', function (e) {
        e.preventDefault();

        let $row = $(this).closest('tr');
        let currentFee = $row.find('.transaction-fee').text();
        let bankId = $row.data('bank-id');
        Swal.fire({
            title: 'Enter new transaction fee',
            input: 'text',
            inputValue: currentFee,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                let newFee = result.value;
                $row.find('.transaction-fee').text(newFee);
              
                // Update transaction fee in the database
                $.ajax({
                    url: window.Laravel.routes.WpacBankTransferSetupUpdate,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                    },
                    data: {
                        bank_id: bankId,
                        transaction_fee: newFee
                    },
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                             text: 'Transaction fee updated successfully.',
                           confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                           });
                    },
                    error: function () {
                        Swal.fire('Failed to update WPAC transaction fee', '', 'error');
                    }
                });
            }
        });
    });

    // Kina
    // Fetch data from kina_bank_transfer_setups and fill the form
    $.ajax({
        url: window.Laravel.routes.GetKinaBankTransferSetup,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        },
        success: function (response) {
            if (response.exists) {
                $('#kina_id').val(response.data.id);
                $('#kina_customer_reference').val(response.data.kina_customer_reference);
                $('#kina_folder_directory').val(response.data.kina_folder_directory);
                $('#kina_gl_code_id').val(response.data.gl_code_id);

                $('#kina_modify_setting').show();
                $('#kina_save_setting').hide();
                $('#kina_cancel_setting').hide();
                $('#kina_customer_reference').attr('readonly', true);
                $('#kina_folder_directory').attr('readonly', true);
                $('#gl_code_id').attr('readonly', true);
            } else {
                $('#kina_modify_setting').hide();
                $('#kina_save_setting').show();
                $('#kina_cancel_setting').show();
                $('#kina_customer_reference').attr('readonly', false);
                $('#kina_folder_directory').attr('readonly', false);
                $('#gl_code_id').attr('readonly', false);
            }
        }
    });

    // Save Setting button clicked for Kina
    $(document).on('click', '#kina_save_setting', function () {
        let kinaSettingId = $('#kina_id').val();
        let kinaCustomerRef = $('#kina_customer_reference').val();
        let kinaFolderDir = $('#kina_folder_directory').val();
        let kinaGlAccountCode = $('#kina_gl_code_id').val();

        $.ajax({
            url: window.Laravel.routes.KinaBankTransferSetupStore,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: {
                id: kinaSettingId,
                kina_customer_reference: kinaCustomerRef,
                kina_folder_directory: kinaFolderDir,
                gl_code_id: kinaGlAccountCode
            },
            success: function (response) {
                if (response.updated) {
                    Swal.fire('Kina settings updated successfully', '', 'success');
                    $('#kina_modify_setting').show();
                    $('#kina_save_setting').hide();
                    $('#kina_cancel_setting').hide();
                    $('#kina_customer_reference').attr('readonly', true);
                    $('#kina_folder_directory').attr('readonly', true);
                    $('#gl_code_id').attr('readonly', true);
                } else if (response.created) {
                    Swal.fire('New Kina settings added successfully', '', 'success');
                    $('#kina_modify_setting').show();
                    $('#kina_save_setting').hide();
                    $('#kina_cancel_setting').hide();
                    $('#kina_customer_reference').attr('readonly', true);
                    $('#kina_folder_directory').attr('readonly', true);
                    $('#gl_code_id').attr('readonly', true);
                } else if (response.warning) {
                    Swal.fire('Issue adding new Kina setting', '', 'warning');
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Failed to save Kina settings', error, 'error');
            }
        });
    });

    // Modify setting button clicked for Kina
    $('#kina_modify_setting').click(function () {
        $('#kina_save_setting').show();
        $('#kina_cancel_setting').show();
        $('#kina_modify_setting').hide();
        $('#kina_customer_reference').attr('readonly', false);
        $('#kina_folder_directory').attr('readonly', false);
        $('#gl_code_id').attr('readonly', false);
    });

    // Add selected bank for Kina
    $(document).on('click', '.kinaSelectedBank', function () {
        let bankId = $(this).data('bank-id');
        let kina_setting_id = $('#kina_id').val();
        let bankCode = $(this).data('bank-code');
        let bankName = $(this).data('bank-name');
        // Check if bank already exists
        $.ajax({
            url: window.Laravel.routes.CheckKinaBankExists,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: { bank_id: bankId },
            success: function (response) {
                if (response.exists) {
                    Swal.fire('Kina Bank already added', '', 'warning');
                } else {
 
                    let table = $('#selectedKinaBanks tbody');

                    let $tblRow = `
                        <tr data-bank-id="${bankId}">
                            <td>${bankId}</td>
                            <td>${bankCode} - ${bankName}</td>
                            <td class="transaction-fee">0</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary pull-right kina-edit-btn">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger pull-right kina-remove-btn">Remove</a>
                            </td>
                        </tr>`;

                    table.append($tblRow);

                    // Save the bank to the database
                    $.ajax({
                        url: window.Laravel.routes.KinaBankSettingStore,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        data: {
                            kina_setting_id: kina_setting_id,
                            bank_id: bankId,
                            transaction_fee: 0
                        },
                        success: function () {
                            Swal.fire('Kina Bank added successfully', '', 'success');
                        }
                    });
                }
            }
        });
    });

    // Remove bank row for Kina
    $(document).on('click', '.kina-remove-btn', function (e) {
        e.preventDefault();

        let $row = $(this).closest('tr');
        let bankId = $row.data('bank-id');

        $.ajax({
            url: window.Laravel.routes.KinaBankTransferSetupRemove,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: { bank_id: bankId },
            success: function () {
                $row.remove();
                Swal.fire('Kina Bank removed successfully', '', 'success');
            }
        });
    });

    // Edit transaction fee for Kina
    $(document).on('click', '.kina-edit-btn', function (e) {
        e.preventDefault();

        let $row = $(this).closest('tr');
        let currentFee = $row.find('.transaction-fee').text();
        let bankId = $row.data('bank-id');
        Swal.fire({
            title: 'Enter new transaction fee',
            input: 'text',
            inputValue: currentFee,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                let newFee = result.value;
                $row.find('.transaction-fee').text(newFee);
              
                // Update transaction fee in the database
                $.ajax({
                    url: window.Laravel.routes.KinaBankTransferSetupUpdate,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                    },
                    data: {
                        bank_id: bankId,
                        transaction_fee: newFee
                    },
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                             text: 'Transaction fee updated successfully.',
                           confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                           });
                    },
                    error: function () {
                        Swal.fire('Failed to update Kina transaction fee', '', 'error');
                    }
                });
            }
        });
    });
});

