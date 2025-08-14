@extends('layouts.app')

@section('title', 'Search')

@section('content')
<style>
    /* Search input background when searching */
    .searching {
        /* background-color: ; 
        color: white; */
    }

    /* Styling the autocomplete suggestion box */
    .ui-autocomplete {
        background-color: white; /* Background color for the suggestion box */
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto; /* To make sure it scrolls if there are too many suggestions */
        overflow-x: hidden;
        padding-right: 10px;
    }

    /* Individual suggestion item */
    .ui-menu-item {
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid #ddd;
    }

    /* Hover effect on suggestion items */
    .ui-menu-item:hover {
        background-color: #f0f0f0;
    }

</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
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
                <section class="col-lg-7">
                    <div class="container">
                        <h1>Assign Package to Customer</h1>
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <form action="{{ route('assign.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="customer_email">Customer Email</label>
                                <input type="email" name="customer_email" id="customer_email" class="form-control searching" value="{{ old('customer_email') }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="package">Select Package</label>
                                <select name="package_id" id="package" class="form-control" required>
                                    <option value="">Select a package</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}" data-points="{{ $package->package_point }}">
                                            {{ $package->package_name }} ({{ $package->package_type }}, {{ $package->package_cost }} USD)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="points">Package Points</label>
                                <input type="number" name="points" id="points" class="form-control" required>
                            </div>

                            <!-- Activation and Expiry Date Fields -->
                            <div class="form-group">
                                <label for="activation_date">Package Activation Date</label>
                                <input type="text" name="package_start" id="activation_date" class="form-control" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="expiry_date">Package Expiry Date</label>
                                <input type="text" name="package_expiry" id="expiry_date" class="form-control" required>
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Assign Package</button>
                        </form>
                    </div>
                    
                    
                </section>
            </div>
        </div>
    </section>
</div> 

<script>
    $(document).ready(function() {
        $('#customer_email').autocomplete({
            source: function(request, response) {
                // Add class to show the green background
                $('#customer_email').addClass('searching');
                
                $.ajax({
                    url: "{{ route('emailSearch') }}",
                    data: {
                        query: request.term
                    },
                    success: function(data) {
                        response(data);
                        // Remove background after receiving response
                        $('#customer_email').removeClass('searching');
                    },
                    error: function() {
                        // In case of an error, also remove background
                        $('#customer_email').removeClass('searching');
                    }
                });
            },
            minLength: 2,
            close: function() {
                $('#customer_email').removeClass('searching');
            }
        });

        // Set up jQuery UI Datepicker for expiry date with dd/mm/yyyy format
        $('#expiry_date').datepicker({
            dateFormat: 'dd/mm/yy',  // Set format to dd/mm/yyyy
            changeMonth: true,
            changeYear: true,
            minDate: 0  // Disable past dates
        });
    });

    document.getElementById('package').addEventListener('change', function() {
        var selectedPackage = this.options[this.selectedIndex];
        var points = selectedPackage.getAttribute('data-points');
        document.getElementById('points').value = points;
    });
</script>

@endsection
