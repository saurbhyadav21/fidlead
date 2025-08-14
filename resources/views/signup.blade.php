<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Signup | Sign Up</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Theme/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('Theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Theme/dist/css/adminlte.min.css') }}">
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sign Up</h1>
                    </div>
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
                        </ol>
                    </div> --}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
               
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7">
                        <div class="container">
                            {{-- <h1>Add Customer</h1> --}}
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
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
                        
                            <form action="{{ route('customers.store1') }}" method="POST">
                                @csrf
                        
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Password:</label>
                                    <input type="text" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact_number">Contact Number:</label>
                                    <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="company_name">Company Name:</label>
                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation:</label>
                                    <input type="text" name="designation" class="form-control" placeholder="Designation" required>
                                </div>
                                <div class="form-group">
                                    <label for="company_address">Company Address:</label>
                                    <input type="text" name="company_address" class="form-control" placeholder="Company Address" required>
                                </div>
                                <div class="form-group">
                                    <label for="sales_executive">Sales Executive:</label>
                                    <input type="text" name="sales_executive" class="form-control" placeholder="Sales Executive" required>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="role">Role:</label>
                                    <input type="text" name="role" class="form-control" placeholder="Role">
                                </div> --}}
                        
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </section>
                    
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</body>

</html>
