<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Login | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Theme/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- <link rel="stylesheet" href="../Theme/plugins/fontawesome-free/css/all.min.css"> --}}
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('Theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Theme/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Aliero</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                {{-- <p class="login-box-msg">Customer Login</p> --}}
                <div class="container">
                    <h2>Change Password</h2>
                
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('Theme/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Theme/dist/js/adminlte.min.js') }}"></script>
</body>

</html>



















{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Change Password</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
</div>
@endsection --}}
