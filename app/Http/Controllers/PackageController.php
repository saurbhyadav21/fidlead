<?php

namespace App\Http\Controllers;
use App\Models\Package;
use Illuminate\Http\Request;
use DB;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Customer;
use App\Models\PointHistory;
use Carbon\Carbon;
class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create(Request $request)
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        // dd('hello');
        $request->validate([
            'package_name' => 'required',
            'package_type' => 'required',
            'package_point' => 'required|integer',
            'package_cost' => 'required|numeric',
        ]);
        Package::create($request->all());
        // dd($request);
        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $package)
    {
        $request->validate([
            'package_name' => 'required',
            'package_type' => 'required',
            'package_point' => 'required|integer',
            'package_cost' => 'required|numeric',
        ]);

        $package->update($request->all());
        return redirect()->route('packages.index')
            ->with('success', 'Package updated successfully.');
    }

    public function destroy($package)
    {
        $package->delete();
        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully.');
    }

    public function assginPackages(Request $request, Package $package)
    {
        //assginPackage.blade
        return view('admin.packages.assginPackage');
    }

    public function createAssignForm()
    {
        $packages = Package::all();  // Get all packages from the database
        return view('admin.packages.assginCreatePackage', compact('packages')); // Return the view with the packages
    }

    public function storeAssignedPackage(Request $request)
    {
        // dd($request);
        // Validate the request
        $request->validate([
            'customer_email' => 'required|email|exists:customers,email', // Ensure customer email exists
            'package_id' => 'required|exists:packages,id',
            'points' => 'required|integer|min:0',
        ]);
    
        // Get the customer ID based on the provided email
        $customer = DB::table('customers')->where('email', $request->customer_email)->first();
    
        if (!$customer) {
            return redirect()->back()->withErrors(['customer_email' => 'Customer not found']);
        }
    
        // Save the assignment in the assign_package table
        DB::table('assign_package')->insert([
            'customer_id' => $customer->id, // Store customer_id
            'package_id' => $request->package_id,
            'assigned_points' => $request->points,
            'package_start' => $request->package_start,
            'package_expiry' => $request->package_expiry,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Retrieve the package details for insertion into point_histories
        $package = DB::table('packages')->where('id', $request->package_id)->first();
    
        // Insert a record into the point_histories table
        DB::table('point_histories')->insert([
            'customer_id' => $customer->id, // Store customer_id
            'package_name' => $package->package_name, // Store package name
            'point_add' => $request->points, // Points added
            'point_minus' => 0, // No points deducted
            'point_status' => 'Point Add', // No points deducted
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Package assigned and points added to history successfully.');
    }
    

    public function emailSearch(Request $request)
    {
        $search = $request->get('query');
    
        $customers = DB::table('customers')
                        ->where('email', 'LIKE', "%{$search}%")
                        ->pluck('email');

        return response()->json($customers);
    }

    public function viewAssign(Request $request)
    {
        // Query to fetch assigned packages, customer, and package details
        $assignments = DB::table('assign_package')
        ->join('customers', 'assign_package.customer_id', '=', 'customers.id')
        ->join('packages', 'assign_package.package_id', '=', 'packages.id')
        ->select(
            'assign_package.*',
            'customers.name as customer_name',
            'customers.email as customer_email',
            'packages.package_name as package_name',
            // 'packages.details as package_details'
            )
            ->get();

            return view('admin.packages.viewAssign', compact('assignments'));
    }



    public function deleteAssign($id)
    {
        // Validate the request
        // $request->validate([
        //     'points' => 'required|integer|min:1',
        //     'customer_id' => 'required|exists:customers,id',
        // ]);

        // Retrieve the assignment row based on the given ID
        $assignment = DB::table('assign_package')->where('id', $id)->first();
        
        // Check if assignment exists
        if (!$assignment) {
            return response()->json(['error' => 'Assignment not found'], 404);
        }

        // Get the customer_id and package_id from the assignment row
        $customerId = $assignment->customer_id;
        $packageId = $assignment->package_id;
        $points = $assignment->assigned_points;

        // Retrieve the package details
        $package = DB::table('packages')->where('id', $packageId)->first();
        
        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }

        // Get the points from the request
        $pointsToRemove = $points;
        
        // Retrieve the customer
        $customer = Customer::find($customerId);
        
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        // Assuming the customer has points, subtract the points from their balance
        // You may need to add this field to the customer table if it's not there
        // $customer->points -= $pointsToRemove;
        // $customer->save();

        // Save the point subtraction in the point history
        PointHistory::create([
            'customer_id' => $customerId,
            'package_name' => $package->package_name, // Assuming package_name is present in the packages table
            'point_add' => 0, // Since we are subtracting points
            'point_minus' => $pointsToRemove,
            'point_status' => 'Point consumed by user',
        ]);

        // Delete the assignment row
        DB::table('assign_package')->where('id', $id)->delete();

        // Return success response
        return response()->json(['success' => 'Assignment deleted successfully']);
    }

    public function editGetAssignedPackage(Request $request, $id)
    {
        // Fetch the existing assigned package by ID
        $assignedPackage = DB::table('assign_package')->where('id', $id)->first();

        if (!$assignedPackage) {
            return redirect()->back()->withErrors(['error' => 'Assigned package not found']);
        }

        return view('admin.packages.edit', compact('assignedPackage'));
    }

    public function editAssignedPackage(Request $request, $id)
    {
        // Fetch the existing assigned package by ID
        $assignedPackage = DB::table('assign_package')->where('id', $id)->first();

        if (!$assignedPackage) {
            return redirect()->back()->withErrors(['error' => 'Assigned package not found']);
        }

        // Validate the request
        $request->validate([
            // 'customer_email' => 'required|email|exists:customers,email',
            // 'package_id' => 'required|exists:packages,id',
            'points' => 'required|integer|min:0',
            'package_start' => 'required|date',
            'package_expiry' => 'required|date|after:package_start',
        ]);

        // Get the customer ID based on the provided email
        // $customer = DB::table('customers')->where('email', $request->customer_email)->first();

        // if (!$customer) {
        //     return redirect()->back()->withErrors(['customer_email' => 'Customer not found']);
        // }

        // Update the assigned package details
        DB::table('assign_package')->where('id', $id)->update([
            // 'customer_id' => $customer->id,
            // 'package_id' => $request->package_id,
            'assigned_points' => $request->points,
            // 'package_start' => $request->package_start,
            // 'package_expiry' => $request->package_expiry,
            // Format the package start and expiry dates
            'package_start' => Carbon::createFromFormat('Y-m-d', $request->package_start)->format('d/m/Y'),
            'package_expiry' => Carbon::createFromFormat('Y-m-d', $request->package_expiry)->format('d/m/Y'),
            'updated_at' => now(),
        ]);

        // return redirect()->back()->with('success', 'Assigned package and points updated successfully.');
        return redirect()->route('viewAssign')->with('success', 'Package created successfully.');

        // Retrieve the package details for updating the point history
        // $package = DB::table('packages')->where('id', $request->package_id)->first();

        // Update the point history
        // DB::table('point_histories')->where('customer_id', $assignedPackage->customer_id)->update([
        //     'package_name' => $package->package_name,
        //     'point_add' => $request->points,
        //     'point_minus' => 0,
        //     'point_status' => 'Point Updated',
        //     'updated_at' => now(),
        // ]);

        
    }

}
