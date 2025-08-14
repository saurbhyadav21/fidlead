<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SearchController extends Controller
{
    public function searchView()
    {
        // dd('dd');
        return view('customers.login.search');
    }
    
    public function search(Request $request)
{
    $dataType = $request->input('dataType');
    $searchFields = $request->input('searchFields', []);
    $searchValues = $request->input('searchValues', []);
    $searchOperators = $request->input('searchOperator', []);

    $table = ($dataType === 'buyer') ? 'buyer_seller_data' : 'seller_seller_data';
    
    $query = DB::table($table);

    foreach ($searchFields as $index => $field) {
        $value = $searchValues[$index] ?? '';
        $operator = $searchOperators[$index] ?? 'And';

        // Apply operator for each field
        if ($field === 'hsn') {
            // For HSN field, handle differently based on length or other criteria
            $query->where($field, '=', $value);
        } else {
            // Apply operators
            switch ($operator) {
                case 'contains':
                    $query->where($field, 'like', "%{$value}%");
                    break;
                case 'equal':
                    $query->where($field, '=', $value);
                    break;
                case 'in':
                    $query->whereIn($field, explode(',', $value));
                    break;
                case 'And':
                    // Default to 'And' if specified, which means just add the condition
                    $query->where($field, 'like', "%{$value}%");
                    break;
                case 'Or':
                    // Apply 'Or' condition
                    $query->orWhere($field, 'like', "%{$value}%");
                    break;
                case 'Not':
                    // Apply 'Not' condition
                    $query->where($field, 'not like', "%{$value}%");
                    break;
            }
        }
    }

    // Print the SQL query and its bindings for debugging
    $sql = $query->toSql();
    $bindings = $query->getBindings();
    // dd([
    //     'sql' => $sql,
    //     'bindings' => $bindings,
    //     'full_query' => vsprintf(str_replace('?', '%s', $sql), $bindings)
    // ]);

    return DataTables::of($query)->make(true);
}

    
}
