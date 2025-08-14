<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PointHistory;
use App\Models\Customer;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\PurchasedLead;
use App\Models\Notification;
use Carbon\Carbon;

class CustomerDashboardController extends Controller
{
  public function index()
    {
        //--------------------------- dd('ddd');
        // Get the authenticated customer
        $customer = Auth::guard('customer')->user();
        // dd( $customer);
        // Fetch point histories related to the customer
        $pointHistories = $customer->pointHistories;

        // Calculate totals
        $totalPointAdd = $pointHistories->sum('point_add');
        $totalPointMinus = $pointHistories->sum('point_minus');
        $difference = $totalPointAdd - $totalPointMinus;

        // Pass customer, point histories, and calculations to the view
        return view('customer.dashboard', compact('customer', 'pointHistories', 'totalPointAdd', 'totalPointMinus', 'difference'));

        //---------------------------
        // return view('customer.dashboard');
    }
 
  
  public function searchView()
    {
        $countries = DB::table('buyer_seller_data')->select('buyer_country')->distinct()->orderBy('buyer_country')->get();
    $hsCodes = DB::table('buyer_seller_data')->select('hs_02')->distinct()->orderBy('hs_02')->get();
    $categories = DB::table('buyer_seller_data')->select('business_category')->distinct()->orderBy('business_category')->get();

        
        return view('customer.search', compact('countries', 'hsCodes', 'categories'));
    }

    public function search(Request $request)
    {
        $table = $request->get('type') === 'seller' ? 'seller_seller_data' : 'buyer_seller_data';

        $columns = [
            0 => 'buyer_name',
            1 => 'buyer_country',
            2 => 'buyer_email_i'
        ];

        

        $query = DB::table($table);

        // Search filter
        if (!empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('buyer_name', 'like', "%{$search}%")
                  ->orWhere('buyer_country', 'like', "%{$search}%")
                  ->orWhere('buyer_email_i', 'like', "%{$search}%");
            });
        }
if ($request->buyer_country) {
    $query->where('buyer_country', $request->buyer_country);
}

if ($request->hs_code) {
    $query->where('hs_02', $request->hs_code);
}

if ($request->business_category) {
    $query->where('business_category', $request->business_category);
}

if ($request->search_text) {
    $search = $request->search_text;
    $query->where(function ($q) use ($search) {
        $q->where('buyer_name', 'like', "%{$search}%")
          ->orWhere('buyer_email_i', 'like', "%{$search}%");
    });
}
        $totalData = $query->count();

        $data = $query->offset($request->start)
                      ->limit($request->length)
                      ->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir'])
                      ->get();

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data
        ]);
    }
}
