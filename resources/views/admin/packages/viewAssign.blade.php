@extends('layouts.app')

@section('title', 'Customer Assign Package')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Customer Assign Package</li>
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
                        <h1>Customer Assign Package</h1>
                        <table id="customer-package-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Package Name</th>
                                    <th>Assigned Points</th>
                                    <th>Package Start</th>
                                    <th>Package Expiry</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignments as $assignment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $assignment->customer_name }}</td>
                                    <td>{{ $assignment->customer_email }}</td>
                                    <td>{{ $assignment->package_name }}</td>
                                    <td>{{ $assignment->assigned_points }}</td>
                                    <td>{{ $assignment->package_start ? $assignment->package_start : 'N/A' }}</td>
                                    <td>{{ $assignment->package_expiry ? $assignment->package_expiry : 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-success edit-btn" href="{{ url('assigned-package/edit/' . $assignment->id) }}">Edit</a>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $assignment->id }}">Delete</button> <!-- Add Delete button -->
                                    </td>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#customer-package-table').DataTable();
        // Delete button functionality
        $('.delete-btn').on('click', function() {
            // alert('url');
            var id = $(this).data('id');
            var url = '{{ route("deleteAssign", ":id") }}'; // Define route for delete
            url = url.replace(':id', id); // Replace :id with actual assignment id
            if (confirm('Are you sure you want to delete this assignment?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Send CSRF token for security
                    },
                    success: function(response) {
                        if (response.success) {
                            // Remove the deleted row from the table
                            $('#row-' + id).remove();
                            alert(response.success);
                            location.reload(); // Reload the page
                        }
                    },
                    error: function(xhr) {
                        alert('Error: Could not delete assignment');
                    }
                });
            }
        });
    });
</script>
@endsection

{{-- @push('scripts') --}}
<!-- DataTables Scripts -->

{{-- @endpush --}}
