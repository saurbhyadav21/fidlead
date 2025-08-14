@extends('layouts.app')

@section('title', 'Data Show')

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
                        <li class="breadcrumb-item active">BuyerSellerData</li>
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
                        <h2>Notifications</h2>
                        <ul class="list-group">
                            @foreach($notifications as $notification)
                                <li class="list-group-item {{ $notification->is_read ? '' : 'font-weight-bold' }}">
                                    <strong>{{ $notification->title }}</strong>
                                    <p>{{ $notification->message }}</p>
                                    <small>Sent to: {{ $notification->user_name }}</small><br>
                                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div> 

@endsection
