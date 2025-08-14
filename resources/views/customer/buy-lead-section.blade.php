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
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                {{-- <div class="col-sm-6">
                    <h1 class="m-0">Leads</h1>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Lead</li>
                    </ol>
                </div>
            </div>

           


        </div>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="leadsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="buyer-tab" data-bs-toggle="tab" href="#buyer" role="tab" aria-controls="buyer" aria-selected="true">Buyer Purchased Leads</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="supplier-tab" data-bs-toggle="tab" href="#supplier" role="tab" aria-controls="supplier" aria-selected="false">Seller Purchased Leads</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12">
                    <div class="tab-content" id="leadsTabContent">

                        <!-- Buyer Tab -->
                        <div class="tab-pane fade show active" id="buyer" role="tabpanel" aria-labelledby="buyer-tab">
                            <div class="containerx">
                                <div class="table-responsive mt-3">
                                     <button class="scroll-btn left-btn">⬅</button>
                                    <table id="leadsTable" class="table table-bordered table-striped" style="font-size: 12px;">
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
                                                <th>Save to Favorite Button</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data will be loaded here by DataTables -->
                                        </tbody>
                                    </table>
                                    <button class="scroll-btn right-btn">➡</button>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier Tab -->
                        <div class="tab-pane fade" id="supplier" role="tabpanel" aria-labelledby="supplier-tab">
                            <div class="containerx">
                                <div class="table-responsive mt-3">
                                    <table id="leadsTable1" class="table table-bordered table-striped" style="font-size: 12px;">
                                        <thead>
                                            <tr>
                                                <th>Supplier Country</th>
                                                <th>Supplier Name</th>
                                                <th>Supplier Address</th>
                                                <th>Supplier City</th>
                                                <th>Supplier Pincode</th>
                                                <th>Supplier State</th>
    
                                                <th>Hs 02</th>
                                                <th>Hs 04</th>
                                                <th>Hs 08</th>
                                                <th>Loading Port</th>
                                                <th>Unloading Port</th>
                                                <th>Unloading Country</th>
                                                <th>Mode</th>
                                
                                                <th>Country Code</th>
                                                <th>Supplier Phone 1</th>
                                                <th>Supplier Phone 2</th>
                                                <th>Supplier Email 1</th>
                                                <th>Supplier Email 2</th>
                                                <th>Supplier Website</th>
                                                <th>Contact Person</th>
                                
                                                <th>Show Contact Button</th>
                                                <th>Supplier Call Button</th>
                                                <th>Supplier WhatsApp Button</th>
                                                <th>Report Contact Button</th>
                                                <th>Save to Favorite Button</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data will be loaded here by DataTables -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<!-- Include DataTables scripts -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<!-- Include Bootstrap JS (for tab functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // $('#leadsTable').DataTable({
        // scrollX: true,
        // paging: true,
        // searching: true,
        // ordering: true,
        // autoWidth: false
    // });

    // $('#leadsTable1').DataTable({
        // scrollX: true,
        // paging: true,
        // searching: true,
        // ordering: true,
        // autoWidth: false
    // });
    // Initialize the DataTables for both Buyer and Supplier sections
    $('#leadsTable').DataTable({
    processing: true,
    scrollX: true,
    paging: true,
    searching: true,
    serverSide: true,
    ajax: {
        url: '{{ url('customer/buy-lead-section') }}',
        method: 'GET',
        dataSrc: function(json) {
            // Ensure data is properly structured and there are no undefined columns
            return json.data.map(function(item) {
                // Check if necessary fields are available
                if (!item.id) item.id = '';  // Set a default value if missing
                if (!item.buyer_name) item.buyer_name = 'N/A';  // Default fallback value
                // Ensure other fields follow the same pattern
                return item;
            });
        }
    },
    columns: [
        { data: 'buyer_country', name: 'buyer_country' },
        {
            data: 'buyer_name',
            name: 'buyer_name',
            render: function(data, type, row) {
                var url = '{{ route("companies.showBuyer", ":buyer_name") }}';
                url = url.replace(':buyer_name', data);
                return '<a href="' + url + '" target="_blank"><i class="fas fa-industry"></i> ' + data + '</a>';
            }
        },
       {
                        data: 'buyer_address',
                        name: 'buyer_address',
                        render: function(data, type) {
                            if (!data) return '';

                            // Escape HTML to prevent injection
                            let safeText = $('<div>').text(data).html();

                            // Truncate for display
                            let shortText = safeText.length > 30 ? safeText.substring(0, 30) + '…' : safeText;

                            // Return span with your CSS class and data attribute
                            return `<span class="truncated-text" data-full-description="${safeText}">${shortText}</span>`;
                        }
                    },
        { data: 'buyer_city', name: 'buyer_city' },
        { data: 'pin_code', name: 'pin_code' },
        { data: 'buyer_state', name: 'buyer_state' },
        { data: 'hs_02', name: 'hs_02' },
        { data: 'hs_04', name: 'hs_04' },
        { data: 'hs_code_08', name: 'hs_code_08' },
        { data: 'unloading_port', name: 'unloading_port' },
        { data: 'loading_country', name: 'loading_country' },
        { data: 'loading_port', name: 'loading_port' },
        { data: 'mode', name: 'mode' },
        {
            data: 'country_code',
            name: 'country_code',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'buyer_phone',
            name: 'buyer_phone',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'buyer_mobile_ii',
            name: 'buyer_mobile_ii',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'buyer_email_i',
            name: 'buyer_email_i',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'buyer_email_ii',
            name: 'buyer_email_ii',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'website',
            name: 'website',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'contact_person',
            name: 'contact_person',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';  // Ensure an ID exists
                return '';  // Placeholder for future buttons
            }
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';
                var phoneNumber = data.buyer_phone;
                var buttonHtml = '<a href="tel:' + phoneNumber + '">' +
                                 '<button class="btn btn-success call-btn" data-id="' + id + '" data-phone="' + phoneNumber + '">' +
                                 '<i class="fas fa-phone"></i></button>' +
                                 '</a>';
                return buttonHtml;
            },
            name: 'call_button'
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';
                var phoneNumber = data.buyer_phone;
                var buttonHtml = '<a href="https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent("Hello, I would like to contact you.") + '" target="_blank">' +
                                 '<button class="btn btn-info whatsapp-btn" data-id="' + id + '" data-phone="' + phoneNumber + '">' +
                                 '<i class="fab fa-whatsapp"></i></button>' +
                                 '</a>';
                return buttonHtml;
            },
            name: 'whatsapp_button'
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';
                if (data.report_contact === null) {
                    return `<select class="form-control report-dropdown" data-id="${id}" data-name="buyer">
                                <option value="report">Select</option>
                                <option value="wrong_email">Wrong Email</option>
                                <option value="mobile_number">Mobile Number</option>
                                <option value="wrong_address">Wrong Address</option>
                            </select>`;
                } else {
                    switch (data.report_contact) {
                        case 'wrong_email':
                            return 'Reported as Wrong Email';
                        case 'mobile_number':
                            return 'Reported as Wrong Mobile Number';
                        case 'wrong_address':
                            return 'Reported as Wrong Address';
                        default:
                            return data.report_contact;
                    }
                }
            },
            name: 'report_dropdown'
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';
                var buttonHtml = '<button class="btn btn-danger favorite-btn" data-id="' + id + '" data-name="' + {{ session('customer_data')->id }} + '-buyer">' +
                                 '<i class="fas fa-heart"></i></button>';
                return buttonHtml;
            },
            name: 'favorite_button'
        }
    ],
    order: [[1, 'asc']],
});


$('#leadsTable1').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
    paging: true,
    searching: true,
    ajax: {
        url: '{{ url('customer/supplier-lead-section') }}',
        method: 'GET',
        dataSrc: function(json) {
            // Ensure data is properly structured and there are no undefined columns
            return json.data.map(function(item) {
                // Check if necessary fields are available, and assign default values if not
                if (!item.id) item.id = '';  // Set a default value if missing
                if (!item.supplier_name) item.supplier_name = 'N/A';  // Default fallback value
                if (!item.supplier_mobile) item.supplier_mobile = '';  // Fallback empty value
                if (!item.supplier_email_i) item.supplier_email_i = '';  // Fallback empty value
                if (!item.supplier_email_ii) item.supplier_email_ii = '';  // Fallback empty value
                // Ensure other fields follow the same pattern
                return item;
            });
        }
    },
    columns: [
        { data: 'supplier_country', name: 'supplier_country' },
        {
            data: 'supplier_name',
            name: 'supplier_name',
            render: function(data, type, row) {
                var url = '{{ route("companies.showSupplier", ":supplier_name") }}';
                url = url.replace(':supplier_name', data);
                return '<a href="' + url + '" target="_blank"><i class="fas fa-industry"></i> ' + data + '</a>';
            }
        },
        // { data: 'supplier_address', name: 'supplier_address' },
        {
                        data: 'supplier_address',
                        name: 'supplier_address',
                        render: function(data, type) {
                            if (!data) return '';

                            // Escape HTML to prevent injection
                            let safeText = $('<div>').text(data).html();

                            // Truncate for display
                            let shortText = safeText.length > 30 ? safeText.substring(0, 30) + '…' : safeText;

                            // Return span with your CSS class and data attribute
                            return `<span class="truncated-text" data-full-description="${safeText}">${shortText}</span>`;
                        }
                    },
        { data: 'supplier_city', name: 'supplier_city' },
        { data: 'supplier_pin_code', name: 'supplier_pin_code' },
        { data: 'supplier_state', name: 'supplier_state' },
        { data: 'hs_02', name: 'hs_02', "visible": false },
        { data: 'hs_04', name: 'hs_04' },
        { data: 'hs_code_08', name: 'hs_code_08' },
        { data: 'loading_port', name: 'loading_port' },
        { data: 'unloading_port', name: 'unloading_port' },
        { data: 'unloading_country', name: 'unloading_country' },
        { data: 'mode', name: 'mode' },
        {
            data: 'country_code',
            name: 'country_code',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'supplier_phone',
            name: 'supplier_phone',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'supplier_mobile',
            name: 'supplier_mobile',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'supplier_email_i',
            name: 'supplier_email_i',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'supplier_email_ii',
            name: 'supplier_email_ii',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'supplier_website',
            name: 'supplier_website',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'contact_person',
            name: 'contact_person',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';  // Ensure an ID exists
                return '';  // Placeholder for future buttons
            }
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';
                var phoneNumber = data.supplier_mobile;

                // Create the phone call button
                var buttonHtml = '<a href="tel:' + phoneNumber + '">' +
                                 '<button class="btn btn-success call-btn" data-id="' + id + '" data-phone="' + phoneNumber + '">' +
                                 '<i class="fas fa-phone"></i></button>' +
                                 '</a>';
                return buttonHtml;
            },
            name: 'call_button'
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';
                var phoneNumber = data.supplier_mobile;

                // WhatsApp button
                var whatsAppUrl = 'https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent("Hello, I am interested in your service.");
                var buttonHtml = '<a href="' + whatsAppUrl + '" target="_blank">' +
                                 '<button class="btn btn-info whatsapp-btn" data-id="' + id + '" data-phone="' + phoneNumber + '">' +
                                 '<i class="fab fa-whatsapp"></i></button>' +
                                 '</a>';

                return buttonHtml;
            },
            name: 'whatsapp_button'
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';
                if (data.report_contact === null || data.report_contact === '') {
                    return `<select class="form-control report-dropdown" data-id="${id}" data-name="supplier">
                                <option value="report">Select</option>
                                <option value="wrong_email">Wrong Email</option>
                                <option value="mobile_number">Mobile Number</option>
                                <option value="wrong_address">Wrong Address</option>
                            </select>`;
                } else {
                    switch (data.report_contact) {
                        case 'wrong_email':
                            return 'Reported as Wrong Email';
                        case 'mobile_number':
                            return 'Reported as Wrong Mobile Number';
                        case 'wrong_address':
                            return 'Reported as Wrong Address';
                        default:
                            return data.report_contact;
                    }
                }
            },
            name: 'report_dropdown'
        },
        {
            data: function(data, type, row) {
                var id = data.id || '';
                var buttonHtml = '<button class="btn btn-danger favorite-btn" data-id="' + id + '" data-name="' + {{ session('customer_data')->id }} + '-supplier">' +
                                 '<i class="fas fa-heart"></i></button>';
                return buttonHtml;
            },
            name: 'favorite_button'
        }
    ],
    order: [[1, 'asc']],
});


    $('#leadsTable, #leadsTable1').on('change', '.report-dropdown', function() {
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

    $('#leadsTable, #leadsTable1').on('click', '.favorite-btn', function() {
        var rowId = $(this).data('id');
        var customer_data = $(this).data('name'); // E.g., '8-buyer'
        
        // Split customer_data into customer_id and type
        var customerDataArray = customer_data.split('-');
        var customer_id = customerDataArray[0];  // Get the customer ID (e.g., '8')
        var type = customerDataArray[1];         // Get the type (e.g., 'buyer')

        // AJAX call to store the data
        $.ajax({
            url: '/favorites/store',  // Your Laravel route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  // CSRF token for security
                rowId: rowId,
                customer_id: customer_id,
                type: type
            },
            success: function(response) {
                alert('Favorite stored successfully');
            },
            error: function(error) {
                console.log('Error:', error);
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
