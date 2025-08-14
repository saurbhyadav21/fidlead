@extends('layouts.app')

@section('title', 'Search')

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
                        <form action="{{ route('editAssignedPackage', $assignedPackage->id) }}" method="POST">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="customer_email">Customer Email</label>
                                <input type="email" name="customer_email" id="customer_email" class="form-control" value="{{ old('customer_email') }}" required disabled>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="package_id">Package ID</label>
                                <input type="number" name="package_id" id="package_id" class="form-control" value="{{ old('package_id', $assignedPackage->package_id) }}" required disabled>
                            </div> --}}
                            <div class="form-group">
                                <label for="points">Points</label>
                                <input type="number" name="points" id="points" class="form-control" value="{{ old('points', $assignedPackage->assigned_points) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="package_start">Package Start Date</label>
                                <input type="date" name="package_start" id="package_start" class="form-control" value="{{ old('package_start', $assignedPackage->package_start) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="package_expiry">Package Expiry Date</label>
                                <input type="date" name="package_expiry" id="package_expiry" class="form-control" value="{{ old('package_expiry', $assignedPackage->package_expiry) }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Package</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div> 



@endsection
