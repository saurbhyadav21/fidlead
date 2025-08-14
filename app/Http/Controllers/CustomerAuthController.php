<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use DB;
use Carbon\Carbon;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            $customer = Auth::guard('customer')->user();

            // Store additional data in the session
            session(['customer_data' => $customer]);

            // Check if the customer has any assigned packages
            $expiredPackages = DB::table('assign_package')
            ->where('customer_id', $customer->id)
            ->whereRaw("STR_TO_DATE(package_expiry, '%d/%m/%Y') > ?", [Carbon::now()->endOfDay()])
            ->count();
            // dd($expiredPackages);

            if ($expiredPackages == 0) {
                // Log the customer out
                Auth::guard('customer')->logout();

                // Redirect back with an error message
                return redirect()->back()->withErrors(['package' => 'Your assigned package has expired. Please contact admin.']);
            }

            return redirect()->route('customer.dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }



    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('welcome');
    }


    public function showSignupForm()
    {
        return view('customer.signup');
    }

    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('customer.forgot-password');
    }

    // Check if email exists and send a reset link
    public function checkEmailExists(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the email exists in the database
        $user = Customer::where('email', $request->email)->first();

        if ($user) {
            // Generate a password reset link with the email as a query parameter
            $resetLink = route('password.change') . '?email=' . urlencode($request->email);

            // Redirect to the reset link (or send it via email)
            return redirect($resetLink);
        }

        return back()->withErrors(['email' => 'Email not found!']);
    }

    // Show the password change form
    public function showChangePasswordForm(Request $request)
    {
        // dd('test');
        // Get email from query parameter
        $email = $request->query('email');
        // dd($email);
        if (!$email || !Customer::where('email', $email)->exists()) {
            return redirect()->route('password.forgot')->withErrors(['email' => 'Invalid or expired link.']);
        }

        return view('customer.change', compact('email'));
    }

    // Handle password update logic
    public function updatePassword(Request $request)
    {
        $user = Customer::where('email', $request->email)->firstOrFail();
        // dd($user);
        // Update the password
        $user->password = bcrypt($request->new_password);
        $user->save();

        // Redirect to login page with success message
        return redirect()->route('customer.login')->with('status', 'Password changed successfully. Please log in.');
    }


    public function store1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string',
            'contact_number' => 'required|string|max:15',
            'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'sales_executive' => 'required|string|max:255',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'contact_number' => $request->contact_number,
            'company_name' => $request->company_name,
            'designation' => $request->designation,
            'company_address' => $request->company_address,
            'sales_executive' => $request->sales_executive,
        ]);

        return redirect()->back()->with('success', 'Customer created successfully!');
    }
}
