@extends('layouts.app')

@section('title', 'Package List')

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
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <h1>Reports</h1>
            <table id="reportsTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>User ID</th>
                        <th>Row ID</th>
                        <th>Buyer/Supplier Code</th>
                        <th>Buyer/Supplier Name</th>
                        <th>Reported by user</th>
                        <th>Reported Remarks</th>
                        <th>Status</th>
                        <th>Corrected By</th>
                        <th>Actions</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->type }}</td>
                            <td>{{ $row->user_id }}</td>
                            <td>{{ $row->row_id }}</td>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->buyer_seller_name }}</td>
                            <td>{{ $row->customer_name }}</td>
                            <td>{{ $row->issue }}</td>
                            <td>{{ $row->status }}</td>
                            <td>{{ $row->corrected_by }}</td>
                            <td>
                                @if ($row->type === 'buyer')
                                    <a href="{{ url('/buyerseller/' . $row->row_id . '/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                @elseif ($row->type === 'supplier')
                                    <a href="{{ url('/seller/' . $row->row_id . '/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                @else
                                    <span class="text-muted">No Action Available</span>
                                @endif
                            </td>
                            <td>{{ $row->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div> 

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#reportsTable').DataTable({
            searching: true,  // Enables the search box
            paging: true,     // Enables pagination
            responsive: true, // Makes the table responsive
            order: [[8, 'asc']], // Sort by 'status' column (adjust the index of the column as needed)
        });
    });
</script>


@endsection
