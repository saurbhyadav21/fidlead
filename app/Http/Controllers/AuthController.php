<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('customers.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd(Auth::guard('customer')->attempt($credentials));
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        // dd($credentials);
    
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/login');
    }


    public function dashboard()
    {
        dd('ddd');
        // Get the authenticated customer
        $customer = Auth::guard('customer')->user();

        // Fetch point histories related to the customer
        $pointHistories = $customer->pointHistories;

        // Calculate totals
        $totalPointAdd = $pointHistories->sum('point_add');
        $totalPointMinus = $pointHistories->sum('point_minus');
        $difference = $totalPointAdd - $totalPointMinus;

        // Pass customer, point histories, and calculations to the view
        return view('customers.dashboard', compact('customer', 'pointHistories', 'totalPointAdd', 'totalPointMinus', 'difference'));
    }

}
