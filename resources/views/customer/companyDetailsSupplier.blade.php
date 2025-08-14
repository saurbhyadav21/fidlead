@extends('layouts.customerapp')

@section('title', 'Search')

@section('content')
<style>
    /* Truncate text with ellipsis */
    /* Truncate text with ellipsis */
    /* Truncate text with ellipsis */
    .truncated-text {
        white-space: nowrap;              /* Prevent text from wrapping */
        overflow: hidden;                 /* Hide overflowing text */
        text-overflow: ellipsis;          /* Show ellipsis when text overflows */
        width: 200px;                     /* Set a width to enable truncation */
        display: inline-block;            /* Ensure the text stays on a single line */
        position: relative;               /* Necessary for positioning the tooltip */
    }
    
    .truncated-text:hover {
        overflow: visible;                /* Allow text to overflow on hover */
        white-space: normal;              /* Allow text wrapping */
        background-color: #f9f9f9;        /* Optional: Add a background on hover */
        border: 1px solid #ccc;           /* Optional: Border around the tooltip */
        padding: 5px;                     /* Optional: Add padding */
        position: absolute;               /* Position the tooltip on hover */
        z-index: 1000;                    /* Ensure the tooltip is on top */
        max-width: 400px;                 /* Max width for the tooltip */
        box-shadow: 0 2px 8px rgba(0,0,0,0.2); /* Optional: Add shadow for better visibility */
    }
    
    /* Tooltip Styling (Shows full text when hovered) */
    .truncated-text:hover::after {
        content: attr(data-full-description); /* Use the full description from the data attribute */
        position: absolute;
        top: 100%;                       /* Position the tooltip just below the truncated text */
        left: 0;
        width: 300px;                    /* Max width for the tooltip */
        padding: 8px;
        background-color: #f9f9f9;       /* Light background for the tooltip */
        border: 1px solid #ccc;          /* Border around the tooltip */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Shadow to give it depth */
        white-space: normal;             /* Allow text to wrap in the tooltip */
        z-index: 1000;                   /* Ensure the tooltip is above other content */
        font-size: 14px;                 /* Adjust font size in the tooltip */
    }
    
     </style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12">
                    <div class="containerx">
                        <h2>Companies for Buyer: {{ $buyer_name }}</h2>
                        <table id="resultsTable" class="table table-bordered table-striped"  style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Data Type</th>
            <th>Supplier Country</th>
            <th>Unloading Port</th>
            <th>Mode</th>
            <th>UnLoading Country</th>
            <th>Loading Port</th>
            <th>HS 02</th>
            <th>Business Category</th>
            <th>HS 04</th>
            <th>Sub Category I</th>
            <th>HS Code 08</th>
            <th>Sub Category II</th>
            <th>Product Description</th>
            <th>Supplier Code</th>
            <th>Supplier Name</th>
            <th>Supplier Address</th>
            <th>Supplier City</th>
            <th>Supplier Pincode</th>
            <th>Supplier State</th>
            <th>Country Code</th>
            <th>Supplier Phone</th>
            <th>Supplier Mobile II</th>
            <th>Supplier Email I</th>
            <th>Supplier Email II</th>
            <th>Website</th>
            <th>Contact Person</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->data_type }}</td>
                                    <td>{{ $company->supplier_country }}</td>
                                    <td>{{ $company->unloading_port }}</td>
                                    <td>{{ $company->mode }}</td>
                                    <td>{{ $company->unloading_country }}</td>
                                    <td>{{ $company->loading_port }}</td>
                                    <td>{{ $company->hs_02 }}</td>
                                    <td>{{ $company->business_category }}</td>
                                    <td>{{ $company->hs_04 }}</td>
                                    <td>{{ $company->sub_category_i }}</td>
                                    <td>{{ $company->hs_code_08 }}</td>
                                    <td>{{ $company->sub_category_ii }}</td>
                                    {{-- <td>{{ $company->product_description }}</td> --}}
                                    <td class="truncated-text" 
                                            data-full-description="{{ $company->product_description }}">
                                            {{ Str::limit($company->product_description, 30) }} <!-- Truncate the description -->
                                        </td>
                                    <td>{{ $company->supplier_code }}</td>
                                    <td>{{ $company->supplier_name }}</td>
                                    {{-- <td>{{ $company->supplier_address }}</td> --}}
                                    <td class="truncated-text" 
                                            data-full-description="{{ $company->supplier_address }}">
                                            {{ Str::limit($company->supplier_address, 30) }} <!-- Truncate the description -->
                                        </td>
                                    <td>{{ $company->supplier_city }}</td>
                                    <td>{{ $company->supplier_pin_code }}</td>
                                    <td>{{ $company->supplier_state }}</td>
                                    <td>{{ $company->is_purchased ? $company->country_code : '*****' }}</td>
                                    <td>{{ $company->is_purchased ? $company->supplier_phone : '*****' }}</td>
                                    <td>{{ $company->is_purchased ? $company->supplier_mobile : '*****' }}</td>
                                    <td>{{ $company->is_purchased ? $company->supplier_email_i : '*****' }}</td>
                                    <td>{{ $company->is_purchased ? $company->supplier_email_ii : '*****' }}</td>
                                    <td>{{ $company->is_purchased ? $company->supplier_website : '*****' }}</td>
                                    <td>{{ $company->is_purchased ? $company->contact_person : '*****' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div> 

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.3.2/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#resultsTable').DataTable({
            searching: true,
            paging: true,
            info: true,
            "scrollX": true,
            searchPanes: {
                viewTotal: true,
                threshold: 1,
                columns: [1, 2, 3, 4,5, 6, 7, 8, 9, 10, 11, 12],
                cascadePanes: true,
                layout: 'columns-1',
                initComplete: function() {
                    $('.dtsp-panesContainer').hide();
                }
            },
            dom: '<"row"<"col-sm-2"Pl><"col-sm-10"frtip>>',
            // drawCallback: function(settings) {
            //     var api = this.api();
            //     api.rows().nodes().each(function(row, i) {
            //         var data = api.row(row).data();
            //         if (data.is_purchased) {
            //             $(row).addClass('table-success');
            //         }
            //     });
            // }
        });
    });
</script>
@endsection
