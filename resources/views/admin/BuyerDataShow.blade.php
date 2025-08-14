@extends('layouts.app')

@section('title', 'Data Show')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">BuyerSellerData</li>
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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table id="buyerSellerTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Edit</th>
                                    <th>id</th>
                                    <th>Data Type</th>
                                    <th>Buyer Country</th>
                                    <th>Unloading Port</th>
                                    <th>Mode</th>
                                    <th>Loading Country</th>
                                    <th>Loading Port</th>
                                    <th>HS 02</th>
                                    <th>Business Category</th>
                                    <th>HS 04</th>
                                    <th>Sub Category I</th>
                                    <th>HS Code 08</th>
                                    <th>Sub Category II</th>
                                    <th>Product Description</th>
                                    <th>Buyer Code</th>
                                    <th>Buyer Name</th>
                                    <th>Buyer Address</th>
                                    <th>Buyer City</th>
                                    <th>Pin Code</th>
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
        $('#buyerSellerTable').DataTable({
            "processing": true, // Show processing state
            "serverSide": true, // Enable server-side processing
            "ajax": "{{ route('buyerseller.data') }}", // URL for fetching data
            "columns": [
                {
                    "data": "id",
                    "render": function(data, type, row) {
                        return `<a href="/buyerseller/${data}/edit" class="btn btn-primary">Edit</a>`;
                    },
                    "orderable": false,
                    "searchable": false
                },
                { "data": "id" },
                { "data": "data_type" },
                { "data": "buyer_country" },
                { "data": "unloading_port" },
                { "data": "mode" },
                { "data": "loading_country" },
                { "data": "loading_port" },
                { "data": "hs_02" },
                { "data": "business_category" },
                { "data": "hs_04" },
                { "data": "sub_category_i" },
                { "data": "hs_code_08" },
                { "data": "sub_category_ii" },
                { "data": "product_description" },
                { "data": "buyer_code" },
                { "data": "buyer_name" },
                { "data": "buyer_address" },
                { "data": "buyer_city" },
                { "data": "pin_code" },
                { "data": "buyer_state" },
                { "data": "country_code" },
                { "data": "buyer_phone" },
                { "data": "buyer_mobile_ii" },
                { "data": "buyer_email_i" },
                { "data": "buyer_email_ii" },
                { "data": "website" },
                { "data": "contact_person" },
            ]
        });
    });
</script>

@endsection
