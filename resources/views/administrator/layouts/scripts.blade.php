<!-- New Theme CSS -->
 <!-- plugins:js -->
 <script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('backend/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('backend/js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('backend/js/off-canvas.js') }}"></script>
  <script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('backend/js/template.js') }}"></script>
  <script src="{{ asset('backend/js/settings.js') }}"></script>
  <script src="{{ asset('backend/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('backend/js/dashboard.js') }}"></script>
  <script src="{{ asset('backend/js/Chart.roundedBarCharts.js') }}"></script>
  <!-- End custom js for this page-->


<!-- Common JS for New Features JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Include jQuery and jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
@include('administrator.variables')
<script src="{{ asset('backend/common.js') }}"></script>
<script src="{{ asset('backend/banksetup.js') }}"></script>
<script src="{{ asset('backend/employeeSalCal.js') }}"></script>
<!-- Common JS End -->

<!-- Old Payhours JS library Included -->
<!-- Select2 -->
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('backend/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('backend/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('backend/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap datepicker -->
<!-- <script src="{{ asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> -->
<!-- bootstrap color picker -->
<script src="{{ asset('backend/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Old Payhours JS Library Included End -->

<!-- new code added -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script>
    // $(document).ready(function () {
    //     $('.sidebar-menu').tree()
    // })
</script>
<!-- For fadeout notifications -->
<script>
    $(document).ready(function () {
        $("#notification_box").fadeOut(4000);
    });
</script>

<script>
function updateDate2() {
    let dt1 = document.getElementById('salary_frm_date').value;
    let newdt1 = new Date(dt1);
    let newdt2 = newdt1.setDate(newdt1.getDate() + 13);
    let dt2 = new Date(newdt2);
    // Get reference to the date2 input
    //const dt1 = document.getElementById('salary_frm_date').value;
    //var dt2 = dt1;
    //const days = 14;
    // Set the value of date2 input to the value of date1 input
    //var dt2 = new Date(dt1 + (1000 * 60 * 60 * 24 * 14));
    const day = dt2.getDate().toString().padStart(2, '0');
    const month = (dt2.getMonth() + 1).toString().padStart(2, '0');
    const year = dt2.getFullYear();
    dt2 = `${year}-${month}-${day}`;    
    $("#salary_to_date").val(dt2);
}
</script>

<!-- For Data Table -->
<script>
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    });
</script>
<!-- For Date Picker -->
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'});
        //Money Euro
        $('[data-mask]').inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
        );

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            //format: "yyyy-mm-dd"
            dateFormat: "dd-mm-yy"
        });
        $('#datepicker').datepicker('setDate', 'now');

        //Date picker
        $('#datepicker2').datepicker({
            autoclose: true,
            //format: "yyyy-mm-dd"
            dateFormat: "dd-mm-yy"
        });
        $('#datepicker2').datepicker('setDate', 'now');

        //Date picker
        $('#datepicker3').datepicker({
            autoclose: true,
            //format: "yyyy-mm-dd"
            dateFormat: "dd-mm-yy"
        });

        //Date picker
        $('#datepicker4').datepicker({
            autoclose: true,
            //format: "yyyy-mm-dd"
            dateFormat: "dd-mm-yy"
        });

        //Month picker
        $('#monthpicker').datepicker({
            autoclose: true,
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months"
        });
        $('#monthpicker').datepicker('setDate', 'now');

        //Month picker
        $('#monthpicker2').datepicker({
            autoclose: true,
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months"
        });


        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $('.my-colorpicker1').colorpicker();
        //color picker with addon
        $('.my-colorpicker2').colorpicker();

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        });
    });
</script>
<!-- For All Type of Print -->
<script type="text/javascript">
    function printDiv(printable_area) {
     var printContents = document.getElementById(printable_area).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
 }
</script>
<!-- For Active Menu -->
<script type="text/javascript">
    //  $('#mainMenu ul li').find('a').each(function () {
    //         if (document.location.href == $(this).attr('href')) {
    //             $(this).parents().addClass("active");
    //             $(this).addClass("active");
    //             // add class as you need ul or li or a
    //         }
    //     });

    document.addEventListener('DOMContentLoaded', () => {
    // Get the current URL
    const currentUrl = window.location.href;

    // Get all sidebar links
    const sidebarLinks = document.querySelectorAll('#sidebar .nav-link');

    // Iterate through each link to set active state
    sidebarLinks.forEach(link => {
        // Check if the link's href matches the current URL
        if (link.href === currentUrl) {
            // Add 'active' class to the link
            link.classList.add('active');

            // Find the closest collapsible parent and add 'show' class to expand it
            const collapsibleParent = link.closest('.collapse');
            if (collapsibleParent) {
                collapsibleParent.classList.add('show');

                // Add 'active' class to the parent menu item
                const parentNavItem = collapsibleParent.previousElementSibling;
                if (parentNavItem) {
                    parentNavItem.classList.add('active');
                }
            }
        } else {
            // Remove the 'active' class if it's not the current URL
            link.classList.remove('active');
        }
    });
});

</script>

 <!-- =================Data Search================== -->
                <script>
                $(document).ready(function(){
                 $("#myInput").on("keyup", function() {
                   var value = $(this).val().toLowerCase();
                   $("#myTable tr").filter(function() {
                     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                   });
                 });
                });
                </script>
 <!-- =================Data Search================== -->



