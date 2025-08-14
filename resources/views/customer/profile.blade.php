@extends('layouts.customerapp')

@section('title', 'Profile')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
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
                        <h1>User Profile</h1>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Profile edit form -->
                        @csrf
                        <form>
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $customer->contact_number) }}" required disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $customer->company_name) }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_address">Company Address</label>
                                        <input type="text" name="company_address" class="form-control" value="{{ old('company_address', $customer->company_address) }}" disabled>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}" required disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" class="form-control" value="{{ old('designation', $customer->designation) }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="sales_executive">Sales Executive</label>
                                        <input type="text" name="sales_executive" class="form-control" value="{{ old('sales_executive', $customer->sales_executive) }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="container mt-4">
                        <h1>Active Subscription</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Package Name</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Assigned Points</th>
                                    <th>Total Points Remaining</th>
                                    <th>Package Start Date</th>
                                    <th>Package Expiry Date</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->id }}</td>
                                        <td>{{ $assignment->package_name }}</td>
                                        <td>{{ $assignment->customer_name }}</td>
                                        <td>{{ $assignment->customer_email }}</td>
                                        <td>{{ $assignment->assigned_points }}</td>
                                        <td>{{ $assignment->total_points_remaining }}</td>
                                        <td>{{ $assignment->package_start }}</td>
                                        <td>{{ $assignment->package_expiry }}</td>
                                        <td>Active <button class="btn btn-primary">Upgrade</button></td>
                                        <td>{{ $assignment->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="container mt-4">
                        <h1>Expired Subscription</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Package Name</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Assigned Points</th>
                                    <th>Package Start Date</th>
                                    <th>Package Expiry Date</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expiredAssignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->id }}</td>
                                        <td>{{ $assignment->package_name }}</td>
                                        <td>{{ $assignment->customer_name }}</td>
                                        <td>{{ $assignment->customer_email }}</td>
                                        <td>{{ $assignment->assigned_points }}</td>
                                        <td>{{ $assignment->package_start }}</td>
                                        <td>{{ $assignment->package_expiry }}</td>
                                        <td>Expired <button class="btn btn-primary">Renew</button></td>
                                        <td>{{ $assignment->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection
