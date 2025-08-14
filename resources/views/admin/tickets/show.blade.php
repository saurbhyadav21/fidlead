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
                        <strong>
                            {{-- {{$responses}} --}}
                            {{ $response->user_id == 1 ? 'Admin' : ($users[$response->user_id]->name ?? 'User not found') }}
                        </strong>: 
                        {{ $response->response }}
                        <small class="float-right">{{ $response->created_at->format('d M Y, h:i A') }}</small>
                    </li>
                @endforeach
            </ul>
    
            <hr>
            <form action="{{ route('admin.tickets.response.store', $ticket->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="response">Add a Response:</label>
                    <textarea name="response" id="response" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Response</button>
            </form>
    
            <hr>
    
            @if($ticket->status == 'open')
                <form action="{{ route('admin.tickets.close', $ticket->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Close Ticket</button>
                </form>
            @endif
        </div>
    </section>
</div> 



@endsection