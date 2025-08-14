@extends('layouts.app')

@section('title', 'create user')

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
                <section class="col-lg-12">
                    <div class="container">
                        <h1>Create Package</h1>
                        <form action="{{ route('packages.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="package_name">Package Name</label>
                                <input type="text" name="package_name" id="package_name" class="form-control" value="{{ old('package_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="package_type">Package Type</label>
                                <input type="text" name="package_type" id="package_type" class="form-control" value="{{ old('package_type') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="package_point">Package Points</label>
                                <input type="number" name="package_point" id="package_point" class="form-control" value="{{ old('package_point') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="package_cost">Package Cost</label>
                                <input type="text" name="package_cost" id="package_cost" class="form-control" value="{{ old('package_cost') }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Package</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div> 



@endsection
