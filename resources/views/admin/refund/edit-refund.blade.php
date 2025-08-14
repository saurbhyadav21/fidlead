<!-- resources/views/customers/edit.blade.php -->
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
                        <li class="breadcrumb-item active">privacy_policy</li>
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
                        <h1>Edit refund</h1>
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <form action="{{ route('edit-pp-refund', $refund->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    
                       
                            <div class="form-group">
                                <label for="Description">Description:</label>
                                <textarea name="Description" rows="3" class="form-control" placeholder="Description">{{ $refund->description }}</textarea>

                            </div>
                  
                    
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
@endsection
