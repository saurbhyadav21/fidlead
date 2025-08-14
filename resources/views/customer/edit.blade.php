<!-- resources/views/customers/edit.blade.php -->
@extends('layouts.app')

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
                        <h1>Edit Customer</h1>
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" value="{{ $customer->email }}" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="contact_number">Contact Number:</label>
                                <input type="text" name="contact_number" value="{{ $customer->contact_number }}" class="form-control" placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label for="company_name">Company Name:</label>
                                <input type="text" name="company_name" value="{{ $customer->company_name }}" class="form-control" placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation:</label>
                                <input type="text" name="designation" value="{{ $customer->designation }}" class="form-control" placeholder="Designation">
                            </div>
                            <div class="form-group">
                                <label for="company_address">Company Address:</label>
                                <input type="text" name="company_address" value="{{ $customer->company_address }}" class="form-control" placeholder="Company Address">
                            </div>
                            <div class="form-group">
                                <label for="sales_executive">Sales Executive:</label>
                                <input type="text" name="sales_executive" value="{{ $customer->sales_executive }}" class="form-control" placeholder="Sales Executive">
                            </div>
                            {{-- <div class="form-group">
                                <label for="role">Role:</label>
                                <input type="text" name="role" value="{{ $customer->role }}" class="form-control" placeholder="Role">
                            </div> --}}
                    
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
@endsection
