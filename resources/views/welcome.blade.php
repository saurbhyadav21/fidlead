{{-- Welcome To Website Aliro
<br>
<a href="/customer/login">Customer Login<a>
<br>
<a href="/customer/signup">Customer Signup<a> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Front Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            /* Red color used previously */
            padding: 10px 20px;
            color: white;
            border-bottom: 1px solid #f2f2f2;box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar .menu {
            display: flex;
            gap: 15px;
        }

        .navbar .menu a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
        }

        .navbar .menu a:hover {
            background-color: #white;
            border-radius: 5px;
            color : red !important;
        }

        .navbar .dropdown {
            position: relative;
            display: inline-block;
        }

        .navbar .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .navbar .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .navbar .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .navbar .dropdown:hover .dropdown-content {
            display: block;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }

            .navbar .menu {
                flex-direction: column;
                gap: 10px;
            }
        }

        .content {
            flex: 1;
            padding: 20px;
            text-align: center;
        }

        .content h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 18px;
            color: #555;
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 20px;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

        .footer a {
            color: #a1045a;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('image/logo.jpeg') }}" alt="Logo" width="100">
        </div>
        <div class="menu">
            <a href="/">Home</a>
            <a href="/about">About Us</a>
            <a href="/service">Services</a>
            <a href="/whyus">Why Us</a>
            <a href="/whatwedo">What We Do</a>
            <a href="/faq">FAQ</a>
            <a href="/customer/login">Login</a>
            <a href="/signup">Sign Up</a>
            {{-- <div class="dropdown">
                <a href="#">Login</a>
                <div class="dropdown-content">
                    <a href="#">Login</a>
                    <a href="#">Sign Up</a>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="content">
        <h1>Welcome to Our Website</h1>
        <p>Explore our services and learn more about what we offer.</p>
    </div>

    <div class="footer">
        <p>&copy; 2024 | <a href="#" style="color: #f1f1f1">Privacy Policy</a> | <a href="#" style="color: #f1f1f1">Contact Us | <a href="#" style="color: #f1f1f1">Terms and Condition  | <a href="#" style="color: #f1f1f1">Refund policy</a></p>
    </div>
</body>
{{-- <script> --}}
    {{-- // <!-- Start of HubSpot Embed Code --> --}}
  <script type="text/javascript" id="hs-script-loader" async defer src="//js-na1.hs-scripts.com/48737609.js"></script>
{{-- // <!-- End of HubSpot Embed Code --> --}}
    {{-- </script> --}}
</html>
