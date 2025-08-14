@extends('layouts.customerapp')

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
    /* margin-left: 17%; */
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
    /* Styling for the tabs */
    .tabs {
        display: flex;
        border-bottom: 2px solid #ddd;
        margin-bottom: 10px;
    }
    .tab-button {
        padding: 10px 20px;
        cursor: pointer;
        border: 1px solid #ddd;
        border-radius: 5px 5px 0 0;
        margin-right: 5px;
        background-color: #f1f1f1;
    }
    .tab-button.active {
        background-color: #ddd;
        font-weight: bold;
    }

    /* Hide tables by default */
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }

    /* Truncate text with ellipsis */
    .truncated-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 200px;
        height: 60px;
        display: inline-block;
    }

    /* Styling the tooltip */
    .truncated-text:hover::after {
        content: attr(data-full-description);
        position: absolute;
        top: 100%;
        left: 0;
        width: 300px;
        padding: 8px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        white-space: normal;
        z-index: 1000;
        font-size: 14px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;  /* Light grey border */
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- <div class="row mb-2"> --}}
                {{-- <div class="col-sm-6">
                    <h1 class="m-0">Favorites</h1>
                </div> --}}
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Favorites</li>
                    </ol>
                </div> --}}
            {{-- </div> --}}

            <div class="row mb-2">
                {{-- <div class="col-sm-6">
                    <h1 class="m-0">Favorites</h1>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Favorites</li>
                    </ol>
                </div>
            </div>


        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12">
                    <div class="contaxiner">
                        {{-- Tabs for Buyers and Suppliers --}}
                        <div class="tabs">
                            <button class="tab-button active" id="buyersTab">Buyers</button>
                            <button class="tab-button" id="suppliersTab">Suppliers</button>
                        </div>

                        <!-- Tab content for Buyers -->
                        <div class="tab-content active" id="buyersTabContent">
                            <h3>Buyers</h3>
                            <button class="scroll-btn left-btn">⬅</button>
                            <table id="buyersTable" class="display" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>Buyer Country</th>
                                        <th>Buyer Name </th>
                                        <th>Buyer Address</th>
                                        <th>Buyer City</th>
                                        <th>Buyer Pincode</th>
                                        <th>Buyer State</th>
                                    
                                        <th>Hs 02</th>
                                        <th>Hs 04</th>
                                        <th>Hs 08</th>

                                        <th>Unloading Port</th>
                                        <th>Loading Country</th>
                                        <th>Loading Port</th>
                                        <th>Mode</th>
                    
                                        <th>Country Code</th>
                                        <th>Buyer phone-1</th>
                                        <th>Buyer phone-2</th>
                                        <th>Buyer Email-1</th>
                                        <th>Buyer Email-2</th>
                                        <th>Buyer Website</th>
                                        <th>Contact Person</th>


                                        <th>Show Contact Button</th>
                                        <th>Buyer Call Button</th>
                                        <th>Buyer WhatsApp Button</th>
                                        <th>Report Contact Button</th>
                                        <th>UnFavorite</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favorites['buyers'] as $buyer)
                                        <tr>
                                            <td>{{ $buyer->buyer_country ?? 'N/A' }}</td>
                                            <td>
    @if(!empty($buyer->buyer_name))
        <a href="{{ route('companies.showBuyer', $buyer->buyer_name) }}" target="_blank">
            <i class="fas fa-industry"></i> {{ $buyer->buyer_name }}
        </a>
    @else
        N/A
    @endif
</td>
                                           {{-- <td class="truncated-text" title="{{ $buyer->buyer_address }}">
                                                {{ Str::limit($buyer->buyer_address, 120) }}
                                            </td> --}}
                                             <td class="truncated-text" 
                                                data-full-description="{{ $buyer->buyer_address }}">
                                                {{ Str::limit($buyer->buyer_address, 30) }} <!-- Truncate the description -->
                                            </td>

                                            <td>{{ $buyer->buyer_city ?? 'N/A' }}</td>
                                            <td>{{ $buyer->pin_code ?? 'N/A' }}</td>
                                            <td>{{ $buyer->buyer_state ?? 'N/A' }}</td>
                                            <td>{{ $buyer->hs_02 ?? 'N/A' }}</td>
                                            <td>{{ $buyer->hs_04 ?? 'N/A' }}</td>
                                            <td>{{ $buyer->hs_code_08 ?? 'N/A' }}</td>
                                            <td>{{ $buyer->unloading_port ?? 'N/A' }}</td>
                                            <td>{{ $buyer->loading_country ?? 'N/A' }}</td>
                                            <td>{{ $buyer->loading_port ?? 'N/A' }}</td>
                                            <td>{{ $buyer->mode ?? 'N/A' }}</td>
                                            <td>{{ $buyer->country_code ?? 'N/A' }}</td>
                                            <td>{{ $buyer->buyer_phone ?? 'N/A' }}</td>
                                            <td>{{ $buyer->buyer_mobile_ii ?? 'N/A' }}</td>
                                            <td>{{ $buyer->buyer_email_i ?? 'N/A' }}</td>
                                            <td>{{ $buyer->buyer_email_ii ?? 'N/A' }}</td>
                                            <td>{{ $buyer->website ?? 'N/A' }}</td>
                                            <td>{{ $buyer->contact_person ?? 'N/A' }}</td>
                                            <td></td>
                                            <td>
                                                <a href="tel:{{ $buyer->buyer_phone }}" class="btn btn-success">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                            </td>                                            
                                            <td>
                                                <a href="https://wa.me/{{ $buyer->buyer_phone }}" target="_blank" class="btn btn-info">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </td>                                            
                                            <td>
                                                @if (is_null($buyer->report_contact))
                                                    <!-- Show the dropdown if report_contact is null  -->
                                                    <select class="form-control report-dropdown" data-id="{{ $buyer->id }}" data-name="buyer">
                                                        <option value="report">Select</option>
                                                        <option value="wrong_email">Wrong Email</option>
                                                        <option value="mobile_number">Mobile Number</option>
                                                        <option value="wrong_address">Wrong Address</option>
                                                    </select>
                                                @else
                                                    <!-- Display the appropriate message based on the value of report_contact -->
                                                    @switch($buyer->report_contact)
                                                        @case('wrong_email')
                                                            <span>Reported as Wrong Email</span>
                                                            @break
                                                        @case('mobile_number')
                                                            <span>Reported as Wrong Mobile Number</span>
                                                            @break
                                                        @case('wrong_address')
                                                            <span>Reported as Wrong Address</span>
                                                            @break
                                                        @default
                                                            <span>{{ $buyer->report_contact }}</span>
                                                    @endswitch
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fa fa-heart unfavorite" aria-hidden="true" style="color: red; font-size:28px;" id="{{ $buyer->favorite_id }}"></i></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="scroll-btn right-btn">➡</button>
                        </div>

                        <!-- Tab content for Suppliers -->
                        <div class="tab-content" id="suppliersTabContent">
                            <h3>Suppliers</h3>
                             <button class="scroll-btn left-btn">⬅</button>
                            <table id="suppliersTable" class="display" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>Supplier Country</th>
                                        <th>Supplier Name</th>
                                        <th>Supplier Address</th>
                                        <th>Supplier City</th>
                                        <th>Supplier Pincode</th>
                                        <th>Supplier State</th>

                                        <th>Hs 04</th>
                                        <th>Hs 08</th>  

                                        <th>Loading Port</th>
                                        <th>Unloading Port</th>
                                        <th>Unloading Country</th>
                                        <th>Mode</th>

                                        <th>Country Code</th>
                                        <th>Supplier Phone-1</th>
                                        <th>Supplier Phone-2</th>
                                        <th>Supplier Email-1</th>
                                        <th>Supplier Email-2</th>

                                        <th>Supplier Website</th>
                                        <th>Contact Person</th>

                                        <th>Show Contact Button</th>
                                        <th>Buyer Call Button</th>
                                        <th>Buyer WhatsApp Button</th>
                                        <th>Report Contact Button</th>
                                        <th>UnFavorite</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favorites['suppliers'] as $supplier)
                                        <tr>
                                            <td>{{ $supplier->supplier_country ?? 'N/A' }}</td>
                                            <td>
    @if(!empty($supplier->supplier_name))
        <a href="{{ route('companies.showSupplier', $supplier->supplier_name) }}" target="_blank">
            <i class="fas fa-industry"></i> {{ $supplier->supplier_name }}
        </a>
    @else
        N/A
    @endif
</td>
                                            <td>{{ $supplier->supplier_address ?? 'N/A' }}</td>
                                            <td>{{ $supplier->supplier_city ?? 'N/A' }}</td>
                                            <td>{{ $supplier->supplier_pin_code ?? 'N/A' }}</td>
                                            <td>{{ $supplier->supplier_state ?? 'N/A' }}</td>

                                            <td>{{ $supplier->hs_02 ?? 'N/A' }}</td>
                                            <td>{{ $supplier->hs_04 ?? 'N/A' }}</td>


                                            <td>{{ $supplier->loading_port ?? 'N/A' }}</td>
                                            <td>{{ $supplier->unloading_port ?? 'N/A' }}</td>
                                            <td>{{ $supplier->unloading_country ?? 'N/A' }}</td>
                                            <td>{{ $supplier->mode ?? 'N/A' }}</td>

                                            <td>{{ $supplier->country_code ?? 'N/A' }}</td>
                                            <td>{{ $supplier->supplier_phone ?? 'N/A' }}</td>
                                            <td>{{ $supplier->supplier_mobile ?? 'N/A' }}</td>
                                            <td>{{ $supplier->supplier_email_i ?? 'N/A' }}</td>
                                            <td>{{ $supplier->supplier_email_ii ?? 'N/A' }}</td>


                                            <td>{{ $supplier->supplier_website ?? 'N/A' }}</td>
                                            <td>{{ $supplier->contact_person ?? 'N/A' }}</td>
                                            <td></td>
                                            <td>
                                                <a href="tel:{{ $supplier->supplier_mobile }}" class="btn btn-success">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                            </td>                                            
                                            <td>
                                                <a href="https://wa.me/{{ $supplier->supplier_mobile }}" target="_blank" class="btn btn-info">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </td>                                            
                                            <td>
                                                @if (is_null($supplier->report_contact))
                                                    <!-- Show the dropdown if report_contact is null  -->
                                                    <select class="form-control report-dropdown" data-id="{{ $supplier->id }}" data-name="supplier">
                                                        <option value="report">Select</option>
                                                        <option value="wrong_email">Wrong Email</option>
                                                        <option value="mobile_number">Mobile Number</option>
                                                        <option value="wrong_address">Wrong Address</option>
                                                    </select>
                                                @else
                                                    <!-- Display the appropriate message based on the value of report_contact -->
                                                    @switch($supplier->report_contact)
                                                        @case('wrong_email')
                                                            <span>Reported as Wrong Email</span>
                                                            @break
                                                        @case('mobile_number')
                                                            <span>Reported as Wrong Mobile Number</span>
                                                            @break
                                                        @case('wrong_address')
                                                            <span>Reported as Wrong Address</span>
                                                            @break
                                                        @default
                                                            <span>{{ $supplier->report_contact }}</span>
                                                    @endswitch
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fa fa-heart unfavorite" aria-hidden="true" style="color: red; font-size:28px;" id="{{ $supplier->favorite_id }}"></i>
                                            </td>
                                            
                                            
                                            
                                          
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="scroll-btn right-btn">➡</button>
                        </div>

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
        // Tab switching logic
        $('#buyersTab').on('click', function() {
            $('.tab-button').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').removeClass('active');
            $('#buyersTabContent').addClass('active');
        });

        $('#suppliersTab').on('click', function() {
            $('.tab-button').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').removeClass('active');
            $('#suppliersTabContent').addClass('active');
        });

        // Initialize DataTables for both buyers and suppliers
        $('#buyersTable').DataTable({
            scrollX: true,
            paging: true,
            searching: true,
            ordering: true,
            autoWidth: false
        });

        $('#suppliersTable').DataTable({
            scrollX: true,
            paging: true,
            searching: true,
            ordering: true,
            autoWidth: false
        });

        // Unfavorite logic
        $('.unfavorite').on('click', function() {
            // alert('ddd');
            var rowId = $(this).attr('id');
            $.ajax({
                url: '/favorites/delete',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    rowId: rowId
                },
                success: function(response) {
                    alert('Unfavorite successful');
                    location.reload();
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });


        // $('#resultsTable-buyer,#resultsTable-supplier').on('change', '.report-dropdown', function() {
        $('.report-dropdown').on('change', function() {
                var rowId = $(this).data('id');
                var selectedValue = $(this).val();
                var dataType = $(this).data('name');
                
                // alert(dataType);

                $.ajax({
                    url: "{{ url('customer/save-report') }}",  // Update with your route
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        rowId: rowId,
                        report_type: selectedValue,
                        dataType : dataType
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Report saved successfully.');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred while processing your request.');
                    }
                });
            });


             var scrollContainer = $('.dataTables_scrollBody'); // Select scrollable div
console.log(scrollContainer);

            $('.left-btn').click(function() {
                scrollContainer.animate({ scrollLeft: '-=200' }, 'slow'); // Scroll left
            });

            $('.right-btn').click(function() {
                scrollContainer.animate({ scrollLeft: '+=200' }, 'slow'); // Scroll right
            });


    });
</script>
@endsection
