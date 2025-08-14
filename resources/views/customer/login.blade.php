<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page with Slider</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding-top: 60px; /* Add space for navbar */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }
        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            z-index: 1000;
        }
        .navbar img {
            height: 40px;
        }
        .container {
            display: flex;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .slider {
            width: 600px;
            overflow: hidden;
            border-radius: 10px;
            position: relative;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }
        .slide img {
            width: 100%; 
            height: 300px;
            border-radius: 10px;
        }
        .login-box {
            width: 300px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-box button {
            width: 100%;
            padding: 10px;
            background: #6c63ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-box button:hover {
            background: #5a54e6;
        }
        .login-box a {
            display: block;
            text-align: center;
            margin-top: -9px;
            color: #6c63ff;
            text-decoration: none;
            font-size: 12px;
        }
        .dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
        }
        .dot {
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            cursor: pointer;
        }
        .active {
            background-color: #6c63ff;
        }
        @media screen and (max-width: 768px) {
            .slider {
                display: none;
            }
            .login-box {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <img src="{{ asset('image/logo.jpeg') }}" alt="Logo">
    </div>

    <div class="container">
        <div class="slider">
            <div class="slides">
                <div class="slide"><img src="https://api.finanvo.in/assets/images/opportunities.png" alt="Slide 1"></div>
                <div class="slide"><img src="https://api.finanvo.in/assets/images/mca-v3.png" alt="Slide 2"></div>
                <div class="slide"><img src="https://api.finanvo.in/assets/images/director-contact.png" alt="Slide 3"></div>
            </div>
            <div class="dots">
                <div class="dot active" onclick="currentSlide(0)"></div>
                <div class="dot" onclick="currentSlide(1)"></div>
                <div class="dot" onclick="currentSlide(2)"></div>
            </div>
        </div>
        <div class="login-box">
            <h2>LOGIN</h2>
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

            <form method="POST" action="{{ url('customer/login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
            <p class="mb-1">
                <a href="{{ url('password/forgot') }}">I forgot my password</a>
            </p>
            <a href="#">Get Free Account</a>
        </div>
    </div>

    <script>
        let currentIndex = 0;
        const slides = document.querySelector(".slides");
        const dots = document.querySelectorAll(".dot");
        
        function showSlide(index) {
            slides.style.transform = `translateX(${-index * 100}%)`;
            dots.forEach(dot => dot.classList.remove("active"));
            dots[index].classList.add("active");
        }
        function nextSlide() {
            currentIndex = (currentIndex + 1) % dots.length;
            showSlide(currentIndex);
        }
        function currentSlide(index) {
            currentIndex = index;
            showSlide(currentIndex);
        }
        setInterval(nextSlide, 3000);
    </script>

</body>
</html>
