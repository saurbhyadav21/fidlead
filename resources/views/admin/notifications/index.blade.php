@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Notifications</h2>
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item {{ $notification->is_read ? '' : 'font-weight-bold' }}">
                    <strong>{{ $notification->title }}</strong>
                    <p>{{ $notification->message }}</p>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
