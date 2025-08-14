@extends('layouts.customerapp')

@section('title', 'Profile')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                {{-- <div class="col-sm-6"></div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Notification</li>
                    </ol>
                </div>
            </div>
            
        </div>
    </div>

    <section class="content">
        <div class="container">
            <h2>Announcement</h2>
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
    </section>
</div>

@endsection
