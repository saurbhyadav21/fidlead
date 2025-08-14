<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessBuyerSellerData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Exception;
use App\Models\BuyerSellerData;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\SellerSellerData;


class BuyerSellerDataController extends Controller
{
    public function upload(Request $request)
    {
        ini_set('memory_limit', '12288M');
        ini_set('max_execution_time', 6000);

        $request->validate([
            'file' => 'required|mimes:csv,txt',
            'data_type' => 'required|in:buyer,supplier',
        ]);

        // Process the file
        $path = $request->file('file')->store('uploads');
        $file = fopen(storage_path('app/' . $path), 'r');

        $header = fgetcsv($file); // Skip header
        $batchSize = 500;
        $data = [];

        $processedRows = 0; // Initialize the counter outside the transaction

        DB::transaction(function () use ($file, $batchSize, $request, &$data, &$processedRows) {
            $data_type = $request->input('data_type');
            $failedRows = [];

            while (($row = fgetcsv($file)) !== false) {
                $trimmedRow = array_map('trim', $row);
                if (empty(array_filter($trimmedRow))) {
                    continue;
                }

                // Convert encoding for each value in the row
                foreach ($row as $key => &$value) {
                    try {
                        $encoding = mb_detect_encoding($value, mb_detect_order(), true);
                        if ($encoding) {
                            $value = mb_convert_encoding($value, 'UTF-8', $encoding);
                        } else {
                            $value = utf8_encode($value);
                        }
                    } catch (Exception $e) {
                        Log::warning('Encoding conversion error', [
                            'row_number' => $processedRows + 1, // Current row number
                            'column' => $key,
                            'value' => $value,
                            'error' => $e->getMessage()
                        ]);
                        $value = 'Conversion Error';
                    }
                }
                unset($value); // Unset reference to avoid unexpected behaviors

                // Prepare data based on data_type
                if ($data_type === 'buyer') {
                    $data[] = [
                        'data_type' => 'buyer',
                        'buyer_country' => isset($row[1]) ? trim($row[1]) : 'N/A',
                        'unloading_port' => isset($row[2]) ? trim($row[2]) : 'N/A',
                        'mode' => isset($row[3]) ? trim($row[3]) : 'N/A',
                        'loading_country' => isset($row[4]) ? trim($row[4]) : 'N/A',
                        'loading_port' => isset($row[5]) ? trim($row[5]) : 'N/A',
                        'hs_02' => isset($row[6]) ? trim($row[6]) : 'N/A',
                        'business_category' => isset($row[7]) ? trim($row[7]) : 'N/A',
                        'hs_04' => isset($row[8]) ? trim($row[8]) : 'N/A',
                        'sub_category_i' => isset($row[9]) ? trim($row[9]) : 'N/A',
                        'hs_code_08' => isset($row[10]) ? trim($row[10]) : 'N/A',
                        'sub_category_ii' => isset($row[11]) ? trim($row[11]) : 'N/A',
                        'product_description' => isset($row[12]) ? trim($row[12]) : 'N/A',
                        'buyer_code' => isset($row[13]) ? trim($row[13]) : 'N/A',
                        'buyer_name' => isset($row[14]) ? trim($row[14]) : 'N/A',
                        'buyer_address' => isset($row[15]) ? trim($row[15]) : 'N/A',
                        'buyer_city' => isset($row[16]) ? trim($row[16]) : 'N/A',
                        'pin_code' => isset($row[17]) ? trim($row[17]) : 'N/A',
                        'buyer_state' => isset($row[18]) ? trim($row[18]) : 'N/A',
                        'country_code' => isset($row[19]) ? trim($row[19]) : 'N/A',
                        'buyer_phone' => isset($row[20]) ? trim($row[20]) : 'N/A',
                        'buyer_mobile_ii' => isset($row[21]) ? trim($row[21]) : 'N/A',
                        'buyer_email_i' => isset($row[22]) ? trim($row[22]) : 'N/A',
                        'buyer_email_ii' => isset($row[23]) ? trim($row[23]) : 'N/A',
                        'website' => isset($row[24]) ? trim($row[24]) : 'N/A',
                        'contact_person' => isset($row[25]) ? trim($row[25]) : 'N/A',
                        'show_contact_details' => isset($row[26]) ? trim($row[26]) : 'N/A',
                        'call_button' => isset($row[27]) ? trim($row[27]) : 'N/A',
                        'whatsapp_button' => isset($row[28]) ? trim($row[28]) : 'N/A',
                        // 'report_contact' => 'null',//isset($row[29]) ? trim($row[29]) : 'N/A',
                        'save_to_favorite' => isset($row[30]) ? trim($row[30]) : 'N/A',
                        'edit_contact' => isset($row[31]) ? trim($row[31]) : 'N/A',
                    ];
                } elseif ($data_type === 'supplier') {
                    // dd('test');
                    $data[] = [
                        'data_type' => 'supplier',
                        'supplier_country' => isset($row[1]) ? trim($row[1]) : 'N/A',
                        'loading_port' => isset($row[2]) ? trim($row[2]) : 'N/A',
                        'mode' => isset($row[3]) ? trim($row[3]) : 'N/A',
                        'unloading_port' => isset($row[4]) ? trim($row[4]) : 'N/A',
                        'unloading_country' => isset($row[5]) ? trim($row[5]) : 'N/A',
                        'hs_02' => isset($row[6]) ? trim($row[6]) : 'N/A',
                        'business_category' => isset($row[7]) ? trim($row[7]) : 'N/A',
                        'hs_04' => isset($row[8]) ? trim($row[8]) : 'N/A',
                        'sub_category_i' => isset($row[9]) ? trim($row[9]) : 'N/A',
                        'hs_code_08' => isset($row[10]) ? trim($row[10]) : 'N/A',
                        'sub_category_ii' => isset($row[11]) ? trim($row[11]) : 'N/A',
                        'product_description' => isset($row[12]) ? trim($row[12]) : 'N/A',
                        'supplier_code' => isset($row[13]) ? trim($row[13]) : 'N/A',
                        'supplier_name' => isset($row[14]) ? trim($row[14]) : 'N/A',
                        'supplier_address' => isset($row[15]) ? trim($row[15]) : 'N/A',
                        'supplier_city' => isset($row[16]) ? trim($row[16]) : 'N/A',
                        'supplier_pin_code' => isset($row[17]) ? trim($row[17]) : 'N/A',
                        'supplier_state' => isset($row[18]) ? trim($row[18]) : 'N/A',
                        'country_code' => isset($row[19]) ? trim($row[19]) : 'N/A',
                        'supplier_phone' => isset($row[20]) ? trim($row[20]) : 'N/A',
                        'supplier_mobile' => isset($row[21]) ? trim($row[21]) : 'N/A',
                        'supplier_email_i' => isset($row[22]) ? trim($row[22]) : 'N/A',
                        'supplier_email_ii' => isset($row[23]) ? trim($row[23]) : 'N/A',
                        'supplier_website' => isset($row[24]) ? trim($row[24]) : 'N/A',
                        'contact_person' => isset($row[25]) ? trim($row[25]) : 'N/A',
                        'show_contact_details' => isset($row[26]) ? trim($row[26]) : 'N/A',
                        'call_button' => isset($row[27]) ? trim($row[27]) : 'N/A',
                        'whatsapp_button' => isset($row[28]) ? trim($row[28]) : 'N/A',
                        // 'report_contact' => '',// isset($row[29]),isset($row[29]) ? trim($row[29]) : 'N/A',
                        'save_to_favorite' => isset($row[30]) ? trim($row[30]) : 'N/A',
                        'edit_contact' => isset($row[31]) ? trim($row[31]) : 'N/A',
                    ];
                }

                // Insert data in batches
                // dd(count($data));
                if (count($data) >= $batchSize) {
                    try {
                        if ($data_type === 'buyer') {
                            BuyerSellerData::insert($data);
                        } elseif ($data_type === 'supplier') {
                           
                            try {
                                SellerSellerData::insert($data);
                                // dd('cc');
                            } catch (\Exception $e) {
                                dd($e->getMessage());
                            }
                        }
                        $data = []; 
                    } catch (\Exception $e) {
                        Log::error('Batch insert failed', [
                            'data' => $data,
                            'error' => $e->getMessage()
                        ]);
                        $failedRows = array_merge($failedRows, $data); // Log the failed rows
                        $data = [];
                    }
                }

                $processedRows++;
                Cache::put('processed_rows', $processedRows, 6000);
            }

            // Insert any remaining data
            if (count($data) > 0) {
                try {
                    if ($data_type === 'buyer') {
                        BuyerSellerData::insert($data);
                    } elseif ($data_type === 'supplier') {
                        SellerSellerData::insert($data);
                    }
                } catch (\Exception $e) {
                    Log::error('Final batch insert failed', [
                        'data' => $data,
                        'error' => $e->getMessage()
                    ]);
                    $failedRows = array_merge($failedRows, $data); // Log the failed rows
                }
            }

            if (!empty($failedRows)) {
                Log::error('Failed rows during processing', [
                    'rows' => $failedRows
                ]);
            }
        });

        fclose($file);

        // Update the processed rows count
        Cache::put('processed_rows', $processedRows, 6000);

        return response()->json([
            'success' => true,
            'row_count' => $processedRows,
            'message' => 'File processed successfully'
        ]);
    }


    public function getBuyerSellerData(Request $request)
    {
        $columns = [
            'id',
            'data_type',
            'buyer_country',
            'unloading_port',
            'mode',
            'loading_country',
            'loading_port',
            'hs_02',
            'business_category',
            'hs_04',
            'sub_category_i',
            'hs_code_08',
            'sub_category_ii',
            'product_description',
            'buyer_code',
            'buyer_name',
            'buyer_address',
            'buyer_city',
            'pin_code',
            'buyer_state',
            'country_code',
            'buyer_phone',
            'buyer_mobile_ii',
            'buyer_email_i',
            'buyer_email_ii',
            'website',
            'contact_person',
        ];

        $totalData = DB::table('buyer_seller_data')->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $buyer_seller_data = DB::table('buyer_seller_data')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $buyer_seller_data = DB::table('buyer_seller_data')
                ->where('buyer_name', 'LIKE', "%{$search}%")
                ->orWhere('buyer_country', 'LIKE', "%{$search}%")
                ->orWhere('buyer_address', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = DB::table('buyer_seller_data')
                ->where('buyer_name', 'LIKE', "%{$search}%")
                ->orWhere('buyer_country', 'LIKE', "%{$search}%")
                ->orWhere('buyer_address', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = [];
        foreach ($buyer_seller_data as $row) {
            $nestedData = [
                'id' => $row->id,
                'data_type' => $row->data_type,
                'buyer_country' => $row->buyer_country,
                'unloading_port' => $row->unloading_port,
                'mode' => $row->mode,
                'loading_country' => $row->loading_country,
                'loading_port' => $row->loading_port,
                'hs_02' => $row->hs_02,
                'business_category' => $row->business_category,
                'hs_04' => $row->hs_04,
                'sub_category_i' => $row->sub_category_i,
                'hs_code_08' => $row->hs_code_08,
                'sub_category_ii' => $row->sub_category_ii,
                'product_description' => $row->product_description,
                'buyer_code' => $row->buyer_code,
                'buyer_name' => $row->buyer_name,
                'buyer_address' => $row->buyer_address,
                'buyer_city' => $row->buyer_city,
                'pin_code' => $row->pin_code,
                'buyer_state' => $row->buyer_state,
                'country_code' => $row->country_code,
                'buyer_phone' => $row->buyer_phone,
                'buyer_mobile_ii' => $row->buyer_mobile_ii,
                'buyer_email_i' => $row->buyer_email_i,
                'buyer_email_ii' => $row->buyer_email_ii,
                'website' => $row->website,
                'contact_person' => $row->contact_person,
            
            ];

            $data[] = $nestedData;
        }

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        return response()->json($json_data);
    }

    public function edit($id)
    {
        
        // Fetch the specific row by ID
        $buyerSellerData = DB::table('buyer_seller_data')->where('id', $id)->first();
        
        // Pass the data to the edit view
        return view('admin.editBuyerSeller', compact('buyerSellerData'));
    }

    public function update(Request $request, $id)
    {
        $adminName = session('admin_name');
        
        // Validate the input data
        $request->validate([
            'data_type' => 'nullable|string',
            'buyer_country' => 'nullable|string',
            'unloading_port' => 'nullable|string',
            'mode' => 'nullable|string',
            'loading_country' => 'nullable|string',
            'loading_port' => 'nullable|string',
            'hs_02' => 'nullable|string',
            'business_category' => 'nullable|string',
            'hs_04' => 'nullable|string',
            'sub_category_i' => 'nullable|string',
            'hs_code_08' => 'nullable|string',
            'sub_category_ii' => 'nullable|string',
            'product_description' => 'nullable|string',
            'buyer_code' => 'nullable|string',
            'buyer_name' => 'nullable|string|max:255',
            'buyer_address' => 'nullable|string',
            'buyer_city' => 'nullable|string',
            'pin_code' => 'nullable|string',
            'buyer_state' => 'nullable|string',
            'country_code' => 'nullable|string',
            'buyer_phone' => 'nullable|string',
            'buyer_mobile_ii' => 'nullable|string',
            'buyer_email_i' => 'nullable|email',
            'buyer_email_ii' => 'nullable|email',
            'website' => 'nullable|string',
            'contact_person' => 'nullable|string',
        ]);

        // Update the row in the database
        DB::table('buyer_seller_data')
            ->where('buyer_code', $id)
            ->update([
                // 'data_type' => $request->input('data_type'),
                // 'buyer_country' => $request->input('buyer_country'),
                // 'unloading_port' => $request->input('unloading_port'),
                // 'mode' => $request->input('mode'),
                // 'loading_country' => $request->input('loading_country'),
                // 'loading_port' => $request->input('loading_port'),
                // 'hs_02' => $request->input('hs_02'),
                // 'business_category' => $request->input('business_category'),
                // 'hs_04' => $request->input('hs_04'),
                // 'sub_category_i' => $request->input('sub_category_i'),
                // 'hs_code_08' => $request->input('hs_code_08'),
                // 'sub_category_ii' => $request->input('sub_category_ii'),
                // 'product_description' => $request->input('product_description'),
                // 'buyer_code' => $request->input('buyer_code'),
                'buyer_name' => $request->input('buyer_name'),
                'buyer_address' => $request->input('buyer_address'),
                'buyer_city' => $request->input('buyer_city'),
                'pin_code' => $request->input('pin_code'),
                'buyer_state' => $request->input('buyer_state'),
                'country_code' => $request->input('country_code'),
                'buyer_phone' => $request->input('buyer_phone'),
                'buyer_mobile_ii' => $request->input('buyer_mobile_ii'),
                'buyer_email_i' => $request->input('buyer_email_i'),
                'buyer_email_ii' => $request->input('buyer_email_ii'),
                'report_contact'=>null,
                'website' => $request->input('website'),
                'contact_person' => $request->input('contact_person'),
            ]);
        

        // Check if the buyer_code exists in the reports table
            $reportExists = DB::table('reports')
            ->where('code', $id) // Assuming row_id corresponds to buyer_code
            ->exists();

        if ($reportExists) {
            // Update the report status to 'success'
            //
            DB::table('reports')
                ->where('code', $id)
                ->update(['status' => 'success','corrected_by' => $adminName]);
        }
        // Redirect back to the main DataTable view with a success message
        return redirect()->route('BuyerDataShow')->with('success', 'Buyer Seller data updated successfully');
    }

    public function getSellerData(Request $request)
    {
        $columns = [
            'id',
            'data_type',
            'supplier_country',
            'loading_port',
            'mode',
            'unloading_port',
            'unloading_country',
            'hs_02',
            'business_category',
            'hs_04',
            'sub_category_i',
            'hs_code_08',
            'sub_category_ii',
            'product_description',
            'supplier_code',
            'supplier_name',
            'supplier_address',
            'supplier_city',
            'supplier_pin_code',
            'supplier_state',
            'country_code',
            'supplier_phone',
            'supplier_mobile',
            'supplier_email_i',
            'supplier_email_ii',
            'supplier_website',
            'contact_person',
            'show_contact_details',
            'call_button',
            'whatsapp_button',
            'report_contact',
            'save_to_favorite',
            'edit_contact',
            'duplicate_filter',
            'created_at',
            'updated_at',
        ];
    
        $totalData = DB::table('seller_seller_data')->count();
        $totalFiltered = $totalData;
    
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
    
        if (empty($request->input('search.value'))) {
            $seller_data = DB::table('seller_seller_data')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
    
            $seller_data = DB::table('seller_seller_data')
                ->where('supplier_name', 'LIKE', "%{$search}%")
                ->orWhere('supplier_country', 'LIKE', "%{$search}%")
                ->orWhere('supplier_address', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
    
            $totalFiltered = DB::table('seller_seller_data')
                ->where('supplier_name', 'LIKE', "%{$search}%")
                ->orWhere('supplier_country', 'LIKE', "%{$search}%")
                ->orWhere('supplier_address', 'LIKE', "%{$search}%")
                ->count();
        }
    
        $data = [];
        foreach ($seller_data as $row) {
            $nestedData = [
                'id' => $row->id,
                'data_type' => $row->data_type,
                'supplier_country' => $row->supplier_country,
                'loading_port' => $row->loading_port,
                'mode' => $row->mode,
                'unloading_port' => $row->unloading_port,
                'unloading_country' => $row->unloading_country,
                'hs_02' => $row->hs_02,
                'business_category' => $row->business_category,
                'hs_04' => $row->hs_04,
                'sub_category_i' => $row->sub_category_i,
                'hs_code_08' => $row->hs_code_08,
                'sub_category_ii' => $row->sub_category_ii,
                'product_description' => $row->product_description,
                'supplier_code' => $row->supplier_code,
                'supplier_name' => $row->supplier_name,
                'supplier_address' => $row->supplier_address,
                'supplier_city' => $row->supplier_city,
                'supplier_pin_code' => $row->supplier_pin_code,
                'supplier_state' => $row->supplier_state,
                'country_code' => $row->country_code,
                'supplier_phone' => $row->supplier_phone,
                'supplier_mobile' => $row->supplier_mobile,
                'supplier_email_i' => $row->supplier_email_i,
                'supplier_email_ii' => $row->supplier_email_ii,
                'supplier_website' => $row->supplier_website,
                'contact_person' => $row->contact_person,
                // 'show_contact_details' => $row->show_contact_details,
                // 'call_button' => $row->call_button,
                // 'whatsapp_button' => $row->whatsapp_button,
                // 'report_contact' => $row->report_contact,
                // 'save_to_favorite' => $row->save_to_favorite,
                // 'edit_contact' => $row->edit_contact,
                // 'duplicate_filter' => $row->duplicate_filter,
                // 'created_at' => $row->created_at,
                // 'updated_at' => $row->updated_at,
            ];
    
            $data[] = $nestedData;
        }
    
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];
    
        return response()->json($json_data);
    }
    
    public function sellerEdit($id)
    {
        // Fetch the specific row by ID from the seller_seller_data table
        $sellerData = DB::table('seller_seller_data')->where('id', $id)->first();
        
        // Pass the data to the edit view
        return view('admin.editSeller', compact('sellerData'));
    }

    public function sellerUpdate(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            // 'data_type' => 'nullable|string',
            // 'supplier_country' => 'nullable|string',
            // 'unloading_port' => 'nullable|string',
            // 'mode' => 'nullable|string',
            // 'unloading_country' => 'nullable|string',
            // 'loading_port' => 'nullable|string',
            // 'hs_02' => 'nullable|string',
            // 'business_category' => 'nullable|string',
            // 'hs_04' => 'nullable|string',
            // 'sub_category_i' => 'nullable|string',
            // 'hs_code_08' => 'nullable|string',
            // 'sub_category_ii' => 'nullable|string',
            // 'product_description' => 'nullable|string',
            // 'supplier_code' => 'nullable|string',
            'supplier_name' => 'nullable|string|max:255',
            'supplier_address' => 'nullable|string',
            'supplier_city' => 'nullable|string',
            'supplier_pin_code' => 'nullable|string',
            'supplier_state' => 'nullable|string',
            'country_code' => 'nullable|string',
            'supplier_phone' => 'nullable|string',
            'supplier_mobile' => 'nullable|string',
            'supplier_email_i' => 'nullable|email',
            'supplier_email_ii' => 'nullable|email',
            'supplier_website' => 'nullable|string',
            'contact_person' => 'nullable|string',
        ]);
    
        // Update the row in the database
        DB::table('seller_seller_data')
            ->where('id', $id)
            ->update([
                // 'data_type' => $request->input('data_type'),
                // 'supplier_country' => $request->input('supplier_country'),
                // 'unloading_port' => $request->input('unloading_port'),
                // 'mode' => $request->input('mode'),
                // 'unloading_country' => $request->input('unloading_country'),
                // 'loading_port' => $request->input('loading_port'),
                // 'hs_02' => $request->input('hs_02'),
                // 'business_category' => $request->input('business_category'),
                // 'hs_04' => $request->input('hs_04'),
                // 'sub_category_i' => $request->input('sub_category_i'),
                // 'hs_code_08' => $request->input('hs_code_08'),
                // 'sub_category_ii' => $request->input('sub_category_ii'),
                // 'product_description' => $request->input('product_description'),
                // 'supplier_code' => $request->input('supplier_code'),
                'supplier_name' => $request->input('supplier_name'),
                'supplier_address' => $request->input('supplier_address'),
                'supplier_city' => $request->input('supplier_city'),
                'supplier_pin_code' => $request->input('supplier_pin_code'),
                'supplier_state' => $request->input('supplier_state'),
                'country_code' => $request->input('country_code'),
                'supplier_phone' => $request->input('supplier_phone'),
                'supplier_mobile' => $request->input('supplier_mobile'),
                'report_contact'=>null,
                'supplier_email_i' => $request->input('supplier_email_i'),
                'supplier_email_ii' => $request->input('supplier_email_ii'),
                'supplier_website' => $request->input('supplier_website'),
                'contact_person' => $request->input('contact_person'),
            ]);
    
        // Redirect back to the main DataTable view with a success message
        return redirect()->route('SellerDataShow')->with('success', 'Seller data updated successfully');
    }
    

    public function reports()
    {
        // $data = DB::table('reports')->get();
        // $data = DB::table('reports')->where('status','pending')->get();
        $data = DB::table('reports')
    ->orderByRaw("status = 'pending' DESC") // Prioritize 'pending' status first
    ->orderBy('created_at', 'desc') // Optional: add another ordering criterion if needed
    ->get();
        // dd($data);
    return view('admin.reports', compact('data'));
    }
}
