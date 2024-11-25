<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        


        
    <title>@yield('title', 'Hairoine')</title> 
    @vite('resources/css/layout.css')
    @vite('resources/css/style.css')
    @vite('resources/css/products.css')
    @vite('resources/css/show.css')
    @vite('resources/css/order.css')
</head>
<body>
<header>
    <div id="header">
        <div id="headerfirst">
            <a href="/">Home</a>    
            <a href="/quiz">Quiz</a>
            <a href="/productsList">Products</a>
            <a href="#footer">Meet Us</a>
        </div>

        <div id="headermiddle">
            <img src="{{ asset('pics/lastlogo.png') }}" alt="logo" class="logo">
        </div>

        <div id="headerSecond">
            <a href="#features">Features</a>
            <a href="#services">Services</a>
            <a href="#testimonial">Testimonials</a>
        
            @if (Auth::check())
                <!-- Show Hamburger Menu for Authenticated Users -->
                <div class="dropdown">
                    <button class="hamburger-menu" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        &#9776;
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item" href="/cart">
                                Cart ({{ Auth::user()->cart->sum('pivot.quantity') }})
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/favorites">
                                Favorites ({{ Auth::user()->favorites->count() }})
                            </a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item text-white" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <!-- Show Login/Register Link for Guests -->
                <a href="/login">Login/Register</a>
            @endif
        </div>
        
        
        

        <!-- Hamburger Icon -->
        <div id="hamburger-menu" onclick="toggleMenu()">
            <i class="fa fa-bars"></i>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <nav id="mobile-nav">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/quiz">Quiz</a></li>
            <li><a href="/productsList">Products</a></li>
            <li><a href="#footer">Meet Us</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#testimonial">Testimonials</a></li>
            <li><a href="/login">Login/Register</a></li>
        </ul>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer id="footer">
    <img src="{{ asset('pics/lastlogo.png') }}" alt="" class="footerlogo">
    <img src="{{ asset('pics/back4.png') }}" alt="" class="back4">
    <img src="{{ asset('pics/back5.png') }}" alt="" class="back5">
    <img src="{{ asset('pics/back6.png') }}" alt="" class="back6">

    <div class="social">
        <div>
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-instagram"></i>
            <i class="fa fa-youtube-play"></i>
        </div>
        <p>copyright <span>&#169; COSC434_students</span></p>
    </div>
</footer>

<script>
    // Toggle Mobile Navigation
    function toggleMenu() {
        const mobileNav = document.getElementById('mobile-nav');
        mobileNav.style.display = mobileNav.style.display === 'block' ? 'none' : 'block';
    }
</script>
@stack('scripts')
</body>
</html>
