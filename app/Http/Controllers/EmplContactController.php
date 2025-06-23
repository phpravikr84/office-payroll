<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use App\Models\EmployeeContact;
use DB;

use Illuminate\Http\Request;


class EmplContactController extends Controller
{
   // Method to show the form for adding a new employee contact
   public function create($employee_id = null)
   {
       // Check if the employee_id exists in the users table
       if ($employee_id && !User::find($employee_id)) {
           return redirect()->route('employee_contacts.index')->withErrors(['Employee does not exist.']);
       }

       return view('employee_contacts.create', compact('employee_id'));
   }

   // Method to store a newly created employee contact in the database
   public function store(Request $request)
    {
        $employee_id =  $request->employee_id;
        // Check if the employee_id exists in the users table
        if ($employee_id && !User::find($employee_id)) {
            return redirect('/people/employees/manage')
                ->with('exception', 'Employee does not exist!');
        }
       
        // Validate the input data
        $validatedData = $request->validate([
            'employee_id' => 'required', // Ensure employee_id exists in the database
            'employee_contact_name' => 'required|string|max:255',
            'employee_contact_address' => 'required|string|max:255',
            'employee_contact_phone' => 'required|string|max:15',
            'employee_contact_mobile' => 'required|string|max:15',
            'employee_contact_email' => 'required|email',
            'employee_contact_relationship' => 'required|string|max:100',
        ]);

        // Attempt to create the employee contact
        //$result = EmployeeContact::create($validatedData + ['created_by' => auth()->user()->id]);
        $result = DB::table('employee_contacts')->insertGetId([
            'employee_id' => $request->employee_id, // Assuming you have employee_id as authenticated user
            'employee_contact_name' => $request->employee_contact_name,
            'employee_contact_address' => $request->employee_contact_address,
            'employee_contact_phone' => $request->employee_contact_phone,
            'employee_contact_mobile' => $request->employee_contact_mobile,
            'employee_contact_email' => $request->employee_contact_email,
            'employee_contact_relationship' => $request->employee_contact_relationship,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($result) {

            // Add employee contact form
            session()->flash('submitted_form', 'add_contact_form');
            return redirect('/people/employees/manage/' . $employee_id . '#leaveDetailsTab')
                ->with('message', 'Employee contact created successfully.');
        } else {
            // Operation failed
           
            return redirect('/people/employees/manage/' . $employee_id . '#contactInfoTab')
                ->with('exception', 'Operation failed!');
        }
    }


   // Method to display a listing of the employee contacts
   public function index()
   {
       $employee_contacts = EmployeeContact::all();
       return view('employee_contacts.index', compact('employee_contacts'));
   }

   // Method to display a specific employee contact
   public function show($id)
   {
       $employee_contact = EmployeeContact::findOrFail($id);
       return view('employee_contacts.show', compact('employee_contact'));
   }

   // Method to show the form for editing an employee contact
   public function edit($id)
   {
       $employee_contact = EmployeeContact::findOrFail($id);
       return view('employee_contacts.edit', compact('employee_contact'));
   }

   // Method to update the specified employee contact in the database
   public function update(Request $request, $id)
   {
        $employee_contact = EmployeeContact::find($id);

       $request->validate([
        'employee_contact_name' => 'required',
        'employee_contact_address' => 'required',
        'employee_contact_phone' => 'required',
        'employee_contact_mobile' => 'required',
        'employee_contact_email' => 'required|email',
        'employee_contact_relationship' => 'required',
       ]);

       $employee_contact->employee_contact_name         =  $request->get('employee_contact_name');
       $employee_contact->employee_contact_address      =  $request->get('employee_contact_address');
       $employee_contact->employee_contact_phone        =  $request->get('employee_contact_phone');
       $employee_contact->employee_contact_mobile       =  $request->get('employee_contact_mobile');
       $employee_contact->employee_contact_email        =  $request->get('employee_contact_email');
       $employee_contact->employee_contact_relationship =  $request->get('employee_contact_relationship');
        // Update employee contact form
       $affected_row = $employee_contact->save();

       if($affected_row){

           $employee_contact->update($request->all());
           session()->flash('submitted_form', 'update_contact_form');
           return redirect('/people/employees/manage/'.$request->get('employee_id').'#leaveDetailsTab')->with('message', 'Employee contact updated successfully.');
       
       } else {
           //Opertation failed
           return redirect('/people/employees/manage'.$request->get('employee_id').'#contactInfoTab')->with('exception', 'Operation failed !');
       }
   }

   // Method to remove the specified employee contact from the database
   public function destroy($id)
   {
       $employee_contact = EmployeeContact::find($id);
       $employee_contact->delete();

       return redirect()->route('employee_contacts.index')->with('success', 'Employee contact deleted successfully.');
   }
}
