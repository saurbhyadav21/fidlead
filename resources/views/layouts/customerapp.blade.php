<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Include your CSS files here -->
</head>
<body>
    @include('../customer.inc.header')

    <main>
        @yield('content')
    </main>

    @include('../customer.inc.footar')

    <!-- Include your JavaScript files here -->
</body>
</html>
