
    (function($){
        $(document).ready(function(){
            $("#hr_place").on("change", function(){
                  var hra_place_id = $("#hr_place").val();
                  console.log('HRA place ID: '+hra_place_id);
                  if(hra_place_id >= 1) {
                    $.ajax({
                        type: "get",
                        url: window.Laravel.routes.EmplPayrollHRAAreaSrc + "/" + hra_place_id,
                        success: function(response) {
                            console.log('response'+response);
                            $("#hr_area").val(response);
                            $('#hr_area').attr('value', response);
                            //console.log('HRA Area: '+hra_area1);
                            if(hra_area1 == "" || hra_area1 == 'Area 3') {
                              $('#hra_amount_per_week').attr('readonly', true);
                              $('#hra_type').attr('readonly', true);
                              $('#hra_amount_per_week').val('');
                              $('#house_rent_allowance').val('');
                            }else{
                              $('#hra_amount_per_week').attr('readonly', false);
                              $('#hra_type').attr('readonly', false);                  
                              $('#hra_amount_per_week').val('');
                              $('#house_rent_allowance').val('');
                            }
                        },
                        error:function(err){

                        }
                    })
                  }
                  //$("#hr_area").val(hra_area1);
                  // hra_area1 = $("#hr_area").val();
                  // if(hra_area1 == "" || hra_area1 == 'Area 3') {
                  //   $('#hra_amount_per_week').attr('readonly', true);
                  //   $('#hra_type').attr('readonly', true);
                  //   $('#hra_amount_per_week').val('');
                  //   $('#house_rent_allowance').val('');
                  // }else{
                  //   $('#hra_amount_per_week').attr('readonly', false);
                  //   $('#hra_type').attr('readonly', false);                  
                  //   $('#hra_amount_per_week').val('');
                  //   $('#house_rent_allowance').val('');
                  // }
            })

            $("#hra_amount_per_week").on("keyup", function(){
                var hra_rent = $("#hra_amount_per_week").val();
                var hra_type = $("#hra_type").val();

                  if(parseInt(hra_rent) >0 ){
                    if(hra_type == 0 || hra_type == null){
                      alert("Please select Housing Allowance Type...");
                      $("#hra_amount_per_week").val('');
                      return;
                    }
                  }else{
                    $("#house_rent_allowance").val(0);
                    return;
                  }

                var area_type = $("#hr_area").val(); //'Area 1';
                if(hra_rent) {
                    $.ajax({
                        type: "get",
                        url: window.Laravel.routes.EmplPayrollHRA + "/" + hra_rent + "/" + hra_type+ "/" + area_type,
                        success: function(response) {
                            console.log(response);
                            $("#house_rent_allowance").val(response);
                        },
                        error:function(err){

                        }
                    })
                }
            })
            
            $("#va_type").on("change", function(){
                // alert("finally bye");
                var va_type = $("#va_type").val();
                if(va_type>=1 && va_type<=2) {
                    $.ajax({
                        type: "get",
                        url: window.Laravel.routes.EmplPayrollVehicle + "/" + va_type,
                        success: function(response) {
                            console.log(response);
                            $("#vehicle_allowance").val(response);
                            $("#vehicle_allowance").attr('value',response);
                        },
                        error:function(err){

                        }
                    })
                } else {
                  $("#vehicle_allowance").val('');
                  $("#vehicle_allowance").attr('value','');
                  return;
                }
            })

            $("#meals_tag").on("click", function(){
                var meals_type = $("#meals_tag").is(":checked");
                if(meals_type) {
                    $.ajax({
                        type: "get",
                        url: window.Laravel.routes.EmplPayrollMeals + "/" + '3',
                        success: function(response) {
                            console.log(response);
                            $("#meals_allowance").val(response);
                        },
                        error:function(err){

                        }
                    })
                }else{
                  $("#meals_allowance").val('');
                  return;
                }
            })

            $("#overtime_hrs").on("keyup", function(){
                var overtime_hrs = $("#overtime_hrs").val();
                var overtime_rate = $("#overtime_rate").val();
                var overtime_amt = +overtime_hrs * +overtime_rate;
                $("#overtime_amt").val(overtime_amt);
            })
            $("#overtime_rate").on("keyup", function(){
                var overtime_hrs = $("#overtime_hr").val();
                var overtime_rate = $("#overtime_rate").val();
                var overtime_amt = +overtime_hrs * +overtime_rate;
                $("#overtime_amt").val(overtime_amt);
            })

            $("#taxcal").on("click", function(){
                 //alert("finally bye");
                var gross_sal = $("#gross_salary").val();
                var dependent = $("#no_of_dependent").val();
                if(dependent == ""){
                  dependent = 0;
                }
                var resident_status = $("#resident_status").val();
                if(gross_sal == 0 || gross_sal == '' || resident_status == null){
                  return;
                }
                console.log('Gross Sal: '+gross_sal);
                console.log("Dependent: "+dependent);
                $.ajax({
                    type: "get",
                    url: window.Laravel.routes.EmplPayrollTaxCal + "/" + gross_sal + "/" + dependent + "/" + resident_status,
                    success: function(response) {
                        console.log(response);
                        $("#tax_deduction_a").val(parseFloat(response.frt_tax_amt).toFixed(2));
                        calculation();
                    },
                    error:function(err){
                        console.log('Error: '+err);
                    }
                })
            })

            // No of Dependent click
            //When page load
            let dep = $('#no_of_dependent_frm').val();
            $('#no_of_dependent').val(dep);
            //if change value 
            $('#no_of_dependent_frm').on("change", function () {
                // Get dependent value
                let dep = $(this).val();
                $('#no_of_dependent').val(dep);
                tax_calculation();
            });

            //When residetnt status change
            let restxn = $('#tax_residency').val();
            $('#resident_status').val(restxn);

            $('#tax_residency').on("change", function(){
                //Get Resident status
                let restxn  = $(this).val();
                $('#resident_status').val(restxn);
                tax_calculation();
            });
            

      });
    })(jQuery);

  // For Kepp Data After Reload
  //document.forms['employee_select_form'].elements['user_id'].value = "{{ session('inserted_id') }}";


 
  $(document).ready(function(){
    calculation();
  });


  //For Calculation
  $(document).on("keyup", "#employee_salary_form", function() {
    calculation();
    tax_calculation();
  });

  function calculation() {
    var sum = 0;
    var basic_salary = $("#basic_salary").val();
    //var overtime_amt = $("#overtime_amt").val();
    //var sales_comm = $("#sales_comm").val();
    var house_rent_allowance = $("#house_rent_allowance").val();
    var vehicle_allowance = $("#vehicle_allowance").val();
    var meals_allowance = $("#meals_allowance").val();
    var electricity_allowance = $("#electricity_allowance").val();
    var security_allowance = $("#security_allowance").val();
    var medical_allowance = $("#medical_allowance").val();
    var special_allowance = $("#special_allowance").val(); // Telephone
    var provident_fund_contribution = $("#provident_fund_contribution").val();
    var other_allowance = $("#other_allowance").val();  //Servant
    var tax_deduction_a = $("#tax_deduction_a").val();
    var tax_deduction_a = $("#tax_deduction_a").val();
    var provident_fund_deduction = $("#provident_fund_deduction").val();
    // var other_deduction = $("#other_deduction").val();

    //var gross_salary = (basic_salary + house_rent_allowance + vehicle_allowance + meals_allowance + electricity_allowance + security_allowance + medical_allowance + special_allowance + other_allowance);
    //var gross_salary = (+basic_salary + +house_rent_allowance + +vehicle_allowance + +meals_allowance + +electricity_allowance + +security_allowance + +medical_allowance + +special_allowance + +other_allowance);
    //var gross_salary = +basic_salary + +overtime_amt + +sales_comm + +house_rent_allowance + +medical_allowance + +special_allowance + +other_allowance + +vehicle_allowance + +meals_allowance + +electricity_allowance + +security_allowance;
    
    var gross_salary = +basic_salary + +house_rent_allowance + +medical_allowance + +special_allowance + +other_allowance + +vehicle_allowance + +meals_allowance + +electricity_allowance + +security_allowance;
    //var gross_salary = basic_salary + house_rent_allowance + medical_allowance + special_allowance + other_allowance + vehicle_allowance + meals_allowance + electricity_allowance + security_allowance;
    console.log('gross_salary222: '+gross_salary);
    //var total_deduction = parseFloat(+tax_deduction + +provident_fund_deduction + +other_deduction);
    var total_deduction = +tax_deduction_a + +provident_fund_deduction;

    $("#total_provident_fund").val(+provident_fund_contribution + +provident_fund_deduction);

    $("#gross_salary").val(gross_salary);
    $("#total_deduction").val(total_deduction);
    $("#net_salary").val((+gross_salary - +total_deduction).toFixed(2));
  }

    function tax_calculation(){
      var gross_sal = $("#gross_salary").val();
        var dependent =  $("#no_of_dependent").val();
        var resident_status = $("#resident_status").val();

        console.log('Gross Sal'+gross_sal);
        console.log("Dependent"+dependent);
        console.log("Resident Status"+resident_status);
        $.ajax({
            type: "get",
            url: window.Laravel.routes.EmplPayrollTaxCal + "/" + gross_sal + "/" + dependent + "/" + resident_status,
            success: function(response) {
                console.log(response);
                $("#tax_deduction_a").val(parseFloat(response.frt_tax_amt).toFixed(2));
                calculation();
            },
            error:function(err){
                console.log('Error: '+err);
            }
        })
    }
   


    $(document).ready(function() {
        function updateAnnualSalary() {
            var basicSalary = parseFloat($('#basic_salary').val());
            if (!isNaN(basicSalary)) {
                var annualSalary = basicSalary * 26;
                $('#annual_salary').val(annualSalary.toFixed(2));
                updateHourlyRate();
            }
        }

        function updateBasicSalary() {
            var annualSalary = parseFloat($('#annual_salary').val());
            if (!isNaN(annualSalary)) {
                var basicSalary = annualSalary / 26;
                $('#basic_salary').val(basicSalary.toFixed(2));
                updateHourlyRate();
            }
        }

        function updateHourlyRate() {
            var annualSalary = parseFloat($('#annual_salary').val());
            var basicSalary = parseFloat($('#basic_salary').val());
            var hourlyRate;

            if (!isNaN(annualSalary)) {
                hourlyRate = ((annualSalary / 26) / 14) / 8;
            } else if (!isNaN(basicSalary)) {
                hourlyRate = (basicSalary / 14) / 8;
            }

            if (hourlyRate !== undefined) {
                $('#hrly_salary_rate').val(hourlyRate.toFixed(2));
            }
        }

        $('#basic_salary').on('input', function() {
            updateAnnualSalary();
        });

        $('#annual_salary').on('input', function() {
            updateBasicSalary();
        });
    });

