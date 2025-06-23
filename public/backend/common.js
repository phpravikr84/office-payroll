$(function () {
    // Leave Application form
    $('#casual_leave_only').hide();
    $(document).on('change', '#leave_category_id, #start_date, #end_date', function() {
        let leaveCategoryId = $('#leave_category_id').val();
        let startDate = $('#start_date').val();
        let endDate = $('#end_date').val();
        let leaveDuration = $('#leave_duration').val();
        let userId = $('#user_id').val();
        // let is_sandwich_leave = $('#is_sandwich_leave').val();
        // let sandwich_leave_days = $('#sandwich_leave_days').val();
        // let holiday_count =  $('#holiday_count').val();

        if (leaveCategoryId && startDate && endDate) {
            if(leaveCategoryId==2){
                $('#casual_leave_only').show();
            } else {
                $('#casual_leave_only').hide();
            }
            $.ajax({
                url: window.Laravel.routes.LeaveCalculationShow,
                type: 'GET',
                data: {
                    leave_category_id: leaveCategoryId,
                    start_date: startDate,
                    end_date: endDate,
                    leave_duration: leaveDuration,
                    user_id: userId,
                },
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        console.log('pending_leave:'+response.pending_leave);
                        console.log('loss of pay'+response.loss_of_pay_days);
                        console.log('sandwich leave' + response.sandwich_leave_days);
                        $('#pending_leave').val(response.pending_leave);
                        $('#loss_of_pay_days').val(response.loss_of_pay_days);
                        $('#leave_applied_days').val(response.leave_applied_days);
                        $('#is_sandwich_leave').val(response.is_sandwich_leave);
                        $('#sandwich_leave_days').val(response.sandwich_leave_days);
                        $('#holiday_count').val(response.holiday_count);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Log the error for debugging
                    alert('An error occurred while calculating leave.');
                }
            });
        }
    });
});

// $(document).on('change', '#leave_category_id', function() {
//     // Get the current date
//     var today = new Date();
//     // Calculate the date one month ago
//     var oneMonthAgo = new Date();
//     oneMonthAgo.setMonth(today.getMonth() - 1);

//     let leaveCategoryId = $(this).val();

//     // Destroy any existing datepicker to prevent duplication
//     $(".datepicker").datepicker("destroy");

//     if (leaveCategoryId == 1) {
//         $(".datepicker").datepicker({
//             dateFormat: 'yy-mm-dd',
//             minDate: oneMonthAgo, // Set the min date to one month ago
//             maxDate: today, // Set the max date to today
//             beforeShowDay: function(date) {
//                 // Disable future dates
//                 if (date > today) {
//                     return [false, "", "Unavailable"];
//                 }
//                 return [true, ""]; // Enable all other dates within the range
//             }
//         });
//     } else if (leaveCategoryId == 2 || leaveCategoryId == 3) {
//         // Array to store disabled date ranges
//         var disabledDateRanges = [];

//         // Fetch already taken leave dates
//         $.ajax({
//             url: window.Laravel.routes.TakenDatesByUser,
//             method: 'GET',
//             success: function(response) {
//                 disabledDateRanges = response.dates.map(function(range) {
//                     return {
//                         start: new Date(range.start_date),
//                         end: new Date(range.end_date)
//                     };
//                 });
//                 initializeDatepicker();
//             },
//             error: function() {
//                 console.error("Failed to fetch leave dates");
//             }
//         });

//         // Initialize the datepicker
//         function initializeDatepicker() {
//             $(".datepicker").datepicker({
//                 dateFormat: 'yy-mm-dd',
//                 minDate: today,
//                 beforeShowDay: function(date) {
//                     return disableDateRanges(date);
//                 }
//             });
//         }

//         // Function to disable specific date ranges
//         function disableDateRanges(date) {
//             for (var i = 0; i < disabledDateRanges.length; i++) {
//                 var range = disabledDateRanges[i];
//                 if (date >= range.start && date <= range.end) {
//                     return [false, 'ui-state-disabled', 'Taken Leave']; // Add a CSS class for styling if needed
//                 }
//             }
//             return [true, ''];
//         }
//     }
// });




// $(function() {

//     // Get the current date
//     var today = new Date();
//     $(document).on('change', '#user_id', function(){
//         let user_id = $(this).val();

//         // Array to store disabled date ranges
//         var disabledDateRanges = [];

//         // Fetch already taken leave dates
//         $.ajax({
//             url: window.Laravel.routes.TakenDatesByUser,
//             method: 'GET',
//             success: function(response) {
//                 disabledDateRanges = response.dates.map(function(range) {
//                     return {
//                         start: new Date(range.start_date),
//                         end: new Date(range.end_date)
//                     };
//                 });
//                 initializeDatepicker();
//             }
//         });
//     })
   

//     // Initialize the datepicker
//     function initializeDatepicker() {
//         $(".datepicker").datepicker({
//             dateFormat: 'yy-mm-dd',
//             minDate: today,
//             beforeShowDay: function(date) {
//                 return disableDateRanges(date);
//             }
//         });
//     }

//     // Function to disable specific date ranges
//     function disableDateRanges(date) {
//         for (var i = 0; i < disabledDateRanges.length; i++) {
//             var range = disabledDateRanges[i];
//             if (date >= range.start && date <= range.end) {
//                 return [false, 'ui-state-disabled', 'Taken Leave']; // Add a CSS class for styling if needed
//             }
//         }
//         return [true, ''];
//     }
// });

$(function() {
    // Get the current date
    var today = new Date();

    // Function to disable specific date ranges
    function disableDateRanges(date) {
        for (var i = 0; i < disabledDateRanges.length; i++) {
            var range = disabledDateRanges[i];
            if (date >= range.start && date <= range.end) {
                return [false, 'ui-state-disabled', 'Taken Leave']; // Add a CSS class for styling if needed
            }
        }
        return [true, ''];
    }

    // Initialize the datepicker
    function initializeDatepicker() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: today,
            beforeShowDay: function(date) {
                return disableDateRanges(date);
            }
        });
    }

    // Handle change event for leave category
    $(document).on('change', '#leave_category_id', function() {
        let leaveCategoryId = $(this).val();
        //     // Calculate the date one month ago
            var oneMonthAgo = new Date();
            oneMonthAgo.setMonth(today.getMonth() - 1);


        // Destroy any existing datepicker to prevent duplication
        $(".datepicker").datepicker("destroy");

        if (leaveCategoryId == 1) {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: oneMonthAgo, // Set the min date to one month ago
                maxDate: today, // Set the max date to today
                beforeShowDay: function(date) {
                    if (date > today) {
                        return [false, "", "Unavailable"];
                    }
                    return [true, ""]; // Enable all other dates within the range
                }
            });
        } else if (leaveCategoryId == 2 || leaveCategoryId == 3) {
            // Fetch already taken leave dates
            $.ajax({
                url: window.Laravel.routes.TakenDatesByUser,
                method: 'GET',
                success: function(response) {
                    disabledDateRanges = response.dates.map(function(range) {
                        return {
                            start: new Date(range.start_date),
                            end: new Date(range.end_date)
                        };
                    });
                    initializeDatepicker();
                },
                error: function() {
                    console.error("Failed to fetch leave dates");
                }
            });
        }
    });

    // Handle change event for user ID
    $(document).on('change', '#user_id', function() {
        let user_id = $(this).val();

        // Fetch already taken leave dates
        $.ajax({
            url: window.Laravel.routes.TakenDatesByUser,
            method: 'GET',
            data: { user_id: user_id }, // Pass user ID to the backend
            success: function(response) {
                disabledDateRanges = response.dates.map(function(range) {
                    return {
                        start: new Date(range.start_date),
                        end: new Date(range.end_date)
                    };
                });
                initializeDatepicker();
            },
            error: function() {
                console.error("Failed to fetch leave dates");
            }
        });
    });
});


/**
 * Pay Item Jquery start
 */
$(function() {
    //Show and Hide form field on base of taxflag selected or change
    // Function to show/hide fields based on taxflag value
    function toggleFields(taxflag) {
        $('#superannuationFields').hide();
        $('#bankFields').hide();

        switch (taxflag) {
            case 'SE':
            case 'SEA':
            case 'SS':
            case 'SR':
            case 'SRA':
                $('#superannuationFields').show();
                break;

            case 'BC':
            case 'NN':
            case 'BD':
            case 'GD':
                $('#bankFields').show();
                break;

            default:
                // Hide all conditional fields if no match
                break;
        }
    }

    //ToggleFields Two
    function toggleFieldsPaymentType(ptype){
        //alert(ptype);
        switch(ptype){
            case 'F':
                $('#percentage_panel').hide();
                $('#fixed_panel').show();
                break;
            case 'P':
                $('#percentage_panel').show();
                $('#fixed_panel').show();
                break;
            default:
                //Hide all 
                $('#percentage_panel').hide();
                $('#fixed_panel').hide();
        }
    }

    // Trigger toggle on page load based on selected taxflag
    toggleFields($('#taxflag').val());

    //Trigger toggle on base of page load selected payment_mode
    toggleFieldsPaymentType($('#payment_mode').val());

    // Trigger toggle on taxflag change
    $(document).on('change','#taxflag', function() {
        toggleFields($(this).val());
    });


    /**
     *  By Default Add new Form Loading
     */
            $('#formTitle').text('Add New Pay Item');
            $('#payItemForm').trigger("reset");
            $('#payItemId').val('');
            $('#saveSettingsBtn').show();
            $('#cancelBtn').show();
            $('#modifyBtn').hide();
            $('#payItemForm input, #payItemForm select').prop('readonly', false);
    /**
     * End
     */

    // Show Add New Form
    $(document).on('click','#addNewBtn', function() {
        $('#formTitle').text('Add New Pay Item');
        $('#payItemForm').trigger("reset");
        $('#payItemId').val('');
        $('#saveSettingsBtn').show();
        $('#cancelBtn').show();
        $('#modifyBtn').hide();
        $('#payItemForm input, #payItemForm select').prop('readonly', false);
    });

    // Show Modify Mode
    $(document).on('click','#modifyBtn', function() {
        $('#saveSettingsBtn').show();
        $('#cancelBtn').show();
        $('#modifyBtn').hide();
        $('#payItemForm input:not(#code), #payItemForm select').prop('readonly', false);
    });

    // Cancel Edit/Add
    $(document).on('click','#cancelBtn', function() {
        $('#saveSettingsBtn').hide();
        $('#cancelBtn').hide();
        $('#modifyBtn').show();
        $('#payItemForm input, #payItemForm select').prop('readonly', true);
    });

    // Edit Pay Item
    var lastSelectedRow; // Declare a variable to store the last selected row
    $(document).on('click','.payitem-btn-edit', function() {
        var row = $(this).closest('tr');
        var payItemId = row.data('id');

        if (lastSelectedRow) {
            lastSelectedRow.css('background-color', ''); // Reset color of the last selected row
        }

        $.ajax({
            url: `${window.Laravel.routes.PayItemEdit}/${payItemId}`,
            method: 'GET',
            success: function(data) {
                $('#formTitle').text('Edit Pay Item');
                $('#payItemId').val(data.id);
                $('#code').val(data.code);
                $('#name').val(data.name);
                $('#gl_account_id').val(data.glaccount);
                $('#accumulator_id').val(data.accumulator);
                $('#tax_rate').val(data.tax_rate);
                $('#spread_code').val(data.spread_code);
                $('#taxflag').val(data.taxflag);
                $('#bank_id').val(data.bank_id);
                $('#bank_detail_id').val(data.bank_detail_id);
                $('#superannuation_fund_id').val(data.superannuation_fund_id);
                $('#payment_mode').val(data.payment_mode);
                $('#fixed_amount').val(data.fixed_amount);
                $('#percentage').val(data.percentage);
                $('#sequence').val(data.sequence);
                $('#will_accure_leave').val(data.will_accure_leave);

                // Hide buttons initially
                $('#saveSettingsBtn').hide();
                $('#cancelBtn').hide();
                $('#modifyBtn').show();

                // Set fields to readonly
                $('#payItemForm input, #payItemForm select').prop('readonly', true);
                  // Add color to the selected row
                row.css('background-color', '#cfe2ff'); // Change to your desired color
                lastSelectedRow = row; // Update the last selected row

            },
            error: function(err) {
                console.log('Error:', err);
                alert('Failed to retrieve pay item data.');
            }
        });
    });

    // Save New or Updated Pay Item
    $(document).on('click', '#saveSettingsBtn', function() {
        var payItemId = $('#payItemId').val();
        var url = payItemId ? `${Laravel.routes.PayItemUpdate}/${payItemId}` : Laravel.routes.PayItemAdd;
        var method = payItemId ? 'POST' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: $('#payItemForm').serialize(),
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: payItemId ? 'Pay Item updated successfully!' : 'New Pay Item added successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page to see the changes
                });
            },
            error: function(err) {
                if (err.status === 422) {
                    // Laravel validation error
                    let errors = err.responseJSON.errors;
                    let errorMessages = '';

                    $.each(errors, function(key, value) {
                        errorMessages += value.join('<br>') + '<br>';
                    });

                    Swal.fire({
                        title: 'Validation Error!',
                        html: errorMessages,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // General error handling
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while saving the Pay Item!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });

    // Delete Pay Item
    $(document).on('click', '.payitem-btn-delete', function() {
        if(confirm('Are you sure you want to delete this pay item?')) {
            var payItemId = $(this).closest('tr').data('id');

            $.ajax({
                url: `${window.Laravel.routes.PayItemDel}/${payItemId}`,
                method: 'POST',
                data: {
                    _token: window.Laravel.csrfToken // Include the CSRF token
                },
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Pay Item deleted successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Reload the page to see the changes
                    });
                },
                error: function(err) {
                    Swal.fire({
                        title: 'Error deleting Pay Item!',
                        html: errorMessages,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

    //Create Pay JS
      // Departments Select All/Clear
      $('#select-all-departments').click(function() {
        $('input[name="departments[]"]').prop('checked', true);
    });
    $('#clear-all-departments').click(function() {
        $('input[name="departments[]"]').prop('checked', false);
    });

    // Pay Locations Select All/Clear
    $('#select-all-locations').click(function() {
        $('input[name="pay_locations[]"]').prop('checked', true);
    });
    $('#clear-all-locations').click(function() {
        $('input[name="pay_locations[]"]').prop('checked', false);
    });

    //Save Pay Reference Data
    // Save button click event
    $(document).on('click', '#save-button-payref', function () {
        // Collect data from the included employees table
        let includedEmployees = [];
        $('#included-table tbody tr').each(function () {
            let checkbox = $(this).find('.included-checkbox');
            if (checkbox.is(':checked')) {
                let emp_id = $(this).attr('data-id');
                includedEmployees.push(emp_id);
            }
        });

        //Collect data from the excluded employees table
        let excludedEmployees = [];
        $('#excluded-table tbody tr').each(function () {
            let checkbox = $(this).find('.excluded-checkbox');
            if (checkbox.is(':checked')) {
                let emp_id = $(this).attr('data-id');
                excludedEmployees.push(emp_id);
            }
        });

        // Check if any employee is selected
        if (includedEmployees.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No employees selected',
                text: 'Please select at least one employee to save.',
            });
            return;
        }

        //Get payref id
        let payRefId = $(this).data('payref-id');
        // alert(payRefId);
        // alert(includedEmployees);
        // AJAX request to save included employees
        $.ajax({
            url: window.Laravel.routes.SavePayRefInclEmpl,  // Using the corrected route variable
            method: 'POST',
            data: {
                _token: window.Laravel.csrfToken, // Include the CSRF token
                pay_reference_id: payRefId, // Dynamically pass the pay reference ID
                employees: includedEmployees,
                employees_exclude: excludedEmployees,
            },
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Employees saved successfully.',
                    }).then(() => {
                        // Optionally, reload the page or table to reflect changes
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred',
                    text: 'An error occurred while saving employees.',
                });
            }
        });
    });

    /*
      Add Employee Loans
     */
      $(document).on('click', '#add_loans_payref', function () {
    
        // Get the pay reference ID from the button data attribute
        let payRefId = $(this).data('payref-id');
    
        // Make the AJAX request to the server to handle leave addition
        $.ajax({
            url: window.Laravel.routes.PayRefAddLoanRoute, // Use your defined route
            method: 'POST',
            data: {
                _token: window.Laravel.csrfToken, // Include CSRF token for security
                pay_reference_id: payRefId, // Pay reference ID
            },
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken // CSRF token in header
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Loan Added',
                        text: 'Loan added successfully for the selected employees.',
                    }).then(() => {
                        // Reload the page to reflect changes, or update the table dynamically
                        //location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText); // Log detailed error
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred',
                    text: 'Unable to add leave for the selected employees. Please try again.',
                });
            }
        });
    });


    /*
      Add Employee Leave
     */
    $(document).on('click', '#add_leave_payref', function () {
    
        // Get the pay reference ID from the button data attribute
        let payRefId = $(this).data('payref-id');
    
        // Make the AJAX request to the server to handle leave addition
        $.ajax({
            url: window.Laravel.routes.PayRefAddLeaveRoute, // Use your defined route
            method: 'POST',
            data: {
                _token: window.Laravel.csrfToken, // Include CSRF token for security
                pay_reference_id: payRefId, // Pay reference ID
            },
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken // CSRF token in header
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Leave Added',
                        text: 'Leave added successfully for the selected employees.',
                    }).then(() => {
                        // Reload the page to reflect changes, or update the table dynamically
                        //location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText); // Log detailed error
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred',
                    text: 'Unable to add leave for the selected employees. Please try again.',
                });
            }
        });
    });

    //Add Attendance

    $(document).on('submit', '#importAttendenceForm', function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken // CSRF token in header
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.success,
                }).then(() => {
                    location.reload(); // Reload the page to show the updated data
                });
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                for (var key in errors) {
                    errorMessage += errors[key] + "\n"; // Append error messages
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage || 'An error occurred while importing the data.',
                });
            }
        });
    });

    // Event listener for the 'View Slip' button
    $(document).on('click', '.view-payslip', function() {
        // Get employee_id and pay_ref_id from button data attributes
        var employeeId = $(this).data('emp-id');
        var payRefId = $(this).data('pay-ref-id');
        console.log('Employee Id'+ employeeId);
        console.log('Payment Ref Id'+ payRefId);
        
        // Make an AJAX request to fetch the pay slip
        $.ajax({ 
            url: window.Laravel.routes.PayRefEmpSlip + '/' + employeeId + '/' + payRefId,
            type: 'GET',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken // CSRF token in header
            },
            success: function(response) {
                // Update the pay slip section with the response HTML
                $('#payvars').html(response);
                
                // Scroll to the pay slip section (optional)
                $('html, body').animate({
                    scrollTop: $("#payvars").offset().top
                }, 1000);
            },
            error: function(xhr, status, error) {
                alert('An error occurred while fetching the pay slip. Please try again.');
            }
        });
    });

    //Get Bank Details in pay location create page
    $('.payrollBdtls').hide();
    $(document).on('change', '.payrollBankId', function() {
        var bankId = $(this).val();
    
        if (bankId) {
            // Make the AJAX call to fetch bank details
            $.ajax({
                url: window.Laravel.routes.PayLocationBankDetails + '/' + bankId,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken // CSRF token in header
                },
                success: function(response) {
                    if (response.message === 'success') {
                        // Populate the bank detail dropdown with the fetched data
                        $('.payrollBdtls').show();
                        $('#payroll_bank_detail_id').html(response.bank_details);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No bank details found.',
                        });
                        $('#payroll_bank_detail_id').html('');
                        $('.payrollBdtls').hide();
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.status || 'An error occurred while fetching the bank details. Please try again.',
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select a valid bank.',
            });
        }
    });

    //Employee Superannuation change
    // jQuery to auto-fill the form fields when a superannuation is selected
    $(document).on('change', '#empl_superannuation_id', function() {
        console.log('superannuation_id: '+$(this).val())
        var selectedOption = $(this).find('option:selected');
        var superannuationData = selectedOption.data('superannuation');
        console.log('Suuper'+superannuationData);
        if (superannuationData) {
            $('#employer_contribution_percentage').val(superannuationData.employer_contribution_percentage);
            $('#employer_contribution_fixed_amount').val(superannuationData.employer_contribution_fixed_amount);
            $('#bank_name').val(superannuationData.bank_name);
            $('#bank_address').val(superannuationData.bank_address);
            $('#bank_account_number').val(superannuationData.employment_account_number);
            $('#employer_superannuation_no').val(superannuationData.employer_superannuation_no);
        } else {
            // Clear fields if no superannuation selected
            $('#employer_contribution_percentage, #employer_contribution_fixed_amount, #bank_name, #bank_account_number, #employer_name, #employer_superannuation_no').val('');
        }
    });
    

    //Generate Attendence
    $(document).on('submit', '#generateAttendanceSheet', function (e) {
        e.preventDefault(); // Prevent the default form submission
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken // CSRF token in header
            },
            
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                });
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON.message || 'Something went wrong.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    });

     //Approve Waiting Confirm
     $(document).on("click", ".waitingConfirm", function(e){
        e.preventDefault();
        $payrefid = $(this).data('payrefid');
        $.ajax({
            url: window.Laravel.routes.PayRefPayItemSubmit+'/'+$payrefid,
            type: 'GET',
            data: {'pay_ref_id': $payrefid},
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken // CSRF token
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                });
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON?.message || 'Something went wrong.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    });

    //rejectConfirmForm
    $(document).on("click", ".rejectConfirmForm", function(e) {
        e.preventDefault();
        let payrefid = $(this).data('payrefid');
    
        // SweetAlert confirmation before deleting
        Swal.fire({
            title: 'Are you sure?',
            text: "Reject Payref?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with AJAX request if confirmed
                $.ajax({
                    url: window.Laravel.routes.PayRefPayItemReject + '/' + payrefid,
                    type: 'GET',
                    data: {'pay_ref_id': payrefid},
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON?.message || 'Something went wrong.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                        });
                    }
                });
            }
        });
    });
    
    
});

    //Add Pay Item in PayReference
    $(document).ready(function() {
        $('.add-payitem-payref').click(function(){
            var empid = $(this).data('emp-id');
            if(empid){
                $('#payrefempid').val(empid);
            }
        });
        $('#payItemForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
    
            // Collect form data
            let formData = $(this).serialize(); // Serialize the form data
    
            $.ajax({
                url: $(this).attr('action'), // Get the form action URL
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(function() {
                            $('#addPayRefPayItem').modal('hide');
                            // Optionally reload the page or table data here
                        });
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessage
                    });
                }
            });
        });
    });
    
/**
 * Pay Reference Calendar date selection
 */

$(function() {

    //Set default value
    var daysCount = 13; // Number of days to add to start date

    //Get Dasy Count 
    $.ajax({
        url: window.Laravel.routes.PayRefSalaryDays,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.message === 'success') {
                daysCount = response.days_count-1; // Assign the days count to a variable
                console.log('Days Count:', daysCount); // Output the result
            } else {
                console.log('Failed to get days count.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error occurred:', error);
        }
    });
   

    // Initialize Start Date Picker
    $("#pay_period_start_date").datepicker({
        dateFormat: "dd-mm-yy",
        onSelect: function(selectedDate) {
            var startDate = $(this).datepicker("getDate");
            if (startDate) {
                var endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + daysCount);

                // Set end date and disable other dates
                $("#pay_period_end_date").datepicker("setDate", endDate).datepicker("option", "beforeShowDay", function(date) {
                    return [(date.getTime() === endDate.getTime()), ""];
                });
            }
        }
    });

    // Initialize End Date Picker
    $("#pay_period_end_date").datepicker({
        dateFormat: "dd-mm-yy"
    });

    // Open datepicker when clicking on calendar icons
    $("#start_date_icon").click(function() {
        $("#pay_period_start_date").focus();
    });

    $("#end_date_icon").click(function() {
        $("#pay_period_end_date").focus();
    });

    $("#date_picker_icon").click(function() {
        $('#datepicker').focus();
    });

    $("#date_picker_icon2").click(function() {
        $('#datepicker2').focus();
    });

    $("#date_picker_icon3").click(function() {
        $('#datepicker3').focus();
    });

   
});

$(document).ready(function() {
    $('#company_bank_id').change(function() {
        var bankId = $(this).val();

        // Clear fields if no bank is selected
        if (!bankId) {
            $('#comp_bank_detail_id').empty().append('<option value="">Select Bank detail</option>');
            $('#comp_setting_table_name').val('');
            $('#comp_bank_setting_id').val('');
            $('#comp_transaction_fee').val('');
            return;
        }

        // Make AJAX call to fetch bank details
        $.ajax({
            url: window.Laravel.routes.CompanyBankDetails + '/' + bankId, // Ensure this route is correctly defined
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(JSON.stringify(response)); // Log the entire response for debugging
                
                // Parse the bank_details if it is a string
                var bankDetails = typeof response.bank_details === 'string' ? JSON.parse(response.bank_details) : response.bank_details;

                // Clear the dropdown before appending new options
                $('#comp_bank_detail_id').empty().append('<option value="">Select Bank detail</option>');
                
                // Check if `bankDetails` is an array and has items
                if (Array.isArray(bankDetails) && bankDetails.length > 0) {
                    // Loop through each bank detail and add it to the dropdown
                    $.each(bankDetails, function(index, bankDetail) {
                        $('#comp_bank_detail_id').append('<option value="' + bankDetail.id + '">' + bankDetail.bank_detail_name + '</option>');
                    });
                } else {
                    $('#comp_bank_detail_id').append('<option value="">No Bank details found</option>');
                }

                // Set Bank Setting Id and Transaction Fee if they exist
                if (response.setting_table_name) {
                    $('#comp_setting_table_name').val(response.setting_table_name);
                } else {
                    $('#comp_setting_table_name').val('');
                }
                

                if (response.bank_setting_id) {
                    $('#comp_bank_setting_id').val(response.bank_setting_id);
                } else {
                    $('#comp_bank_setting_id').val('');
                }
                
                if (response.transaction_fee) {
                    $('#comp_transaction_fee').val(response.transaction_fee);
                } else {
                    $('#comp_transaction_fee').val('');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Bank details not found or an error occurred.');
            }
        });
    });

      // Trigger the change event on page load to pre-fill data if a bank is already selected
      $('#company_bank_id').trigger('change');
});


//Tab Selection on page load first check if page load then get hash value exist then select that tablink
$(document).ready(function () {
    if (window.location.hash) {
        console.log('Hash value found: ' + window.location.hash);
        let hashValue = window.location.hash;

        // Find the element with href matching the hash value
        let matchingTabLink = $('.emp-tablink').filter(function () {
            return $(this).attr('href') === hashValue;
        });

        if (matchingTabLink.length) {
             // Remove aria-selected="true" from all tab links (optional, for clarity)
             $('.emp-tablink').attr('aria-selected', false);

             // Add aria-selected="true" to the matching tab
             matchingTabLink.attr('aria-selected', true);
             matchingTabLink.click();
        } else {
            console.log('Dom Not Found!');
        }
    } else {
        console.log('Hash value not found');
    }
});

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.department-multiple').select2();
});

//
$(document).ready(function () {
    $('#cost_center').change(function () {
        var costCenterId = $(this).val();
        
        if (costCenterId) {
            $.ajax({
                url: '/get-departments-by-cost-center/' + costCenterId,  // Adjust the URL based on your route
                method: 'GET',
                success: function (response) {
                    var departmentSelect = $('#department');
                    departmentSelect.empty(); // Clear previous departments
                    response.departments.forEach(function (department) {
                        departmentSelect.append(new Option(department.department, department.id));
                    });

                    // Handle the dynamic creation of share percentage fields
                    var sharePercentages = response.sharePercentages;
                    var sharePercentageFields = $('#share_percentage_fields');
                    sharePercentageFields.empty(); // Clear any previous fields

                    // Generate input fields for each department's share percentage
                    response.departments.forEach(function (department) {
                        var sharePercentage = sharePercentages[department.id] || '';
                        var fieldHtml = `
                            <div class="form-group">
                                <label for="share_percentage_${department.id}">${department.department} Share Percentage</label>
                                <input type="text" class="form-control" name="cost_center_share_percentage[${department.id}]" id="share_percentage_${department.id}" value="${sharePercentage}" />
                            </div>
                        `;
                        sharePercentageFields.append(fieldHtml);
                    });
                }
            });
        }
    });
});

//Salary Calculator
$(document).ready(function(){
    // Initialize Select2 for better dropdown UX (if used)
    //$('select').select2();

    // Sync tax residency to hidden field
    $('#tax_residency').on('change', function(){
        $('#resident_status').val($(this).val());
    });

    // Sync dependents to hidden field
    $('#no_of_dependent_frm').on('change', function(){
        $('#no_of_dependent').val($(this).val());
    });

    // Fetch area name when place is selected
    $('#hr_place').on('change', function(){
        let placeId = $(this).val();
        if (placeId) {
            $.ajax({
                url: window.Laravel.routes.SalaryCalculatorHRArea,
                type: 'GET',
                data: { id: placeId },
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                success: function(data) {
                    $('#hr_area').val(data.area_name);
                    updateHRA();
                },
                error: function() {
                    $('#hr_area').val('');
                    $('#house_rent_allowance').val('');
                }
            });
        } else {
            $('#hr_area').val('');
            $('#house_rent_allowance').val('');
        }
    });

    // Update HRA when HRA type or rent amount changes
    $('#hra_type, #hra_amount_per_week').on('change', updateHRA);

    function updateHRA() {
        let hraType = $('#hra_type').val();
        let rentAmount = parseFloat($('#hra_amount_per_week').val()) || 0;
        let areaType = $('#hr_area').val();

        if (hraType && rentAmount && areaType && hraType !== '3') {
            $.ajax({
                url: window.Laravel.routes.SalaryCalculatorHRA,
                type: 'GET',
                data: { amount: rentAmount, hra_type: hraType, area_type: areaType },
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                success: function(data) {
                    $('#house_rent_allowance').val(data.amount.toFixed(2));
                },
                error: function() {
                    $('#house_rent_allowance').val('');
                }
            });
        } else {
            $('#house_rent_allowance').val('');
        }
    }

    // Fetch vehicle allowance when vehicle type changes
    $('#va_type').on('change', function(){
        let vaType = $(this).val();
        if (vaType && vaType !== '3') {
            $.ajax({
                url: window.Laravel.routes.SalaryCalculatorVehicle,
                type: 'GET',
                data: { type: vaType },
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                success: function(data) {
                    $('#vehicle_allowance').val(data.amount.toFixed(2));
                },
                error: function() {
                    $('#vehicle_allowance').val('');
                }
            });
        } else {
            $('#vehicle_allowance').val('');
        }
    });

    // Fetch meals allowance when checkbox is toggled
    $('#meals_tag').on('change', function(){
        if ($(this).is(':checked')) {
            $.ajax({
                url: window.Laravel.routes.SalaryCalculatorMeals,
                type: 'GET',
                data: { type: 1 }, // Adjust ID as needed
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                success: function(data) {
                    $('#meals_allowance').val(data.amount.toFixed(2));
                },
                error: function() {
                    $('#meals_allowance').val('');
                }
            });
        } else {
            $('#meals_allowance').val('');
        }
    });

    // Update superannuation contribution percentage and tax method
    $('#superannuation_id').on('change', function(){
        let contribution = $(this).find(':selected').data('contribution') || 0;
        let taxMethod = $(this).find(':selected').data('tax-method') || 'None';
        $('#employer_contribution_percentage').val(contribution.toFixed(2));
        // Optionally display taxMethod (e.g., in a hidden field or UI element)
        // $('#tax_method_display').text(taxMethod); // Uncomment if needed
    });

    // Form submission
    $('#salaryCalcForm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: window.Laravel.routes.SalaryCalculator,
            type: 'POST',
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
            success: function(data) {
                $('#resultBox').show();

                // Populate output table
                $('#slip_basic_salary').text(data.basic_salary);
                $('#slip_house_rent_allowance').text(data.house_rent_allowance);
                $('#slip_vehicle_allowance').text(data.vehicle_allowance);
                $('#slip_meals_allowance').text(data.meals_allowance);
                $('#slip_medical_allowance').text(data.medical_allowance);
                $('#slip_special_allowance').text(data.special_allowance);
                $('#slip_other_allowance').text(data.other_allowance);
                $('#slip_electricity_allowance').text(data.electricity_allowance);
                $('#slip_security_allowance').text(data.security_allowance);
                $('#gross_salary').text(data.gross_salary);
                $('#tax_deduction').text(data.tax_deduction);
                $('#slip_provident_fund_deduction').text(data.provident_fund_deduction);
                $('#rebate').text(data.rebate);
                $('#total_deduction').text(data.total_deduction);
                $('#net_salary').text(data.net_salary);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || { general: ['Error calculating salary. Please check inputs.'] };
                let errorMessage = Object.values(errors).flat().join('\n');
                alert(errorMessage);
            }
        });
    });
});