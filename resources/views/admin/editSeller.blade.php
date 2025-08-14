@extends('layouts.app')

@section('title', 'Edit Seller Data')

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
                        <h1>Edit Seller Data</h1>
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <form action="{{ route('seller.update', $sellerData->id) }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                    
                            <div class="form-group">
                                <label for="data_type">Data Type</label>
                                <input type="text" class="form-control" id="data_type" name="data_type" value="{{ $sellerData->data_type }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_country">Supplier Country</label>
                                <input type="text" class="form-control" id="supplier_country" name="supplier_country" value="{{ $sellerData->supplier_country }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="unloading_port">Unloading Port</label>
                                <input type="text" class="form-control" id="unloading_port" name="unloading_port" value="{{ $sellerData->unloading_port }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="mode">Mode</label>
                                <input type="text" class="form-control" id="mode" name="mode" value="{{ $sellerData->mode }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="unloading_country">UnLoading Country</label>
                                <input type="text" class="form-control" id="unloading_country" name="unloading_country" value="{{ $sellerData->unloading_country }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="loading_port">Loading Port</label>
                                <input type="text" class="form-control" id="loading_port" name="loading_port" value="{{ $sellerData->loading_port }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="hs_02">HS Code (02)</label>
                                <input type="text" class="form-control" id="hs_02" name="hs_02" value="{{ $sellerData->hs_02 }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="business_category">Business Category</label>
                                <textarea class="form-control" id="business_category" name="business_category" disabled>{{ $sellerData->business_category }}</textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="hs_04">HS Code (04)</label>
                                <input type="text" class="form-control" id="hs_04" name="hs_04" value="{{ $sellerData->hs_04 }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="sub_category_i">Sub Category I</label>
                                <textarea class="form-control" id="sub_category_i" name="sub_category_i" disabled>{{ $sellerData->sub_category_i }}</textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="hs_code_08">HS Code (08)</label>
                                <input type="text" class="form-control" id="hs_code_08" name="hs_code_08" value="{{ $sellerData->hs_code_08 }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="sub_category_ii">Sub Category II</label>
                                <textarea class="form-control" id="sub_category_ii" name="sub_category_ii" disabled>{{ $sellerData->sub_category_ii }}</textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <textarea class="form-control" id="product_description" name="product_description" disabled>{{ $sellerData->product_description }}</textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_code">Supplier Code</label>
                                <input type="text" class="form-control" id="supplier_code" name="supplier_code" value="{{ $sellerData->supplier_code }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_name">Supplier Name</label>
                                <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ $sellerData->supplier_name }}" required >
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_address">Supplier Address</label>
                                <textarea class="form-control" id="supplier_address" name="supplier_address" >{{ $sellerData->supplier_address }}</textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_city">Supplier City</label>
                                <input type="text" class="form-control" id="supplier_city" name="supplier_city" value="{{ $sellerData->supplier_city }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_pin_code">PIN Code</label>
                                <input type="text" class="form-control" id="supplier_pin_code" name="supplier_pin_code" value="{{ $sellerData->supplier_pin_code }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_state">Supplier State</label>
                                <input type="text" class="form-control" id="supplier_state" name="supplier_state" value="{{ $sellerData->supplier_state }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="country_code">Country Code</label>
                                <input type="text" class="form-control" id="country_code" name="country_code" value="{{ $sellerData->country_code }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_phone">Supplier Phone</label>
                                <input type="text" class="form-control" id="supplier_phone" name="supplier_phone" value="{{ $sellerData->supplier_phone }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_mobile">Supplier Mobile</label>
                                <input type="text" class="form-control" id="supplier_mobile" name="supplier_mobile" value="{{ $sellerData->supplier_mobile }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_email_i">Supplier Email I</label>
                                <input type="email" class="form-control" id="supplier_email_i" name="supplier_email_i" value="{{ $sellerData->supplier_email_i }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_email_ii">Supplier Email II</label>
                                <input type="email" class="form-control" id="supplier_email_ii" name="supplier_email_ii" value="{{ $sellerData->supplier_email_ii }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="supplier_website">Supplier Website</label>
                                <input type="text" class="form-control" id="supplier_website" name="supplier_website" value="{{ $sellerData->supplier_website }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="contact_person">Contact Person</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $sellerData->contact_person }}" >
                            </div>
                    
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div> 

@endsection
