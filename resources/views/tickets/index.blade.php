@extends('layouts.customerapp')

@section('title', 'Your Tickets')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            {{-- <div class="row mb-2"> --}}
                {{-- <div class="col-sm-6">
                    <h2>Your Tickets</h2>
                </div> --}}
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Your Tickets</li>
                    </ol>
                </div> --}}
            {{-- </div> --}}
            <div class="row mb-2">
                {{-- <div class="col-sm-6">
                    <h2>Your Tickets</h2>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Your Tickets</li>
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
                        <!-- Create Ticket Button -->
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Create Ticket</a>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="ticketTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="open-tickets-tab" data-toggle="tab" href="#open-tickets" role="tab" aria-controls="open-tickets" aria-selected="true">Open Tickets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="closed-tickets-tab" data-toggle="tab" href="#closed-tickets" role="tab" aria-controls="closed-tickets" aria-selected="false">Closed Tickets</a>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content mt-3" id="ticketTabsContent">
                            <!-- Open Tickets -->
                            <div class="tab-pane fade show active" id="open-tickets" role="tabpanel" aria-labelledby="open-tickets-tab">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ticket ID</th>
                                            <th>Ticket Date</th>
                                            {{-- <th>Company Name</th> --}}
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                            @if($ticket->status == 'open')
                                                <tr>
                                                    <td><a href="{{ route('tickets.show', $ticket->id) }}">Ticket No.{{ $ticket->id }}</a></td>
                                                    <td>{{ $ticket->created_at->format('Y-m-d H:i:s') }}</td>
                                                    {{-- <td>{{ $ticket->company_name }}</td> --}}
                                                    <td>{{ $ticket->title }}</td>
                                                    <td>{{ $ticket->description }}</td>
                                                    <td><span class="badge badge-success">Open</span></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Closed Tickets -->
                            <div class="tab-pane fade" id="closed-tickets" role="tabpanel" aria-labelledby="closed-tickets-tab">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ticket ID</th>
                                            <th>Ticket Date</th>
                                            {{-- <th>Company Name</th> --}}
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                            @if($ticket->status == 'closed')
                                                <tr>
                                                    <td><a href="{{ route('tickets.show', $ticket->id) }}">Ticket No.{{ $ticket->id }}</a></td>
                                                    <td>{{ $ticket->created_at->format('Y-m-d H:i:s') }}</td>
                                                    {{-- <td>{{ $ticket->company_name }}</td> --}}
                                                    <td>{{ $ticket->title }}</td>
                                                    <td>{{ $ticket->description }}</td>
                                                    <td><span class="badge badge-danger">Closed</span></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div> 

@endsection
