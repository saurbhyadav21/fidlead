

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
        <div class="container-fluid">
            <h1>Manage Marquee Messages</h1>

            <!-- Add Marquee Message Form -->
            <form action="{{ route('marquee.store') }}" method="POST">
                @csrf
                <input type="text" name="message" placeholder="Enter Marquee Message" required>
                <button type="submit">Add Message</button>
            </form>
            
            <!-- List of Marquee Messages -->
            @foreach ($marquees as $marquee)
                <div>
                    <form action="{{ route('marquee.update', $marquee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="message" value="{{ $marquee->message }}">
                        <button type="submit">Update</button>
                    </form>
                    
                    <form action="{{ route('marquee.destroy', $marquee->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
            {{-- @endsection  --}}
        </div>
    </section>
</div> 



@endsection
