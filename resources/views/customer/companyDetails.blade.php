@extends('layouts.customerapp')

@section('title', 'Search')

@section('content')
<style>
        /* Styling for Scroll Buttons */
        .scroll-btn {
            position: absolute;
            top: 25%;
            transform: translateY(-50%);
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 100;
            font-size: 16px;
        }
        .left-btn {     position: fixed;
    top: 70%;
    left: 5px;
    margin-left: 17%;
    z-index: 1000;}
    .right-btn {
    right: 5px;
    position: fixed;
    top: 70%;
}
        
        /* Ensure the table is scrollable */
        .table-responsive-buyer {
            overflow-x: auto;
            max-width: 100%;
            white-space: nowrap;
        }
        div.dtsp-panesContainer div.dtsp-searchPanes div.dtsp-searchPane{
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1) !important;
        }
        div.dataTables_wrapper
        {
            position: relative;
            overflow-y: auto;
            max-height: 663px;
        }
        </style>
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
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Companies</li>
                </ol>
                {{-- <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    
                </div> --}}
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12">
                    <div class="containerx">
                        <h2 style="font-size: 24px;text-decoration: underline;">Companies for Buyer: {{ $buyer_name }}</h2>
                        <button class="scroll-btn left-btn">⬅</button>
                        <table id="resultsTable" class="table table-bordered table-striped" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Data Type</th>
                                    <th>Buyer Country</th>
                                    <th>Unloading Port</th>
                                    <th>Mode</th>
                                    <th>Loading Country</th>
                                    <th>Loading Port</th>
                                    <th>HS Code 08</th>
                                    <th>Product Description</th>
                                    <th>Buyer Code</th>
                                    <th>Buyer Name</th>
                                    <th>Buyer Address</th>
                                    <th>Buyer City</th>
                                    <th>Buyer Pincode</th>
                                    <th>Buyer State</th>
                                    <th>Country Code</th>
                                    <th>Buyer Phone</th>
                                    <th>Buyer Mobile II</th>
                                    <th>Buyer Email I</th>
                                    <th>Buyer Email II</th>
                                    <th>Website</th>
                                    <th>Contact Person</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->data_type }}</td>
                                        <td>{{ $company->buyer_country }}</td>
                                        <td>{{ $company->unloading_port }}</td>
                                        <td>{{ $company->mode }}</td>
                                        <td>{{ $company->loading_country }}</td>
                                        <td>{{ $company->loading_port }}</td>
                                        <td>{{ $company->hs_code_08 }}</td>
                                        <td class="truncated-text" 
                                            data-full-description="{{ $company->product_description }}">
                                            {{ Str::limit($company->product_description, 30) }} <!-- Truncate the description -->
                                        </td>

                                        <td>{{ $company->buyer_code }}</td>
                                        <td>{{ $company->buyer_name }}</td>
                                        <td class="truncated-text" 
                                            data-full-description="{{ $company->buyer_address }}">
                                            {{ Str::limit($company->buyer_address, 30) }} <!-- Truncate the description -->
                                        </td>
                                        <td>{{ $company->buyer_city }}</td>
                                        <td>{{ $company->pin_code }}</td>
                                        <td>{{ $company->buyer_state }}</td>
                                        <td>{{ $company->is_purchased ? $company->country_code : '*****' }}</td>
                                        <td>{{ $company->is_purchased ? $company->buyer_phone : '*****' }}</td>
                                        <td>{{ $company->is_purchased ? $company->buyer_mobile_ii : '*****' }}</td>
                                        <td>{{ $company->is_purchased ? $company->buyer_email_i : '*****' }}</td>
                                        <td>{{ $company->is_purchased ? $company->buyer_email_ii : '*****' }}</td>
                                        <td>{{ $company->is_purchased ? $company->website : '*****' }}</td>
                                        <td>{{ $company->is_purchased ? $company->contact_person : '*****' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                         <button class="scroll-btn right-btn">➡</button>
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
            processing: true,
                    serverSide: false,
                    searching: true,
                    paging: true,
                    info: true,
                    pageLength: 50,
                    "scrollX": true,
                    searchPanes: {
                         initCollapsed: true,
                        viewTotal: true,
                        threshold: 1,
                        // columns: [1, 2, 3, 4,5, 6, 7, 8, 9, 10, 11, 12],
                        columns: [11,12,13,6,2,4,5,3],
                        cascadePanes: true, // Allow filters to dynamically affect others
                        layout: 'columns-1',
                        dtOpts: {
                            paging: false, // Disable paging in panes
                            dom: 'tp' // Show only the table in panes
                        },
                        initComplete: function() {
                        // Force the search panes container to always show
                        $('.dtsp-panesContainer').css('display', 'block');
                        $('#resultsTable').css('font-size', '14px');
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


         var scrollContainer = $('.dataTables_scrollBody'); // Select scrollable div

            $('.left-btn').click(function() {
                scrollContainer.animate({ scrollLeft: '-=200' }, 'slow'); // Scroll left
            });

            $('.right-btn').click(function() {
                scrollContainer.animate({ scrollLeft: '+=200' }, 'slow'); // Scroll right
            });
    });
</script>
@endsection
