<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BranchManagementController;
use App\Http\Controllers\BankManagementController;
use App\Http\Controllers\PayBatchNumberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PayLocationController;
use App\Http\Controllers\GLCodeController;
use App\Http\Controllers\PayAccumulatorController;
use App\Http\Controllers\SuperannuationController;
use App\Http\Controllers\{
    PeriodDefinationRateController,
    GlInterfaceControlFileController,
    BspBankTransferSetupController,
    AnzBankTransferSetupController,
    WpacBankTransferSetupController,
    KinaBankTransferSetupController,
    PayItemController,
    CurrencyController
};
use App\Http\Controllers\{
    PayReferenceController,
    LeaveApplicationController,
    LeaveCatController,
	LeaveAppController,
    EmpDesignationController,
    CustomerController,
    CustomerTypeController,
    EmplDepartmentController,
    LoanMasterController,
    EmpReferenceController,
    EmplController,
    FolderController,
    FileController,
    ProfileController,
    // InvoiceController,
    // SmsController,
    AttendanceController,
    PayrollController,
	IncrementController,
	BonusController,
	DeductionController,
	LoanController,
	SalaryPaymentController,
	WorkingDayController,
	HolidayController,
	PersonalEventController,
	NoticeController,
	ExpenceManagementController,
	AwardCategoryController,
	EmployeeAwardController,
	OvertimeController,
	EmplContactController,
	BankDetailController,
	CompanyController,
	SuperAnnuationReportController,
	CostCenterController,
	SalaryCalculatorController
};

header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

// Auth::routes(['login' => false]);
//Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'logout'])->name('logout');
//Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/', 'Auth\LoginController@login')->name('login');;
Auth::routes();

Route::group(['prefix' => 'setting', 'middleware' => 'auth', 'as' => 'setting.'], function () {
    Route::resource('role', RoleController::class);
});

Route::group(['middleware' => 'auth'], function () {

	//Route::get('/dashboard', 'HomeController@index')->name('dashboard');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

	// Branch Management
	Route::prefix('setting/branches')->name('branches.')->group(function () {
		Route::get('/', [BranchManagementController::class, 'index'])->name('index');
		Route::get('/create', [BranchManagementController::class, 'create'])->name('create');
		Route::post('/store', [BranchManagementController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [BranchManagementController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [BranchManagementController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [BranchManagementController::class, 'destroy'])->name('destroy');
	});

	// Branch Management
	Route::prefix('setting/departments')->name('departments.')->group(function () {
		Route::get('/', [EmplDepartmentController::class, 'index'])->name('index');
		Route::get('/create', [EmplDepartmentController::class, 'create'])->name('create');
		Route::post('/store', [EmplDepartmentController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [EmplDepartmentController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [EmplDepartmentController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [EmplDepartmentController::class, 'destroy'])->name('destroy');
	});

	// Bank Listing
	Route::prefix('setting/bank_lists')->name('banks.')->group(function () {
		Route::get('/', [BankManagementController::class, 'index'])->name('index');
		Route::get('/create', [BankManagementController::class, 'create'])->name('create');
		Route::post('/store', [BankManagementController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [BankManagementController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [BankManagementController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [BankManagementController::class, 'destroy'])->name('destroy');
	});

	// Pay Batch Number
	Route::prefix('setting/pay_batch_numbers')->name('pay_batch_numbers.')->group(function () {
		Route::get('/', [PayBatchNumberController::class, 'index'])->name('index');
		Route::get('/create', [PayBatchNumberController::class, 'create'])->name('create');
		Route::post('/store', [PayBatchNumberController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [PayBatchNumberController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [PayBatchNumberController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [PayBatchNumberController::class, 'destroy'])->name('destroy');
	});
	
	// Pay Location Section //
	Route::prefix('setting/pay_locations')->name('pay_locations.')->group(function () {
		Route::get('/', [PayLocationController::class, 'index'])->name('index');
		Route::get('/create', [PayLocationController::class, 'create'])->name('create');
		Route::post('/store', [PayLocationController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [PayLocationController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [PayLocationController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [PayLocationController::class, 'destroy'])->name('destroy');
		Route::get('/bank_detail/{id}', [PayLocationController::class, 'getBankDetail'])->name('bank_detail');
	});

	// GL Code Section //
	Route::prefix('setting/gl_codes')->name('gl_codes.')->group(function () {
		Route::get('/', [GLCodeController::class, 'index'])->name('index');
		Route::get('/create', [GLCodeController::class, 'create'])->name('create');
		Route::post('/store', [GLCodeController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [GLCodeController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [GLCodeController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [GLCodeController::class, 'destroy'])->name('destroy');
	});
	
	//Pay Accumulutaors
	Route::prefix('setting/pay_accumulators')->name('pay_accumulators.')->group(function () {
		Route::get('/', [PayAccumulatorController::class, 'index'])->name('index');
		Route::get('/create', [PayAccumulatorController::class, 'create'])->name('create');
		Route::post('/store', [PayAccumulatorController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [PayAccumulatorController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [PayAccumulatorController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [PayAccumulatorController::class, 'destroy'])->name('destroy');
	});
	
	//Superannuation
	Route::prefix('setting/superannuations')->name('superannuations.')->group(function () {
		Route::get('/', [SuperannuationController::class, 'index'])->name('index');
		Route::get('/create', [SuperannuationController::class, 'create'])->name('create');
		Route::post('/store', [SuperannuationController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [SuperannuationController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [SuperannuationController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [SuperannuationController::class, 'destroy'])->name('destroy');
	});
	
	// Period Definition Rates
	Route::prefix('setting/period_defination_rates')->name('period_defination_rates.')->group(function () {
		Route::get('/', [PeriodDefinationRateController::class, 'index'])->name('index');
		Route::get('/create', [PeriodDefinationRateController::class, 'create'])->name('create');
		Route::post('/store', [PeriodDefinationRateController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [PeriodDefinationRateController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [PeriodDefinationRateController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [PeriodDefinationRateController::class, 'destroy'])->name('destroy');
	});

	// GL Interface Control Files
	Route::prefix('setting/gl_interface_control_files')->name('gl_interface_control_files.')->group(function () {
		Route::get('/', [GlInterfaceControlFileController::class, 'index'])->name('index');
		Route::get('/create', [GlInterfaceControlFileController::class, 'create'])->name('create');
		Route::post('/store', [GlInterfaceControlFileController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [GlInterfaceControlFileController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [GlInterfaceControlFileController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [GlInterfaceControlFileController::class, 'destroy'])->name('destroy');
	});

	// BSP Bank Transfer Setup
	Route::prefix('setting/bsp_bank_transfer_setups')->name('bsp_bank_transfer_setups.')->group(function () {
		Route::get('/', [BspBankTransferSetupController::class, 'index'])->name('index');
		Route::post('/store_setting', [BspBankTransferSetupController::class, 'store'])->name('store');
		Route::get('/get-bank-transfer-setup', [BspBankTransferSetupController::class, 'getBankTransferSetup'])->name('get_setup');
		Route::post('/check-bank-exists', [BspBankTransferSetupController::class, 'checkBankExists'])->name('check_exists');
		Route::post('/store_bank', [BspBankTransferSetupController::class, 'storeBank'])->name('store_bank');
		Route::post('/remove', [BspBankTransferSetupController::class, 'removeBank'])->name('remove');
		Route::post('/update', [BspBankTransferSetupController::class, 'updateBank'])->name('update');
	});

	// ANZ Bank Transfer Setup
	Route::prefix('setting/anz_bank_transfer_setups')->name('anz_bank_transfer_setups.')->group(function () {
		Route::get('/', [AnzBankTransferSetupController::class, 'index'])->name('index');
		Route::post('/store_setting', [AnzBankTransferSetupController::class, 'store'])->name('store');
		Route::get('/get-anz-bank-transfer-setup', [AnzBankTransferSetupController::class, 'getBankTransferSetup'])->name('get_setup');
		Route::post('/check-anz-bank-exists', [AnzBankTransferSetupController::class, 'checkBankExists'])->name('check_exists');
		Route::post('/store_bank', [AnzBankTransferSetupController::class, 'storeBank'])->name('store_bank');
		Route::post('/remove', [AnzBankTransferSetupController::class, 'removeBank'])->name('remove');
		Route::post('/update', [AnzBankTransferSetupController::class, 'updateBank'])->name('update');
	});

	// Wpac Bank Transfer Setup
	Route::prefix('setting/wpac_bank_transfer_setups')->name('wpac_bank_transfer_setups.')->group(function () {
		Route::get('/', [WpacBankTransferSetupController::class, 'index'])->name('index');
		Route::post('/store_setting', [WpacBankTransferSetupController::class, 'store'])->name('store');
		Route::get('/get-wpac-bank-transfer-setup', [WpacBankTransferSetupController::class, 'getBankTransferSetup'])->name('get_setup');
		Route::post('/check-wpac-bank-exists', [WpacBankTransferSetupController::class, 'checkBankExists'])->name('check_exists');
		Route::post('/store_bank', [WpacBankTransferSetupController::class, 'storeBank'])->name('store_bank');
		Route::post('/remove', [WpacBankTransferSetupController::class, 'removeBank'])->name('remove');
		Route::post('/update', [WpacBankTransferSetupController::class, 'updateBank'])->name('update');
	});

	// Kina Bank Transfer Setup
	Route::prefix('setting/kina_bank_transfer_setups')->name('kina_bank_transfer_setups.')->group(function () {
		Route::get('/', [KinaBankTransferSetupController::class, 'index'])->name('index');
		Route::post('/store_setting', [KinaBankTransferSetupController::class, 'store'])->name('store');
		Route::get('/get-kina-bank-transfer-setup', [KinaBankTransferSetupController::class, 'getBankTransferSetup'])->name('get_setup');
		Route::post('/check-kina-bank-exists', [KinaBankTransferSetupController::class, 'checkBankExists'])->name('check_exists');
		Route::post('/store_bank', [KinaBankTransferSetupController::class, 'storeBank'])->name('store_bank');
		Route::post('/remove', [KinaBankTransferSetupController::class, 'removeBank'])->name('remove');
		Route::post('/update', [KinaBankTransferSetupController::class, 'updateBank'])->name('update');
	});

	// Pay Items
	Route::prefix('setting/pay_items')->name('pay_items.')->group(function () {
		Route::get('/', [PayItemController::class, 'index'])->name('index');
		Route::get('/create', [PayItemController::class, 'create'])->name('create');
		Route::post('/store', [PayItemController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [PayItemController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [PayItemController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [PayItemController::class, 'destroy'])->name('destroy');
	});

	// Currencies
	Route::prefix('setting/currencies')->name('currencies.')->group(function () {
		Route::get('/', [CurrencyController::class, 'index'])->name('index');
		Route::get('/create', [CurrencyController::class, 'create'])->name('create');
		Route::post('/store', [CurrencyController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [CurrencyController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [CurrencyController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [CurrencyController::class, 'destroy'])->name('destroy');
	});

		//
	// Pay References
	Route::prefix('process_pay/pay_references')->name('pay_references.')->group(function () {
		Route::get('/', [PayReferenceController::class, 'index'])->name('index');
		Route::get('/create', [PayReferenceController::class, 'create'])->name('create');
		Route::post('/store', [PayReferenceController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [PayReferenceController::class, 'edit'])->name('edit');
		Route::get('/show/{id}', [PayReferenceController::class, 'show'])->name('show');
		Route::post('/update/{id}', [PayReferenceController::class, 'update'])->name('update');
		Route::post('/destroy/{id}', [PayReferenceController::class, 'destroy'])->name('destroy');
		Route::post('/save_pay_reference', [PayReferenceController::class, 'savePayReferenceEmployees'])->name('pay_reference_employees.save');
		Route::post('/pay_reference_add_loan', [PayReferenceController::class, 'addLoanDetailsByPayReference'])->name('pay_reference_add_loan');
		Route::post('/pay_reference_add_leave', [PayReferenceController::class, 'addLeaveDetailsByPayReference'])->name('pay_reference_add_leave');
		Route::get('/payslip/{employee_id}/{pay_ref_id}', [PayReferenceController::class, 'showPaymentSlip'])->name('show_payment_slip');
		Route::post('/submit_pay_reference/{pay_ref_id}', [PayReferenceController::class, 'submitPayRef'])->name('pay_reference_submit');
		Route::get('/payslips', [PayReferenceController::class, 'viewpaySlipsByPayRef'])->name('view_payslips');
		Route::get('/payslips/all/{pay_ref_id}', [PayReferenceController::class, 'viewAllpaySlipsByPayRef'])->name('payref.allpayslips');
		Route::get('/status_enquiry', [PayReferenceController::class, 'payrefStatusEnquiry'])->name('payref.statusEnquiry');
		Route::get('/export-payslips/{pay_reference_id}', [PayReferenceController::class, 'exportPayslips'])->name('export.payslips');
		Route::get('/salary_days_count', [PayReferenceController::class, 'getPayReferenceDuration'])->name('salary_days_count');
		Route::post('/submit_pay_reference_payitems', [PayReferenceController::class, 'storePayItem'])->name('add_payitem_payref');
		Route::get('/approve_pay', [PayReferenceController::class, 'approveProcessPay'])->name('approve_pay');
		Route::get('/payref_approved/{id}', [PayReferenceController::class, 'approvedPayRef'])->name('pay_references_approved');
		Route::get('/payref_rejected/{id}', [PayReferenceController::class, 'rejectedPayRef'])->name('pay_references_rejected');
	});

	// Leave Category
	Route::prefix('setting/leave_categories')->name('leave_categories.')->group(function () {
		Route::get('/', [LeaveCatController::class, 'index'])->name('index');
		Route::get('/create', [LeaveCatController::class, 'create'])->name('create');
		Route::post('/store', [LeaveCatController::class, 'store'])->name('store');
		Route::get('/published/{id}', [LeaveCatController::class, 'published'])->name('published');
		Route::get('/unpublished/{id}', [LeaveCatController::class, 'unpublished'])->name('unpublished');
		Route::get('/details/{id}', [LeaveCatController::class, 'show'])->name('show');
		Route::get('/edit/{id}', [LeaveCatController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [LeaveCatController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [LeaveCatController::class, 'destroy'])->name('destroy');
	});

	// Leave Application
	Route::prefix('hrm/leave')->name('leave.')->group(function () {
		Route::get('/apply', [LeaveApplicationController::class, 'create'])->name('create');
		Route::post('/apply', [LeaveApplicationController::class, 'store'])->name('store');
		Route::get('/', [LeaveApplicationController::class, 'index'])->name('index');
		Route::get('/calculate', [LeaveApplicationController::class, 'calculateLeave'])->name('calculate');
		Route::get('/taken-dates/{id}', [LeaveApplicationController::class, 'getTakenDates'])->name('taken_dates');
		Route::get('/edit/{id}', [LeaveApplicationController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [LeaveApplicationController::class, 'update'])->name('update');
	});

	// Application Lists
	Route::prefix('hrm/application_lists')->name('application_lists.')->group(function () {
		Route::get('/', [LeaveAppController::class, 'apllicationLists'])->name('index');
		Route::get('/{id}', [LeaveAppController::class, 'show'])->name('show');
	});

	// Employee Reference
	Route::prefix('people/references')->name('references.')->group(function () {
		Route::get('/', [EmpReferenceController::class, 'index'])->name('index');
		Route::get('/print', [EmpReferenceController::class, 'print'])->name('print');
		Route::get('/references-pdf', [EmpReferenceController::class, 'references_pdf'])->name('references_pdf');
		Route::get('/create', [EmpReferenceController::class, 'create'])->name('create');
		Route::post('/store', [EmpReferenceController::class, 'store'])->name('store');
		Route::get('/active/{id}', [EmpReferenceController::class, 'active'])->name('active');
		Route::get('/deactive/{id}', [EmpReferenceController::class, 'deactive'])->name('deactive');
		Route::get('/details/{id}', [EmpReferenceController::class, 'show'])->name('show');
		Route::get('/download-pdf/{id}', [EmpReferenceController::class, 'pdf'])->name('pdf');
		Route::get('/edit/{id}', [EmpReferenceController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [EmpReferenceController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [EmpReferenceController::class, 'destroy'])->name('destroy');
	});

	// Employee
	Route::prefix('people/employees')->name('employees.')->group(function () {
		Route::get('/', [EmplController::class, 'index'])->name('index');
		Route::get('/print', [EmplController::class, 'print'])->name('print');
		Route::get('/manage/{id?}', [EmplController::class, 'create'])->name('create');
		Route::post('/store', [EmplController::class, 'store'])->name('store');
		Route::post('/update/{id}', [EmplController::class, 'empl_update'])->name('update');
		Route::post('/payroll_store', [EmplController::class, 'payroll_store'])->name('payroll_store');
		Route::post('/payroll_update/{id}', [EmplController::class, 'payroll_update'])->name('payroll_update');
		Route::post('/empl_contact_store', [EmplController::class, 'empl_contact_store'])->name('empl_contact_store');
		Route::get('/active/{id}', [EmplController::class, 'active'])->name('active');
		Route::get('/deactive/{id}', [EmplController::class, 'deactive'])->name('deactive');
		Route::get('/details/{id}', [EmplController::class, 'show'])->name('show');
		Route::get('/download-pdf/{id}', [EmplController::class, 'pdf'])->name('pdf');
		Route::get('/edit/{id}', [EmplController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [EmplController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [EmplController::class, 'destroy'])->name('destroy');
		Route::post('/leave_store/{employee_id?}', [EmplController::class, 'leave_store'])->name('leave_store');
		Route::post('/superannuation_store/{employee_id?}', [EmplController::class, 'submitSuperannuation'])->name('submit_superannuation');
		Route::post('/superannuation_update/{employee_id?}', [EmplController::class, 'updateSuperannuation'])->name('update_superannuation');
		Route::post('/bank_store/{employee_id?}', [EmplController::class, 'bank_store'])->name('bank_store');
		Route::post('/bank_update/{employee_id?}', [EmplController::class, 'updateBankDetails'])->name('update_bank_details');
	});

	// Folder
	Route::prefix('folders')->name('folders.')->group(function () {
		Route::get('/', [FolderController::class, 'index'])->name('index');
		Route::get('/create', [FolderController::class, 'create'])->name('create');
		Route::post('/store', [FolderController::class, 'store'])->name('store');
	});

	// File
	Route::prefix('files')->name('files.')->group(function () {
		Route::get('/{id}', [FileController::class, 'index'])->name('index');
		Route::get('/create/{id}', [FileController::class, 'create'])->name('create');
		Route::post('/store/{id}', [FileController::class, 'store'])->name('store');
		Route::get('/download/{file}', [FileController::class, 'download'])->name('download');
	});

	// Profile
	Route::prefix('profile')->name('profile.')->group(function () {
		Route::get('/user-profile', [ProfileController::class, 'index'])->name('index');
		Route::post('/update-profile', [ProfileController::class, 'update'])->name('update');
		Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change_password');
		Route::post('/update-password', [ProfileController::class, 'update_password'])->name('update_password');
	});

	// // Custom Invoice
	// Route::prefix('custom-invoice')->name('custom_invoice.')->group(function () {
	// 	Route::get('/', [InvoiceController::class, 'index'])->name('index');
	// 	Route::post('/make-invoice', [InvoiceController::class, 'create'])->name('create');
	// });

	// SMS
	// Route::prefix('sms')->name('sms.')->group(function () {
	// 	Route::get('/', [SmsController::class, 'index'])->name('index');
	// });

		//////////////////////////// HRM ////////////////////////////

	// Attendance
	Route::prefix('hrm/attendance')->name('attendance.')->group(function () {
		Route::get('/', [AttendanceController::class, 'index'])->name('index');
		Route::post('/upload', [AttendanceController::class, 'import'])->name('import');
		Route::post('/upload_csv', [AttendanceController::class, 'import_csv'])->name('import_csv');
		Route::get('/manual_setting', [AttendanceController::class, 'manual_setting'])->name('manual_setting');
		Route::get('/manage', [AttendanceController::class, 'attendance_manage'])->name('attendance_manage');
		Route::get('/edit/{id}', [AttendanceController::class, 'attendance_edit'])->name('attendance_edit');
		Route::get('/report', [AttendanceController::class, 'report'])->name('report');
		Route::post('/updated/{id}', [AttendanceController::class, 'update_new'])->name('update_new');
		Route::get('/search', [AttendanceController::class, 'searchAttendance'])->name('search_attendance');
		Route::post('/generate', [AttendanceController::class, 'generateAttendanceSheet'])->name('generate_attendance_sheet');
		Route::post('/set', [AttendanceController::class, 'set_attendance'])->name('set_attendance');
		Route::post('/store', [AttendanceController::class, 'store'])->name('store');
		Route::post('/update', [AttendanceController::class, 'update'])->name('update');
		Route::post('/get-report', [AttendanceController::class, 'get_report'])->name('get_report');
		Route::post('/time/set', [AttendanceController::class, 'timeSet'])->name('time_set');
		Route::get('/details/{id}', [AttendanceController::class, 'attDetails'])->name('att_details');
		Route::get('/details/report/go', [AttendanceController::class, 'attDetailsReportGo'])->name('att_details_report_go');
		Route::get('/details/report/all', [AttendanceController::class, 'attDetailsReport'])->name('att_details_report');
		Route::get('/details/report/pdf', [AttendanceController::class, 'attDetailsReportPdf'])->name('att_details_report_pdf');
	});


	// Payroll Section
	Route::prefix('hrm/payroll')->name('payroll.')->group(function () {
		Route::get('/', [PayrollController::class, 'index'])->name('index');
		Route::post('/go', [PayrollController::class, 'go'])->name('go');
		Route::get('/manage-salary/{id}', [PayrollController::class, 'create'])->name('create');
		Route::post('/store', [PayrollController::class, 'store'])->name('store');
		Route::get('/salary-list', [PayrollController::class, 'list'])->name('list');
		Route::get('/details/{id}', [PayrollController::class, 'show'])->name('show');
		Route::post('/update/{id}', [PayrollController::class, 'update'])->name('update');
		Route::get('/hra/{id}/{id1}/{id2}', [PayrollController::class, 'hra'])->name('hra');
		Route::get('/vehicle/{id}', [PayrollController::class, 'vehicle'])->name('vehicle');
		Route::get('/meals/{desc}', [PayrollController::class, 'meals'])->name('meals');
		Route::get('/taxcal/{gross_sal}/{depen}/{r_status}', [PayrollController::class, 'taxcal'])->name('taxcal');
		Route::get('/hra_area_src/{id}', [PayrollController::class, 'hra_area_src'])->name('hra_area_src');
	});

	// Increment
	Route::prefix('hrm/increment')->name('increment.')->group(function () {
		Route::get('/search', [IncrementController::class, 'newIncrementSearch'])->name('search');
		Route::post('/store', [IncrementController::class, 'newIncrementStore'])->name('store');
		Route::get('/list', [IncrementController::class, 'incrementList'])->name('list');
	});

	// Salary Statement
	Route::prefix('hrm/salary/statement')->name('salary.statement.')->group(function () {
		Route::get('/search', [IncrementController::class, 'salaryStatementSearch'])->name('search');
		Route::get('/view', [IncrementController::class, 'salaryStatementView'])->name('view');
		Route::get('/preview', [IncrementController::class, 'salaryStatementPreview'])->name('preview');
		Route::get('/pdf', [IncrementController::class, 'salaryStatementPdf'])->name('pdf');
	});

	// Bonus Section
	Route::prefix('hrm/bonuses')->name('bonuses.')->group(function () {
		Route::get('/', [BonusController::class, 'index'])->name('index');
		Route::get('/create', [BonusController::class, 'create'])->name('create');
		Route::post('/store', [BonusController::class, 'store'])->name('store');
		Route::get('/details/{id}', [BonusController::class, 'show'])->name('show');
		Route::get('/edit/{id}', [BonusController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [BonusController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [BonusController::class, 'destroy'])->name('destroy');
	});

	// Deduction Section
	Route::prefix('hrm/deductions')->name('deductions.')->group(function () {
		Route::get('/', [DeductionController::class, 'index'])->name('index');
		Route::get('/create', [DeductionController::class, 'create'])->name('create');
		Route::post('/store', [DeductionController::class, 'store'])->name('store');
		Route::get('/details/{id}', [DeductionController::class, 'show'])->name('show');
		Route::get('/edit/{id}', [DeductionController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [DeductionController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [DeductionController::class, 'destroy'])->name('destroy');
	});

	// Loan Section
	Route::prefix('hrm/loan_master')->name('loan_master.')->group(function () {
		Route::get('/', [LoanController::class, 'index'])->name('index');
		Route::get('/create', [LoanController::class, 'create'])->name('create');
		Route::post('/store', [LoanController::class, 'store'])->name('store');
		Route::get('/details/{id}', [LoanController::class, 'show'])->name('show');
		Route::get('/edit/{id}', [LoanController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [LoanController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [LoanController::class, 'destroy'])->name('destroy');
	});

	// Payment Section
	Route::prefix('hrm/salary-payments')->name('salary.payments.')->group(function () {
		Route::get('/', [SalaryPaymentController::class, 'index'])->name('index');
		Route::post('/go', [SalaryPaymentController::class, 'go'])->name('go');
		Route::get('/manage-salary/{id}/{salary_month}', [SalaryPaymentController::class, 'create'])->name('create');
		Route::get('/pdf/{id}/{salary_month}', [SalaryPaymentController::class, 'pdf'])->name('pdf');
		Route::post('/store', [SalaryPaymentController::class, 'store'])->name('store');
	});

	// Generate Payslip
	Route::prefix('hrm/generate-payslips')->name('generate.payslips.')->group(function () {
		Route::get('/', [SalaryPaymentController::class, 'show'])->name('show');
		Route::post('/', [SalaryPaymentController::class, 'generate'])->name('generate');
		Route::get('/salary-list/{salary_month}', [SalaryPaymentController::class, 'list'])->name('list');
	});

	// Provident Funds
	Route::get('/hrm/provident-funds', [SalaryPaymentController::class, 'provident_fund'])->name('provident.fund');

	// Working Day
	Route::prefix('setting/working-days')->name('working.days.')->group(function () {
		Route::get('/', [WorkingDayController::class, 'index'])->name('index');
		Route::post('/update', [WorkingDayController::class, 'update'])->name('update');
	});

	// Holidays
	Route::prefix('setting/holidays')->name('holidays.')->group(function () {
		Route::get('/', [HolidayController::class, 'index'])->name('index');
		Route::get('/create', [HolidayController::class, 'create'])->name('create');
		Route::post('/store', [HolidayController::class, 'store'])->name('store');
		Route::get('/published/{id}', [HolidayController::class, 'published'])->name('published');
		Route::get('/unpublished/{id}', [HolidayController::class, 'unpublished'])->name('unpublished');
		Route::get('/details/{id}', [HolidayController::class, 'show'])->name('show');
		Route::get('/edit/{id}', [HolidayController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [HolidayController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [HolidayController::class, 'destroy'])->name('destroy');
	});

	// Personal Events
	Route::prefix('setting/personal-events')->name('personal.events.')->group(function () {
		Route::get('/', [PersonalEventController::class, 'index'])->name('index');
		Route::get('/create', [PersonalEventController::class, 'create'])->name('create');
		Route::post('/store', [PersonalEventController::class, 'store'])->name('store');
		Route::get('/published/{id}', [PersonalEventController::class, 'published'])->name('published');
		Route::get('/unpublished/{id}', [PersonalEventController::class, 'unpublished'])->name('unpublished');
		Route::get('/details/{id}', [PersonalEventController::class, 'show'])->name('show');
		Route::get('/edit/{id}', [PersonalEventController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [PersonalEventController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [PersonalEventController::class, 'destroy'])->name('destroy');
	});

	// Notice
	Route::prefix('hrm/notice')->name('notice.')->group(function () {
		Route::get('/', [NoticeController::class, 'index'])->name('index');
		Route::get('/create', [NoticeController::class, 'create'])->name('create');
		Route::post('/store', [NoticeController::class, 'store'])->name('store');
		Route::get('/published/{id}', [NoticeController::class, 'published'])->name('published');
		Route::get('/unpublished/{id}', [NoticeController::class, 'unpublished'])->name('unpublished');
		Route::get('/delete/{id}', [NoticeController::class, 'destroy'])->name('destroy');
		Route::get('/show', [NoticeController::class, 'show'])->name('show');
	});
		
	// Expense Management
	Route::prefix('hrm/expence')->name('expence.')->group(function () {
		Route::get('/category/add', [ExpenceManagementController::class, 'expCategoryAdd'])->name('category.add');
		Route::get('/category/edit/{id}', [ExpenceManagementController::class, 'expCategoryEdit'])->name('category.edit');
		Route::post('/category/update', [ExpenceManagementController::class, 'expCatUpdate'])->name('category.update');
		Route::post('/category/store', [ExpenceManagementController::class, 'expCatStore'])->name('category.store');
		Route::get('/category/list', [ExpenceManagementController::class, 'expCategoryList'])->name('category.list');
		Route::get('/manage-expence', [ExpenceManagementController::class, 'index'])->name('index');
		Route::get('/add-expence', [ExpenceManagementController::class, 'create'])->name('create');
		Route::post('/store', [ExpenceManagementController::class, 'store'])->name('store');
	});

	// Employee Award Category
	Route::prefix('setting/award-categories')->name('award.categories.')->group(function () {
		Route::get('/', [AwardCategoryController::class, 'index'])->name('index');
		Route::get('/create', [AwardCategoryController::class, 'create'])->name('create');
		Route::post('/store', [AwardCategoryController::class, 'store'])->name('store');
		Route::get('/published/{id}', [AwardCategoryController::class, 'published'])->name('published');
		Route::get('/unpublished/{id}', [AwardCategoryController::class, 'unpublished'])->name('unpublished');
		Route::get('/edit/{id}', [AwardCategoryController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [AwardCategoryController::class, 'update'])->name('update');
		Route::get('/delete/{id}', [AwardCategoryController::class, 'destroy'])->name('destroy');
	});

	// Employee Awards
	Route::prefix('hrm/employee-awards')->name('employee.awards.')->group(function () {
		Route::get('/', [EmployeeAwardController::class, 'index'])->name('index');
		Route::get('/create', [EmployeeAwardController::class, 'create'])->name('create');
		Route::post('/store', [EmployeeAwardController::class, 'store'])->name('store');
		Route::get('/published/{id}', [EmployeeAwardController::class, 'published'])->name('published');
		Route::get('/unpublished/{id}', [EmployeeAwardController::class, 'unpublished'])->name('unpublished');
		Route::get('/edit/{id}', [EmployeeAwardController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [EmployeeAwardController::class, 'update'])->name('update');
		Route::get('/details/{id}', [EmployeeAwardController::class, 'show'])->name('show');
		Route::get('/delete/{id}', [EmployeeAwardController::class, 'destroy'])->name('destroy');
	});

	// Overtime
	Route::prefix('setting/overtime')->name('overtime.')->group(function () {
		Route::get('/', [OvertimeController::class, 'index'])->name('index');
		Route::get('/create', [OvertimeController::class, 'create'])->name('create');
		Route::post('/store', [OvertimeController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [OvertimeController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [OvertimeController::class, 'update'])->name('update');
		Route::get('/published/{id}', [OvertimeController::class, 'published'])->name('published');
		Route::get('/unpublished/{id}', [OvertimeController::class, 'unpublished'])->name('unpublished');
		Route::get('/delete/{id}', [OvertimeController::class, 'destroy'])->name('destroy');
	});

	// Employee Contact
	Route::prefix('employee_contacts')->name('employee.contacts.')->group(function () {
		Route::post('/store', [EmplContactController::class, 'store'])->name('store');
		Route::post('/update/{employee_contact_id}', [EmplContactController::class, 'update'])->name('update');
	});

	// Bank Detail
	Route::prefix('setting/bank_details')->name('setting.bank_details.')->group(function () {
		Route::get('/', [BankDetailController::class, 'index'])->name('index');
		Route::get('/create', [BankDetailController::class, 'create'])->name('create');
		Route::post('/store', [BankDetailController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [BankDetailController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [BankDetailController::class, 'update'])->name('update');
		Route::get('/published/{id}', [BankDetailController::class, 'published'])->name('published');
		Route::get('/unpublished/{id}', [BankDetailController::class, 'unpublished'])->name('unpublished');
		Route::get('/delete/{id}', [BankDetailController::class, 'destroy'])->name('destroy');
	});

	// Company Detail
	Route::prefix('setting/company')->name('company.')->group(function () {
		Route::get('/', [CompanyController::class, 'index'])->name('index');
		Route::get('/create', [CompanyController::class, 'create'])->name('create');
		Route::post('/store', [CompanyController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [CompanyController::class, 'update'])->name('update');
		Route::get('/bank_detail/{id}', [CompanyController::class, 'getBankDetails'])->name('bank_detail');
	});
	
	//Cost Center
	Route::prefix('setting/costcenters')->name('costcenters.')->group(function () {
		Route::get('/', [CostCenterController::class, 'index'])->name('index');
		Route::get('/create', [CostCenterController::class, 'create'])->name('create');
		Route::post('/store', [CostCenterController::class, 'store'])->name('store');
		Route::get('/edit/{id}', [CostCenterController::class, 'edit'])->name('edit');
		Route::post('/update/{id}', [CostCenterController::class, 'update'])->name('update');
		Route::delete('/delete/{id}', [CostCenterController::class, 'destroy'])->name('destroy');
	});
	Route::get('/get-departments-by-cost-center/{costCenterId}', [CostCenterController::class, 'getDepartmentsByCostCenter']);

	

	// Report
	Route::prefix('report')->name('report.')->group(function () {
		Route::get('/superannuation-report', [SuperAnnuationReportController::class, 'index'])->name('superannuation.report');
		Route::post('/superannuation-report/show', [SuperAnnuationReportController::class, 'showSuperannuationReport'])->name('superannuation.report_show');
	});

	//Salary Calculation
	Route::get('/salary-calculator', [SalaryCalculatorController::class, 'index'])->name('salary.calculator');
	Route::post('/salary-calculator/calculate', [SalaryCalculatorController::class, 'calculate'])->name('salary.calculate');
	Route::get('/salary-calculator/hra_area_name/{id}', [SalaryCalculatorController::class, 'hra_area_name']);
	Route::get('/salary-calculator/hra', [SalaryCalculatorController::class, 'hra']);
	Route::get('/salary-calculator/vehicle', [SalaryCalculatorController::class, 'vehicle']);
	Route::get('/salary-calculator/meals/{id}', [SalaryCalculatorController::class, 'meals']);

});
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
