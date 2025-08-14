<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Def    ault Title')</title>
    <!-- Include your CSS files here -->
</head>
<body>
    @include('../admin.inc.header')

    <main>
        @yield('content')
    </main>

    @include('../admin.inc.footar')

    <!-- Include your JavaScript files here -->
</body>
</html>
