@extends('layouts.app')

@section('title', 'package list')

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
                        <li class="breadcrumb-item active">package</li>
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
                        <div class="container">
                            <h1>Packages</h1>
                            <a href="{{ route('packages.create') }}" class="btn btn-primary mb-3">Add Package</a>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Package Name</th>
                                        <th>Package Type</th>
                                        <th>Points</th>
                                        <th>Cost</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $package->id }}</td>
                                            <td>{{ $package->package_name }}</td>
                                            <td>{{ $package->package_type }}</td>
                                            <td>{{ $package->package_point }}</td>
                                            <td>{{ $package->package_cost }}</td>
                                            <td>
                                                <a href="{{ route('packages.show', $package->id) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div> 



@endsection
