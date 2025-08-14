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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <p class="login-box-msg">Forget Password</p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.forgot.check') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Verify Email</button>
                </form>

            </div>
        </div>
    </div>

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
    <h2>Forgot Password</h2>
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.forgot.check') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Verify Email</button>
    </form>
</div>
@endsection --}}
