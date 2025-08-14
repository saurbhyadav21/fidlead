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
                        <li class="breadcrumb-item active">Seller Data</li>
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
                        <table id="sellerTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Edit</th>
                                    <th>ID</th>
                                    <th>Data Type</th>
                                    <th>Supplier Country</th>
                                    <th>Loading Port</th>
                                    <th>Mode</th>
                                    <th>Unloading Port</th>
                                    <th>Unloading Country</th>
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
                                    <th>Supplier Pin Code</th>
                                    <th>Supplier State</th>
                                    <th>Country Code</th>
                                    <th>Supplier Phone</th>
                                    <th>Supplier Mobile</th>
                                    <th>Supplier Email I</th>
                                    <th>Supplier Email II</th>
                                    <th>Website</th>
                                    <th>Contact Person</th>
                                    {{-- <th>Show Contact Details</th>
                                    <th>Call Button</th>
                                    <th>WhatsApp Button</th>
                                    <th>Report Contact</th>
                                    <th>Save to Favorite</th>
                                    <th>Edit Contact</th> --}}
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
        $('#sellerTable').DataTable({
            "processing": true, // Show processing state
            "serverSide": true, // Enable server-side processing
            "ajax": "{{ route('seller.data') }}", // URL for fetching data
            "columns": [
                {
                    "data": "id",
                    "render": function(data, type, row) {
                        return `<a href="/seller/${data}/edit" class="btn btn-primary">Edit</a>`;
                    },
                    "orderable": false,
                    "searchable": false
                },
                { "data": "id" },
                { "data": "data_type" },
                { "data": "supplier_country" },
                { "data": "loading_port" },
                { "data": "mode" },
                { "data": "unloading_port" },
                { "data": "unloading_country" },
                { "data": "hs_02" },
                { "data": "business_category" },
                { "data": "hs_04" },
                { "data": "sub_category_i" },
                { "data": "hs_code_08" },
                { "data": "sub_category_ii" },
                { "data": "product_description" },
                { "data": "supplier_code" },
                { "data": "supplier_name" },
                { "data": "supplier_address" },
                { "data": "supplier_city" },
                { "data": "supplier_pin_code" },
                { "data": "supplier_state" },
                { "data": "country_code" },
                { "data": "supplier_phone" },
                { "data": "supplier_mobile" },
                { "data": "supplier_email_i" },
                { "data": "supplier_email_ii" },
                { "data": "supplier_website" },
                { "data": "contact_person" },
                // { "data": "show_contact_details" },
                // { "data": "call_button" },
                // { "data": "whatsapp_button" },
                // { "data": "report_contact" },
                // { "data": "save_to_favorite" },
                // { "data": "edit_contact" }
            ]
        });
    });
</script>

@endsection
