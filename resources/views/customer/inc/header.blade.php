<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Theme/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ config('app.url') }}/Theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Theme/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Theme/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Theme/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ config('app.url') }}/Theme/plugins/summernote/summernote-bs4.min.css">


    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ config('app.url') }}/Theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ config('app.url') }}/Theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ config('app.url') }}/Theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <script src="{{ config('app.url') }}/Theme/plugins/jquery/jquery.min.js"></script>

</head>
<style>
    .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
        color: rgb(255 24 24 / 70%);
    }
    table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled){
                background: #c0c0c0 !important;
            }

            table.dataTable thead .sorting_asc{
                background-image: none; 
            }

            div.dtsp-panesContainer div.dtsp-searchPanes div.dtsp-searchPane{
                border: 1px solid #e8e8e8;
                padding: 7px;
            }
            .navbar-light .navbar-nav .nav-link {
                    color: rgba(0, 0, 0, .5);
                    font-weight: bold;
                    color: black;
                }
                .content-header {
    padding: 0px .5rem !important;
}
    </style>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ config('app.url') }}/Theme/dist/img/AdminLTELogo.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li> --}}
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('customer/dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('customer/search') }}" class="nav-link">New Search</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('customer/point-history') }}" class="nav-link">My Subscription</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('customer/buy-lead-sec') }}" class="nav-link">My Leads</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('customer/favorites/' . session('customer_data')->id) }}" class="nav-link">My Favourites</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('profile/' . session('customer_data')->id) }}" class="nav-link">Profile</a>
                </li> --}}
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('seeNotification/' . session('customer_data')->id) }}" class="nav-link">Notifications</a>
                </li>
            
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/tickets') }}" class="nav-link">Support Ticket</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Profile Icon and Username -->
                <li class="nav-item dropdown" style="    border-right: 1px solid #eee;">
                    <a class="nav-link" href="{{ url('profile/' . session('customer_data')->id) }}">
                        <img src="{{ session('customer_data')->avatar ?? 'https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small_2x/user-profile-icon-free-vector.jpg' }}" alt="Profile" 
                            class="profile-icon" style="width: 27px;" />
                        <span class="ml-2">{{ session('customer_data')->name }}</span>
                    </a>
                </li>
            
                <!-- Logout Link -->
                <li class="nav-item dropdown">
                    <form id="logout-form" action="{{ url('customer/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        style="cursor:pointer">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            
                <style>
                    .blink_me {
                        animation: blinker 1s linear infinite;
                    }
            
                    @keyframes blinker {
                        50% {
                            opacity: 0;
                        }
                    }
                </style>
            
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ url('seeNotification/' . session('customer_data')->id) }}">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge blink_me" id="notificationCount">0</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="display: none;">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ config('app.url') }}/Theme/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ session('customer_data')->company_name }}</span>
            </a>


            <div class="sidebar">



               
            </div>

        </aside>

<script>

function fetchNotificationCount() {
    fetch('/notifications/count')
    .then(response => response.json())
    .then(data => {
    document.getElementById('notificationCount').innerText = data.unread_count;
    });
}

// Call the function periodically to update the count
setInterval(fetchNotificationCount, 5000); // Update every 5 seconds

// Initial call
fetchNotificationCount();
</script>
