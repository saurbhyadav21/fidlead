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
                        <h1>Package Details</h1>
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <td>{{ $package->id }}</td>
                            </tr>
                            <tr>
                                <th>Package Name</th>
                                <td>{{ $package->package_name }}</td>
                            </tr>
                            <tr>
                                <th>Package Type</th>
                                <td>{{ $package->package_type }}</td>
                            </tr>
                            <tr>
                                <th>Package Points</th>
                                <td>{{ $package->package_point }}</td>
                            </tr>
                            <tr>
                                <th>Package Cost</th>
                                <td>{{ $package->package_cost }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('packages.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div> 



@endsection
