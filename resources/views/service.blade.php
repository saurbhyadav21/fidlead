<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
            background-color: #a1045a;
            /* Red color used previously */
            padding: 10px 20px;
            color: white;
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
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
        }

        .navbar .menu a:hover {
            background-color: #8c044e;
            border-radius: 5px;
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
        <div class="logo">My Website</div>
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
        <h1>Our Services</h1>
<p>Explore the wide range of services we offer to cater to your needs.</p>

    </div>

    <div class="footer">
        <p>&copy; 2024 My Website. All rights reserved. | <a href="#">Privacy Policy</a></p>
    </div>
</body>
</html>
