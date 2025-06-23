<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\User;
use App\Models\LoanMaster;
use DB;
use Carbon\Carbon;
use App\Models\LoanPayment;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $loans = Loan::query()
        ->leftjoin('users as users','users.id', '=', 'loans.user_id')
        ->leftjoin('designations','users.designation_id', '=', 'designations.id')
        ->leftJoin('loan_master','loan_master.id', '=', 'loans.loan_master_id')
        ->orderBy('loans.id', 'DESC')
        ->where('loans.deletion_status', 0)
        ->get([
            'loans.*',
            'loan_master.loan_code as loanCode',
            'loan_master.loan_name as loanName',
            'users.name',
            'designations.designation'
        ])
        ->toArray();
        $loan_masters = LoanMaster::all();
        return view('administrator.hrm.loan.manage_loans', compact('loans', 'loan_masters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         $users = User::where('deletion_status', 0)
         ->where('access_label', '>=', 2)
         ->where('access_label', '<=', 3)
        ->orderBy('name')
        ->get()
        ->toArray();
        $loan_masters = LoanMaster::all();
        return view('administrator.hrm.loan.add_loan', compact('users', 'loan_masters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Validate the request
        $loan = $this->validate(request(), [
            'user_id' => 'required',
            'loan_name' => 'required|max:100',
            'loan_date' => 'required|date',  // Make sure it's validated as a date
            'deduction_start_date' => 'required|date',  // Make sure it's validated as a date
            'loan_amount' => 'required|numeric',
            'deduction_amount' => 'required',
            'outstanding_amount' => 'required',
            'number_of_installments' => 'required|integer',
            'loan_description' => 'required',
        ],[
            'user_id.required' => 'The employee name field is required.',
        ]);
    
        // Find loan_name from LoanMaster by its ID
        $loan_master = LoanMaster::find($request->loan_name);
    
        if (!$loan_master) {
            return redirect()->back()->with('exception', 'Invalid Loan Master ID!');
        }
    
        // Insert data into the Loan table
        $result = Loan::create([
            'created_by' => auth()->user()->id,
            'user_id' => $request->user_id,
            'loan_name' => $loan_master->loan_name,  // Save the loan name, not the ID
            'loan_date' => Carbon::parse($request->loan_date)->format('Y-m-d'),  // Parse date
            'deduction_start_date' => Carbon::parse($request->deduction_start_date)->format('Y-m-d'),  // Parse date
            'deduction_amount' => $request->deduction_amount,
            'outstanding_amount' => $request->outstanding_amount,
            'loan_amount' => $request->loan_amount,
            'number_of_installments' => $request->number_of_installments,
            'remaining_installments' => $request->remaining_installments,
            'loan_master_id' => $loan_master->id,  // Store the loan master ID, not name
            'loan_description' => $request->loan_description,
        ]);
    
        // Check if the insert was successful
        if ($result) {
            return redirect('/hrm/loans/create')->with('message', 'Added successfully.');
        }
    
        return redirect('/hrm/loans/create')->with('exception', 'Operation failed!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $loan = Loan::query()
        ->leftjoin('users as users','users.id', '=', 'loans.user_id')
        ->leftjoin('designations','users.designation_id', '=', 'designations.id')
        ->orderBy('loans.id', 'DESC')
        ->where('loans.deletion_status', 0)
        ->first([
            'loans.*',
            'users.name',
            'designations.designation'
        ])
        ->toArray();

        $users = User::where('deletion_status', 0)
        ->orderBy('name')
        ->get()
        ->toArray();

        $loan_masters = LoanMaster::all();

        return view('administrator.hrm.loan.show_loan', compact('loan', 'users', 'loan_masters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $loan = Loan::find($id)->toArray();

        $users = User::where('deletion_status', 0)
        ->orderBy('name')
        ->get()
        ->toArray();

        $loan_masters = LoanMaster::all();
        return view('administrator.hrm.loan.edit_loan', compact('loan', 'users', 'loan_masters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $loan = Loan::find($id);
        $this->validate(request(), [
            'user_id' => 'required',
            'loan_name' => 'required|max:100',
            'loan_date' => 'required|date',  // Make sure it's validated as a date
            'deduction_start_date' => 'required|date',  // Make sure it's validated as a date
            'loan_amount' => 'required|numeric',
            'deduction_amount' => 'required',
            'outstanding_amount' => 'required',
            'number_of_installments' => 'required|integer',
            'loan_description' => 'required',
        ],[
            'user_id.required' => 'The employee name field is required.',
        ]);

         // Find loan_name from LoanMaster by its ID
         $loan_master = LoanMaster::find($request->get('loan_name'));
    
         if (!$loan_master) {
             return redirect()->back()->with('exception', 'Invalid Loan Master ID!');
         }
     

        $loan->user_id = $request->get('user_id');
        $loan->loan_name =  $loan_master->loan_name;  // Save the loan name, not the ID
        $loan->loan_date = Carbon::parse($request->get('loan_date'))->format('Y-m-d');  // Parse date
        $loan->deduction_start_date = Carbon::parse($request->get('deduction_start_date'))->format('Y-m-d');  // Parse date
        $loan->deduction_amount = $request->get('deduction_amount');
        $loan->outstanding_amount = $request->get('outstanding_amount');
        $loan->loan_amount = $request->get('loan_amount');
        $loan->number_of_installments = $request->get('number_of_installments');
        $loan->remaining_installments = $request->get('remaining_installments');
        $loan->loan_master_id = $request->get('loan_name');  // Store the loan master ID, not name
        $affected_row = $loan->save();

        if (!empty($affected_row)) {
            return redirect('/hrm/loans')->with('message', 'Update successfully.');
        }
        return redirect('/hrm/loans')->with('exception', 'Operation failed !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $affected_row = Loan::where('id', $id)
        ->update(['deletion_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/hrm/loans')->with('message', 'Delete successfully.');
        }
        return redirect('/hrm/loans')->with('exception', 'Operation failed !');
    }

    /**
     * Loan Payment Functionalities
     */

      // Display all loan payments
    public function loanPaymentIndex()
    {
        $loanPayments = LoanPayment::all();
        return view('administrator.hrm.loan_payments.index', compact('loanPayments'));
    }

    // Show the form for creating a new loan payment
    public function loanPaymentCreate()
    {
        return view('administrator.hrm.loan_payments.create');
    }

    // Store a newly created loan payment
    public function loanPaymentStore(Request $request)
    {
        $validated = $request->validate([
            'loan_code' => 'required|unique:loan_payments',
            'loan_name' => 'required',
            'loan_id' => 'required',
            'loan_amount' => 'required|numeric',
            'balance_amount' => 'required|numeric',
            'amount_to_pay' => 'required|numeric',
            'payment_schedule' => 'required|in:1,2',
            'payment_status' => 'required|in:1,2,3',
        ]);

        // Check if balance_amount is 0 and update it
        if ($validated['balance_amount'] != 0) {
            $validated['balance_amount'] = ($validated['loan_amount'] - $validated['balance_amount'])  - $validated['amount_to_pay'];
        } else {
            $validated['balance_amount'] = $validated['loan_amount'] - $validated['amount_to_pay'];   
        }

        // Use updateOrCreate to either update an existing loan payment or create a new one
        $loanPayment = LoanPayment::updateOrCreate(
            ['id' => $request->id],  // Find by ID
            $validated      // Data to update or insert
        );

        return redirect()->route('loan_payments.index')->with('success', 'Loan Payment Created Successfully');
    }


    // Show the form for editing a loan payment
    public function loanPaymentEdit(Request $request, $id)
    {
        // Attempt to get the loan payment and associated loan details
        $loanPayment = DB::table('loan_payments')
            ->select('loan_master.loan_code', 'loan_master.loan_name', 'loan_payments.*')
            ->leftJoin('loan_master', 'loan_master.id', '=', 'loan_payments.loan_id')
            ->where('loan_payments.loan_id', $id)
            ->first();

        // If loan payment is found, use it; otherwise, check the loans table
        if ($loanPayment) {
            $loanManualPayment = $loanPayment;
        } else {
            // Check if the record exists in the loans table
            $loan = DB::table('loans')
            ->select('loan_master.loan_code', 'loan_master.loan_name', 'loans.*')
            ->leftJoin('loan_master', 'loan_master.id', '=', 'loans.loan_master_id')
            ->where('loans.id', $id)
            ->first();

            if ($loan) {
                $loanManualPayment = $loan;
            } else {
                $loanManualPayment = null; // Set to null for better clarity
            }
        }

        // Pass the loanManualPayment to the view
        return view('administrator.hrm.loan_payments.edit', compact('loanManualPayment'));
    }

    // Update the specified loan payment
    public function loanPaymentUpdate(Request $request, $id)
    {
        // Validate request data
        $validated = $request->validate([
            'loan_code' => 'required',
            'loan_name' => 'required',
            'loan_id' => 'required',
            'user_id' => 'required',
            'loan_amount' => 'required|numeric',
            'balance_amount' => 'required|numeric',
            'amount_to_pay' => 'required|numeric',
            'repayment_paid_on' => 'required|date',
            'payment_schedule' => 'required',
            'payment_status' => 'required'
        ]);

        // Update balance_amount logic
        if ($validated['balance_amount'] > 0) {
            // If balance_amount is greater than 0, update it accordingly
            $validated['balance_amount'] = $validated['balance_amount'] - $validated['amount_to_pay'];
        } else {
            // If balance_amount is 0, calculate it based on loan_amount and amount_to_pay
            $validated['balance_amount'] = $validated['loan_amount'] - $validated['amount_to_pay'];
        }

        // Use updateOrCreate to either update an existing loan payment or create a new one
        $loanPayment = LoanPayment::updateOrCreate(
            ['id' => $id],  // Find by ID
            $validated      // Data to update or insert
        );

        // Redirect back with success message
        return redirect()->route('loan_payments.index')->with('success', 'Loan Payment Updated or Created Successfully');
    }



    // Delete the specified loan payment
    public function loanPaymentDestroy($id)
    {
        $loanPayment = LoanPayment::findOrFail($id);
        $loanPayment->delete();

        return redirect()->route('loan_payments.index')->with('success', 'Loan Payment Deleted Successfully');
    }
}

