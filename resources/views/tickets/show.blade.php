{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $ticket->title }}</h2>
        <p>{{ $ticket->description }}</p>
        <span class="badge badge-{{ $ticket->status == 'open' ? 'success' : 'danger' }}">
            {{ ucfirst($ticket->status) }}
        </span>

        <hr>

        <h3>Responses</h3>
        <ul class="list-group">
            @foreach($ticket->responses as $response)
                <li class="list-group-item">
                    <strong>{{ $response->user->name }}:</strong>
                    <p>{{ $response->response }}</p>
                    <small>{{ $response->created_at->format('d M Y, h:i A') }}</small>
                </li>
            @endforeach
        </ul>

        @if($ticket->status == 'open')
            <hr>
            <form action="{{ route('tickets.response.store', $ticket->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="response">Add a Response:</label>
                    <textarea name="response" id="response" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Response</button>
            </form>
        @endif

        <hr>

        @if($ticket->status == 'open')
            <form action="{{ route('tickets.close', $ticket->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Close Ticket</button>
            </form>
        @else
            <form action="{{ route('tickets.open', $ticket->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Reopen Ticket</button>
            </form>
        @endif
    </div>
@endsection --}}


@extends('layouts.customerapp')

@section('title', 'Ticket Details')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Ticket Details</li>
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
                        <h2>Ticket Details</h2>
                        <h4>Customer: {{ $customerName }}</h4> <!-- Display customer's name -->
                
                        <h4>Responses:</h4>
                        
                        @if($ticket->responses->isEmpty())
                            <!-- If no responses from admin, show a message -->
                            <div class="alert alert-info">
                                <strong>Important:</strong> Your ticket is in progress. The admin will respond soon.
                            </div>
                        @else
                            <ul class="list-group">
                                @foreach($ticket->responses as $response)
                                    <li class="list-group-item">
                                        <!-- Check if the response is from the admin or the customer -->
                                        @if($response->user_id == $ticket->user_id)
                                            <strong>Customer:</strong>
                                        @else
                                            <strong>Admin:</strong>
                                        @endif
                                        <p>{{ $response->response }}</p>
                                        <small>{{ $response->created_at->format('d M Y, h:i A') }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                
                        @if($ticket->status == 'open')
                            <hr>
                            <form action="{{ route('tickets.response.store', $ticket->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="response">Add a Response:</label>
                                    <textarea name="response" id="response" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Response</button>
                            </form>
                        @endif
                        
                        <hr>
                        @if($ticket->status == 'open')
                            <form action="{{ route('tickets.close', $ticket->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Close Ticket</button>
                            </form>
                        @else
                            <form action="{{ route('tickets.open', $ticket->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Reopen Ticket</button>
                            </form>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection
