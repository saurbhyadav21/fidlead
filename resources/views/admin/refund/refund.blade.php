<!-- resources/views/customers/index.blade.php -->
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
                            <li class="breadcrumb-item active">Privacy Policy</li>
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
                            <h1>Refund</h1>
                            <a href="{{ route('add-pp-page-refund') }}" class="btn btn-primary mb-2">Add Refund policy</a>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success mt-2">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                       
                                        <th>Actions</th>
                                    </tr>
                                    <thead>
                                    <tbody>
                                        @foreach ($refund as $pp)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pp->description }}</td>
                                            <td>{{ $pp->created_at }}</td>

                                            <td>
                                              <a href="{{ route('edit-pp-page-refund', $pp->id) }}" class="btn btn-warning">Edit</a>


                                                <!-- Button to trigger modal -->
                                                {{-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addPointsModal" data-customer-id="{{ $tnc->id }}">Add Points</a> --}}

                                                <form action="{{ route('delete-pp-refund', $pp->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                            </table>
                        </div>
                        <!-- Modal HTML -->
                        <div class="modal fade" id="addPointsModal" tabindex="-1" aria-labelledby="addPointsModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addPointsModalLabel">Add Points</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addPointsForm">
                                            <div class="form-group">
                                                <label for="points">Points to Add:</label>
                                                <input type="number" class="form-control" id="points" name="points"
                                                    required>
                                            </div>
                                            <input type="hidden" id="customer_id" name="customer_id"
                                                {{-- value="{{ $customer->id }}"> --}}
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="savePointsBtn">Save
                                            Points</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>





    <!-- jQuery -->

    <!-- Bootstrap 4 -->
    <script src="{{ config('app.url') }}/Theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ config('app.url') }}/Theme/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/jszip/jszip.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ config('app.url') }}/Theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });


        $(document).ready(function(){
    // When the modal is about to be shown
    $('#addPointsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var customerId = button.data('customer-id'); // Extract the customer id from the data-customer-id attribute
        var modal = $(this);

        // Update the hidden input with the correct customer id
        modal.find('#customer_id').val(customerId);
    });

    $('#savePointsBtn').on('click', function() {
        var points = $('#points').val();
        var customer_id = $('#customer_id').val();

        $.ajax({
            url: '{{ route('customers.addPointss', ':id') }}'.replace(':id', customer_id),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                points: points,
                customer_id: customer_id
            },
            success: function(response) {
                if (response.success) {
                    alert('Points added successfully!');
                    $('#addPointsModal').modal('hide');
                } else {
                    alert('Failed to add points!');
                }
            },
            error: function(xhr) {
                alert('An error occurred while adding points.');
            }
        });
    });
});


    </script>
@endsection
