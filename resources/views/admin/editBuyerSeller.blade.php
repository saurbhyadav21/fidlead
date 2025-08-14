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
                        <h1>Edit Buyer Seller Data</h1>
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <form action="{{ route('buyerseller.update', $buyerSellerData->buyer_code) }}" method="POST">
                            @csrf
                    
                            <div class="form-group">
                                <label for="data_type">Data Type</label>
                                <input type="text" class="form-control" id="data_type" name="data_type" value="{{ $buyerSellerData->data_type }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_country">Buyer Country</label>
                                <input type="text" class="form-control" id="buyer_country" name="buyer_country" value="{{ $buyerSellerData->buyer_country }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="unloading_port">Unloading Port</label>
                                <input type="text" class="form-control" id="unloading_port" name="unloading_port" value="{{ $buyerSellerData->unloading_port }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="mode">Mode</label>
                                <input type="text" class="form-control" id="mode" name="mode" value="{{ $buyerSellerData->mode }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="loading_country">Loading Country</label>
                                <input type="text" class="form-control" id="loading_country" name="loading_country" value="{{ $buyerSellerData->loading_country }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="loading_port">Loading Port</label>
                                <input type="text" class="form-control" id="loading_port" name="loading_port" value="{{ $buyerSellerData->loading_port }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="hs_02">HS Code (02)</label>
                                <input type="text" class="form-control" id="hs_02" name="hs_02" value="{{ $buyerSellerData->hs_02 }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="business_category">Business Category</label>
                                <input type="text" class="form-control" id="business_category" name="business_category" value="{{ $buyerSellerData->business_category }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="hs_04">HS Code (04)</label>
                                <input type="text" class="form-control" id="hs_04" name="hs_04" value="{{ $buyerSellerData->hs_04 }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="sub_category_i">Sub Category I</label>
                                <input type="text" class="form-control" id="sub_category_i" name="sub_category_i" value="{{ $buyerSellerData->sub_category_i }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="hs_code_08">HS Code (08)</label>
                                <input type="text" class="form-control" id="hs_code_08" name="hs_code_08" value="{{ $buyerSellerData->hs_code_08 }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="sub_category_ii">Sub Category II</label>
                                <input type="text" class="form-control" id="sub_category_ii" name="sub_category_ii" value="{{ $buyerSellerData->sub_category_ii }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <textarea class="form-control" id="product_description" name="product_description" disabled>{{ $buyerSellerData->product_description }}</textarea>
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_code">Buyer Code</label>
                                <input type="text" class="form-control" id="buyer_code" name="buyer_code" value="{{ $buyerSellerData->buyer_code }}" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_name">Buyer Name</label>
                                <input type="text" class="form-control" id="buyer_name" name="buyer_name" value="{{ $buyerSellerData->buyer_name }}"  >
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_address">Buyer Address</label>
                                <input type="text" class="form-control" id="buyer_address" name="buyer_address" value="{{ $buyerSellerData->buyer_address }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_city">Buyer City</label>
                                <input type="text" class="form-control" id="buyer_city" name="buyer_city" value="{{ $buyerSellerData->buyer_city }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="pin_code">PIN Code</label>
                                <input type="text" class="form-control" id="pin_code" name="pin_code" value="{{ $buyerSellerData->pin_code }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_state">Buyer State</label>
                                <input type="text" class="form-control" id="buyer_state" name="buyer_state" value="{{ $buyerSellerData->buyer_state }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="country_code">Country Code</label>
                                <input type="text" class="form-control" id="country_code" name="country_code" value="{{ $buyerSellerData->country_code }}" >
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_phone">Buyer Phone</label>
                                <input type="text" class="form-control" id="buyer_phone" name="buyer_phone" value="{{ $buyerSellerData->buyer_phone }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_mobile_ii">Buyer Mobile II</label>
                                <input type="text" class="form-control" id="buyer_mobile_ii" name="buyer_mobile_ii" value="{{ $buyerSellerData->buyer_mobile_ii }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_email_i">Buyer Email I</label>
                                <input type="email" class="form-control" id="buyer_email_i" name="buyer_email_i" value="{{ $buyerSellerData->buyer_email_i }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="buyer_email_ii">Buyer Email II</label>
                                <input type="email" class="form-control" id="buyer_email_ii" name="buyer_email_ii" value="{{ $buyerSellerData->buyer_email_ii }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" id="website" name="website" value="{{ $buyerSellerData->website }}">
                            </div>
                    
                            <div class="form-group">
                                <label for="contact_person">Contact Person</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $buyerSellerData->contact_person }}">
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
