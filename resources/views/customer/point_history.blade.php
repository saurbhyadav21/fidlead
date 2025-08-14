@extends('layouts.customerapp')

@section('title', 'Search')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                {{-- <div class="col-sm-6"></div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Point History</li>
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

                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pointHistoryTab" data-bs-toggle="tab" href="#pointHistory" role="tab" aria-controls="pointHistory" aria-selected="true">Point History</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="subscriptionsTab" data-bs-toggle="tab" href="#subscriptions" role="tab" aria-controls="subscriptions" aria-selected="false">Subscriptions</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <!-- Point History Tab -->
                            <div class="tab-pane fade show active" id="pointHistory" role="tabpanel" aria-labelledby="pointHistoryTab">
                                <h1 class="mt-4">Point History</h1>

                                <!-- Display totals -->
                                <div class="row mb-4">
                                    <div class="col-md-4"><h4>Total Points Added: {{ $totalPointsAdded }}</h4></div>
                                    <div class="col-md-4"><h4>Total Points Redeemed: {{ $totalPointsRedeemed }}</h4></div>
                                    <div class="col-md-4"><h4>Balance Points: {{ $totalBalancePoints }}</h4></div>
                                </div>

                                <!-- Display point history table -->
                                @if($pointHistories->isEmpty())
                                    <p>No point history found.</p>
                                @else
                                    <table class="table" id="pointHistoryTable">
                                        <thead>
                                            <tr>
                                                <th>Package Name</th>
                                                <th>Points Added</th>
                                                <th>Points Deducted</th>
                                                <th>Points Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pointHistories as $history)
                                                <tr>
                                                    <td>{{ $history->package_name }}</td>
                                                    <td>{{ $history->point_add }}</td>
                                                    <td>{{ $history->point_minus }}</td>
                                                    <td>{{ $history->point_status }}</td>
                                                    <td>{{ $history->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>

                            <!-- Subscriptions Tab -->
                            <div class="tab-pane fade" id="subscriptions" role="tabpanel" aria-labelledby="subscriptionsTab">
                                <div class="container mt-4">
                                    <h1>Active Subscription</h1>
                                    <table class="table table-bordered" id="activeSubscriptionsTable">
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
                                    <table class="table table-bordered" id="expiredSubscriptionsTable">
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
                            </div>
                        </div> <!-- End tab-content -->
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<!-- Include DataTables & Bootstrap -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $('#pointHistoryTable').DataTable();
        $('#activeSubscriptionsTable').DataTable();
        $('#expiredSubscriptionsTable').DataTable();

        // Fix Bootstrap tab click issue
        $('#myTab a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>

@endsection
