@extends('layouts.customerapp')

@section('title', 'Search')

@section('content')
    <style>
        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .search-field .col-md-2,
        .search-field .col-md-3 {
            padding-right: 15px;
            padding-left: 15px;
        }

        .search-field .col-md-2 .btn,
        .search-field .col-md-2 .form-control {
            width: auto;
            display: inline-block;
            vertical-align: middle;
        }

        .btn-danger,
        .btn-success {
            margin-left: 5px;
        }

        .ml-2 {
            margin-left: 10px;
        }

        #resultsTable {
            display: none;
            /* Hide the table initially */
        }

        .accordion .card-header {
            background-color: #f8f9fa;
        }

        .accordion .btn-link {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }

        .accordion .card-body {
            padding: 10px 15px;
        }

        .form-check {
            margin-bottom: 5px;
        }

        #filterAccordion {
            max-width: 250px;
            float: left;
            margin-right: 20px;
        }
        #loader {
            position: fixed;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.7); /* Optional: Slight white overlay */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>New Search</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('customer/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="accordion" id="filterAccordion">
                        <!-- Filter Section: HS Code -->

                        <!-- Add more filter categories (Buyers Country, Unloading Port, etc.) similarly -->
                    </div>

                    <section class="col-lg-12">
                        <div class="containerx">
                            <form id="searchForm" action="{{ url('customer/search') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="dataType">Data Type</label>
                                    <select class="form-control" id="dataType" name="dataType">
                                        <option value="buyer">Buyer</option>
                                        <option value="supplier">Supplier</option>
                                    </select>
                                </div>

                                <div class="form-group" id="searchFieldsContainer">
                                    
                                    <div class="row mb-2 search-field">
                                        <div class="col-md-3">
                                            <label class="label">Search Field</label>
                                            <select class="form-control searchFieldSelector" name="searchFields[]">
                                                <option value="product_description">Product Description</option>
                                                <option value="hs_code_08">HSN</option>
                                                <option value="buyer_name">Buyer Name</option>
                                                <option value="buyer_country">Country</option>
                                                <option value="buyer_city">City</option>
                                                <option value="buyer_state">State</option>
                                                <option value="unloading_port">Unloading Port</option>
                                                <option value="mode">Shipment Mode</option>
                                                <option value="loading_country">Origin Country</option>
                                                <option value="loading_port">Origin Port</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 operator-container" style="padding-top: 30px;">
                                            <!-- Operator will be dynamically inserted here -->
                                        </div>
                                        <div class="col-md-3">
                                            <label class="label">Value</label>
                                            <input type="text" class="form-control" name="searchValues[]"
                                                placeholder="Enter value">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-success add-field ml-2">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="button" id="searchButton" class="btn btn-primary">Search</button>
                                </div>
                            </form>

                            <div id="loader" style="display:none;">
                                <img src="https://cdn.pixabay.com/animation/2023/11/30/10/11/10-11-02-622_512.gif" alt="Loading..." style="    width: 100px;
    height: 100px;" />
                            </div>

                            <div class="table-responsive mt-3" style="display: none;">
                                <table id="resultsTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Buyer Country</th>
                                            <th>Buyer Name </th>
                                            <th>Buyer Address</th>
                                            <th>Buyer City</th>
                                            <th>Buyer Pincode</th>
                                            <th>Buyer State</th>

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
                                        <!-- Data will be populated here via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to buy this lead?</p>
                    <button type="button" id="confirmYes" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.2/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.2/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable without any data
            var table = $('#resultsTable').DataTable({
                processing: true,
                serverSide: false,  // Switch to true if you want server-side processing
                searching: true,  // Disable initial searching
                paging: true,  // Disable paging until data is loaded
                info: true,  // Disable table info display until data is loaded
                searchPanes: {
                    viewTotal: true,
                    columns: [1, 3],  // Columns to display in the panes
                    cascadePanes: true,  // Enables cascading panes
                    layout: 'columns-1',  // Layout for one column of panes
                    initComplete: function() {
                        // Hide panes until data is loaded
                        $('.dtsp-panesContainer').hide();
                    }
                },//<i class="fas fa-industry" aria-hidden="true"></i>
                dom: '<"row"<"col-sm-2"Pl><"col-sm-10"frtip>>',  // Custom layout to place SearchPanes on the left
                columns: [{
                        data: 'buyer_country',
                        name: 'buyer_country'
                    },
                    {
                        data: 'buyer_name',
                        name: 'buyer_name',
                        render: function(data, type, row) {
                            var url = '{{ route("companies.show", ":buyer_name") }}';
                            url = url.replace(':buyer_name', data);
                            return '<a href="' + url + '" target="_blank"><i class="fas fa-industry"></i> ' + data + '</a>';
                        }
                    },
                    {
                        data: 'buyer_address',
                        name: 'buyer_address'
                    },
                    {
                        data: 'buyer_city',
                        name: 'buyer_city'
                    },
                    {
                        data: 'pin_code',
                        name: 'pin_code'
                    },
                    {
                        data: 'buyer_state',
                        name: 'buyer_state'
                    },
                    {
                        data: 'country_code', 
                        name: 'country_code',
                        render: function(data, type, row) {
                            return row.is_purchased ? data : '*****';
                        }
                    },
                    {
                        data: 'buyer_phone', 
                        name: 'buyer_phone',
                        render: function(data, type, row) {
                            return row.is_purchased ? data : '*****';
                        }
                    },
                    {
                        data: 'buyer_mobile_ii', 
                        name: 'buyer_mobile_ii',
                        render: function(data, type, row) {
                            return row.is_purchased ? data : '*****';
                        }
                    },
                    {
                        data: 'buyer_email_i', 
                        name: 'buyer_email_i',
                        render: function(data, type, row) {
                            return row.is_purchased ? data : '*****';
                        }
                    },
                    {
                        data: 'buyer_email_ii', 
                        name: 'buyer_email_ii',
                        render: function(data, type, row) {
                            return row.is_purchased ? data : '*****';
                        }
                    },
                    {
                        data: 'website', 
                        name: 'website',
                        render: function(data, type, row) {
                            return row.is_purchased ? data : '*****';
                        }
                    },
                    { 
                        data: 'contact_person', 
                        name: 'contact_person',
                        render: function(data, type, row) {
                            console.log(row);
                            return row.is_purchased ? data : '*****';
                        }
                    },
                    {
                        data: function(data, type, row) {
                            var id = data.id || data.someOtherUniqueField;
                            // console.log(data.is_purchased);
                            return data.is_purchased ? '' : '<button class="btn btn-primary contact-btn" data-id="' + id + '" data-name="'+data.buyer_name+'">Show Contact</button>';
                        }
                    },
                    {
                        data: function(data, type, row) {
                            var id = data.id || data.someOtherUniqueField;
                            var buttonHtml = '<button class="btn btn-success call-btn" data-id="' + id + '" data-phone="' + data.buyer_phone + '">' +
                                            '<i class="fas fa-phone"></i></button>';
                                            
                            if (!data.is_purchased) {
                                buttonHtml = ''; // Hide the button if not purchased
                            }
                            return buttonHtml;
                        },
                        name: 'call_button'
                    },
                    {
                        data: function(data, type, row) {
                            var id = data.id || data.someOtherUniqueField;
                            var phoneNumber = data.buyer_phone;
                            var buttonHtml = '<button class="btn btn-info whatsapp-btn" data-id="' + id + '" data-phone="' + phoneNumber + '">' +
                                            '<i class="fab fa-whatsapp"></i></button>';

                            if (!data.is_purchased) {
                                buttonHtml = ''; // Hide the button if not purchased
                            }
                            return buttonHtml;
                        },
                        name: 'whatsapp_button'
                    },
                    {
                        data: function(data, type, row) {
                            var id = data.id || data.someOtherUniqueField;

                            // Check if report_contact is null
                            if (data.is_purchased) {
                                if (data.report_contact === null) {
                                    // Show the dropdown if report_contact is null
                                    return `
                                        <select class="form-control report-dropdown" data-id="` + id + `">
                                            <option value="report">Select</option>
                                            <option value="wrong_email">Wrong Email</option>
                                            <option value="mobile_number">Mobile Number</option>
                                            <option value="wrong_address">Wrong Address</option>
                                        </select>`;
                                } else {
                                    // Return a descriptive message based on the value of report_contact
                                    switch(data.report_contact) {
                                        case 'wrong_email':
                                            return 'Reported as Wrong Email';
                                        case 'mobile_number':
                                            return 'Reported as Wrong Mobile Number';
                                        case 'wrong_address':
                                            return 'Reported as Wrong Address';
                                        default:
                                            return data.report_contact; // Fallback to displaying the raw value
                                    }
                                }
                            }else{
                                
                            }
                        },
                        name: 'report_dropdown'
                    },
                    {
                        data: function(data, type, row) {
                            var id = data.id || data.someOtherUniqueField;
                            var buttonHtml = '<button class="btn btn-danger favorite-btn" data-id="' + id + '">' +
                                            '<i class="fas fa-heart"></i></button>';

                            if (!data.is_purchased) {
                                buttonHtml = ''; // Hide the button if not purchased
                            }
                            return buttonHtml;
                        },
                        name: 'favorite_button'
                    },
                ],
                order: [[1, 'asc']],  // Default ordering
                drawCallback: function(settings) {
                    var api = this.api();
                    api.rows().nodes().each(function(row, i) {
                        var data = api.row(row).data();
                        if (data.is_purchased) {
                            console.log(data);
                            
                            $(row).addClass('table-success'); // Highlight in green
                        }
                    });
                }
            });
    
            // Handle search button click to load data
            $('#searchButton').on('click', function() {
                $('#loader').show();
                var startTime = performance.now();  // Capture the start time
                table.clear();  // Clear any existing data
                $.ajax({
                    url: "{{ url('customer/search') }}",  // Adjust the URL as needed
                    method: 'POST',
                    data: $('#searchForm').serialize(),
                    success: function(response) {
                        $('.table-responsive').show();
                        if (response.data && response.data.length > 0) {
                            table.rows.add(response.data).draw();  // Add and draw the data
                            $('#resultsTable').show();  // Show the table once data is loaded
                            $('.dtsp-panesContainer').show();  // Show the panes container
                            table.searchPanes.rebuildPane();  // Rebuild SearchPanes with new data

                        } else {
                            alert('No data found');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred while fetching data.');
                    },
                    complete: function() {
                        $('#loader').hide();  // Hide the loader after data is loaded

                        var endTime = performance.now();  // Capture the end time
                        var timeTaken = (endTime - startTime) / 1000;  // Calculate the time taken in seconds
                        alert('Search completed in ' + timeTaken.toFixed(2) + ' seconds.');
                    }
                });
            });
    
            // Optional: Rebuild panes on filter changes
            $('.filter-checkbox').on('change', function() {
                table.searchPanes.rebuildPane();
            });
    
            // Handle action buttons in the table (e.g., Show Contact, Call, etc.)
            // Initialize lastSearchParams
            var lastSearchParams = {
                    _token: $('input[name="_token"]').val(), // CSRF token
                    dataType: '', // Placeholder for dataType
                    searchFields: [], // Placeholder for search fields
                    operator: '', // Placeholder for operator
                    searchValues: [] // Placeholder for search values
                };

            // Capture form data when the form is submitted
            $('#searchForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Serialize the form data
                var formData = $(this).serialize(); // This creates a URL-encoded string of the form data

                // Trigger DataTable reload using the serialized form data
                table.ajax.reload();
            });


            // Use serialized form data in the AJAX request
            $('#resultsTable').on('click', '.contact-btn', function() {
                var rowId = $(this).data('id');
                var buyer_name = $(this).data('name');
                
                $('#confirmModal').modal('show');

                $('#confirmYes').off('click').on('click', function() {
                    $.ajax({
                        url: "{{ url('customer/buy-lead') }}",
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            rowId: rowId,
                            buyer_name: buyer_name
                        },
                        success: function(response) {
                            $('#confirmModal').modal('hide');

                            if (response.success) {
                                // Serialize form data again just before sending the refresh request
                                var formData = $('#searchForm').serialize();

                                // Refresh the DataTable using POST request with the serialized form data
                                $.ajax({
                                    url: "{{ url('customer/search') }}",
                                    method: 'POST',
                                    data: formData,  // Use the serialized form data
                                    success: function(data) {
                                        // Clear and populate DataTable with new data
                                        table.clear().rows.add(data.data).draw();
                                    },
                                    error: function(xhr) {
                                        alert('An error occurred while refreshing the data.');
                                    }
                                });
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('An error occurred while processing your request.');
                        }
                    });
                });
            });


            $('#resultsTable').on('change', '.report-dropdown', function() {
                var rowId = $(this).data('id');
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ url('customer/save-report') }}",  // Update with your route
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        rowId: rowId,
                        report_type: selectedValue
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

            function addOperatorDropdown(selector) {
                let operatorDropdown = '';
                switch (selector.val()) {
                    case 'product_description':
                        operatorDropdown = '<label class="label">Operator : </label><select class="form-control" name="operator"><option value="contains">Contains</option><option value="equal">Exact phrase</option></select>';
                        break;
                    case 'hsn':
                        operatorDropdown = '<input type="text" class="form-control" name="hsnValue" placeholder="Enter HSN value"><button type="button" class="btn btn-primary mt-2">HSN Locator</button>';
                        break;
                    default:
                        operatorDropdown = '<label class="label">Operator</label><select class="form-control" name="operator"><option value="in">In</option></select>';
                }
                return operatorDropdown;
            }

            // Add new search field
            $('.add-field').click(function() {
                var newField = $('.search-field').first().clone();
                newField.find('input').val('');
                newField.find('.add-field').removeClass('btn-success add-field').addClass('btn-danger remove-field').text('-');
                newField.prepend('<div class="col-md-2" style=""><label class="label">Search Operator :</label><select class="form-control" name="searchOperator[]"><option value="And">And</option><option value="Or">Or</option><option value="Not">And Not</option></select></div>');
                newField.find('.operator-container').html(addOperatorDropdown(newField.find('.searchFieldSelector')));
                $('#searchFieldsContainer').append(newField);
            });
                    
            // Remove search field
            $(document).on('click', '.remove-field', function() {
                $(this).closest('.search-field').remove();
            });

            // Change operator dropdown based on selected field
            $(document).on('change', '.searchFieldSelector', function() {
                let operatorContainer = $(this).closest('.search-field').find('.operator-container');
                operatorContainer.html(addOperatorDropdown($(this)));
            });

            // Initial operator dropdown
            $('.operator-container').each(function() {
                let operatorContainer = $(this);
                operatorContainer.html(addOperatorDropdown(operatorContainer.closest('.search-field').find('.searchFieldSelector')));
            });
        });
    </script>
    
    
    
@endsection
