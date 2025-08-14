<?php

// app/Http/Controllers/CustomerController.php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PointHistory;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function create(Request $request)
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'contact_number' => 'required',
            'company_name' => 'required',
            'designation' => 'required',
            'company_address' => 'required',
            'sales_executive' => 'required',
            // 'role' => 'required',
        ]);

        // Generate a default password
        // dd($request->password);
        $defaultPassword = bcrypt($request->password); // Replace 'defaultpassword' with your desired default password

        // Create the customer and get the customer object
        $customer = Customer::create(array_merge($request->all(), ['password' => $defaultPassword]));
        
        // Pass the customer ID to the addPoints function
        // $this->addPoints($customer->id, 'demo', '1000', '0');

        $this->addPackageAssign($customer->id, 'demo', '50', '0');
        
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

public function update(Request $request, $id)
{
    $customer = \App\Models\Customer::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:customers,email,' . $customer->id,
        'contact_number' => 'required',
        'company_name' => 'required',
        'designation' => 'required',
        'company_address' => 'required',
        'sales_executive' => 'required',
    ]);

    $customer->update($request->all());

    return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
}

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id); // Get the model instance

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }


    public function addPoints($customer_id, $package_name, $point_add, $point_minus)
    {
        // Validate the parameters
        $data = [
            'customer_id' => $customer_id,
            'package_name' => $package_name,
            'point_add' => $point_add,
            'point_minus' => $point_minus,
            'point_status' => 'Point Add',
        ];

        // Assuming validation should be done here
        // $validator = Validator::make($data, [
        //     'customer_id' => 'nullable|string|max:200',
        //     'package_name' => 'nullable|string|max:200',
        //     'point_add' => 'nullable|string|max:200',
        //     'point_minus' => 'nullable|string|max:200',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Create a new PointHistory record
        PointHistory::create($data);

        // Redirect to customers.index route with success message
        // return redirect()->route('customers.index')->with('success', 'Points added successfully.');
    }


    public function addPackageAssign($customer_id, $package_name, $point_add, $point_minus)
    {
        // Set package_id and determine the expiry duration
        $package_id = 9; // Example package_id (you can pass this dynamically if needed)

        // Set expiry duration based on package_id
        $expiryDays = ($package_id == 9) ? 7 : 365;
        $points = ($package_id == 9) ? 50 : 1000;

        // Insert package assignment details into the assign_package table
        DB::table('assign_package')->insert([
            'customer_id' => $customer_id, // Store customer_id
            'package_id' => $package_id, // Store the package_id
            'assigned_points' => $points,
            'package_start' => Carbon::now()->format('d/m/Y'), // Format start date as Y-m-d
            'package_expiry' => Carbon::now()->addDays($expiryDays)->format('d/m/Y'), // Expiry based on package_id
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Prepare the data for point history insertion
        $data = [
            'customer_id' => $customer_id,
            'package_name' => $package_name,
            'point_add' => $point_add,
            'point_minus' => $point_minus,
            'point_status' => 'Point Add',
        ];

        // Insert point history
        PointHistory::create($data);

        // Return success response or redirect
        // return redirect()->route('customers.index')->with('success', 'Points added successfully.');
    }




        public function addPointss(Request $request, $customerId)
        {
            $request->validate([
                'points' => 'required|integer|min:1',
                'customer_id' => 'required|exists:customers,id',
            ]);

            // Add the points to the customer
            $customer = Customer::find($customerId);
            $points = $request->input('points');

            // Assuming you have a points field in your Customer model
            // $customer->points += $points;
            // $customer->save();

            // Save the point history
            PointHistory::create([
                'customer_id' => $customerId,
                'package_name' => 'Admin', // or however you determine this
                'point_add' => $points,
                'point_minus' => 0,
                'point_status' => 'Point Add',
            ]);

            return response()->json(['success' => true]);
        }

}
