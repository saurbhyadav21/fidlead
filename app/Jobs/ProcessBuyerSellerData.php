<?php

namespace App\Jobs;

use App\Models\BuyerSellerData;
use App\Models\SellerSellerData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\ToArray;
use Exception;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProcessBuyerSellerData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $dataType;
    protected $jobId;

    public function __construct($filePath, $dataType, $jobId)
    {
        $this->filePath = $filePath;
        $this->dataType = $dataType;
        $this->jobId = $jobId;
    }

    public function handle()
    {
        // ini_set('memory_limit', '10240M');
        // ini_set('max_execution_time', 3000);

        $startTime = microtime(true);
        try {
            $filePath = Storage::path($this->filePath);

            if (!file_exists($filePath)) {
                Log::error('File not found.', ['file_path' => $filePath]);
                throw new Exception('File not found.');
            }

            // Load the Excel file
            $data = Excel::toArray(new class implements ToArray {
                public function array(array $array)
                {
                    return $array;
                }
            }, $filePath);

            if (empty($data) || !isset($data[0])) {
                throw new Exception('No data found in the file.');
            }

            $totalLines = count($data[0]);
            $chunkSize = 1000;
            $chunks = array_chunk($data[0], $chunkSize);
            $rowNumber = 0;
            dd($totalLines);
            foreach ($chunks as $chunk) {
                foreach ($chunk as $row) {
                    $rowNumber++;

                    // Check if the row is empty
                    if (empty(array_filter($row))) {
                        Log::info('Skipping empty row', [
                            'row_number' => $rowNumber
                        ]);
                        continue;
                    }   

                    Log::info('Processing row ' . $rowNumber);


                    // Insert data into the database
                    // try {
                    //     BuyerSellerData::create([
                    //         'data_type' => isset($row[0]) ? trim($row[0]) : 'N/A',
                    //         'buyer_country' => isset($row[1]) ? trim($row[1]) : 'N/A',
                    //         'unloading_port' => isset($row[2]) ? trim($row[2]) : 'N/A',
                    //         'mode' => isset($row[3]) ? trim($row[3]) : 'N/A',
                    //         'loading_country' => isset($row[4]) ? trim($row[4]) : 'N/A',
                    //         'loading_port' => isset($row[5]) ? trim($row[5]) : 'N/A',
                    //         'hs_02' => isset($row[6]) ? trim($row[6]) : 'N/A',
                    //         'business_category' => isset($row[7]) ? trim($row[7]) : 'N/A',
                    //         'hs_04' => isset($row[8]) ? trim($row[8]) : 'N/A',
                    //         'sub_category_i' => isset($row[9]) ? trim($row[9]) : 'N/A',
                    //         'hs_code_08' => isset($row[10]) ? trim($row[10]) : 'N/A',
                    //         'sub_category_ii' => isset($row[11]) ? trim($row[11]) : 'N/A',
                    //         'product_description' => isset($row[12]) ? trim($row[12]) : 'N/A',
                    //         'buyer_code' => isset($row[13]) ? trim($row[13]) : 'N/A',
                    //         'buyer_name' => isset($row[14]) ? trim($row[14]) : 'N/A',
                    //         'buyer_address' => isset($row[15]) ? trim($row[15]) : 'N/A',
                    //         'buyer_city' => isset($row[16]) ? trim($row[16]) : 'N/A',
                    //         'pin_code' => isset($row[17]) ? trim($row[17]) : 'N/A',
                    //         'buyer_state' => isset($row[18]) ? trim($row[18]) : 'N/A',
                    //         'country_code' => isset($row[19]) ? trim($row[19]) : 'N/A',
                    //         'buyer_phone' => isset($row[20]) ? trim($row[20]) : 'N/A',
                    //         'buyer_mobile_ii' => isset($row[21]) ? trim($row[21]) : 'N/A',
                    //         'buyer_email_i' => isset($row[22]) ? trim($row[22]) : 'N/A',
                    //         'buyer_email_ii' => isset($row[23]) ? trim($row[23]) : 'N/A',
                    //         'website' => isset($row[24]) ? trim($row[24]) : 'N/A',
                    //         'contact_person' => isset($row[25]) ? trim($row[25]) : 'N/A',
                    //         'show_contact_details' => isset($row[26]) ? trim($row[26]) : 'N/A',
                    //         'call_button' => isset($row[27]) ? trim($row[27]) : 'N/A',
                    //         'whatsapp_button' => isset($row[28]) ? trim($row[28]) : 'N/A',
                    //         'report_contact' => isset($row[29]) ? trim($row[29]) : 'N/A',
                    //         'save_to_favorite' => isset($row[30]) ? trim($row[30]) : 'N/A',
                    //         'edit_contact' => isset($row[31]) ? trim($row[31]) : 'N/A',
                    //     ]);
                    // } catch (Exception $e) {
                    //     Log::error('Database insert error', [
                    //         'row_number' => $rowNumber,
                    //         'data_type' => $this->dataType,
                    //         'error' => $e->getMessage(),
                    //         'data' => $row
                    //     ]);
                    // }

                    // Optionally, track progress
                    // $progress = ($rowNumber / $totalLines) * 100;
                    // Log::info('Processing progress:', ['progress' => $progress]);
                }
            }
        } catch (Exception $e) {
            Log::error('Error processing file: ' . $e->getMessage(), [
                'file_path' => $this->filePath,
                'data_type' => $this->dataType
            ]);
        }

        $endTime = microtime(true);
        $duration = $endTime - $startTime;
        Log::info('ProcessBuyerSellerData job duration: ' . $duration . ' seconds');
    }
}
