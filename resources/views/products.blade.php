<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="lastlogo.png">
    <link rel="stylesheet" href="products.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <title>Products</title>

    @vite('resources/css/products.css')

</head>

<body>
    <div class="navbar">
        <a href="/"><img src="{{ asset('pics/lastlogo.png') }}"  alt="" class="logonav"></a>

        <div class="navbar2">

            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/quiz">Take Quiz</a></li>
                <li><a href="/login">Login / SignUp</a></li>
                <li><a href="#footer">Meet Us</a></li>
            </ul>

        </div>


        <div id="side-nav">
            <img src="{{ asset('src/close.png') }}" alt="" class="closenav">
            <nav>
                <ul>
                    <li><a href="#banner">Home</a></li>
                    <li><a href="/quiz">Take Quiz</a></li>
                    <li><a href="/index.php/products">View Products</a></li>
                    <li><a href="/login">Login / SignUp</a></li>
                    <li><a href="#footer">Meet us</a></li>
                </ul>
            </nav>
        </div>
        <div id="menuBtn">
            <img src="{{ asset('src/menu.png') }}" id="menu">
        </div>

    </div>

    <div class="container">
        <header>
            <div class="title">
                <h5>Product List</h5>

            </div>
            <div class="icon-cart">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                </svg>
                <span>0</span>
            </div>

        </header>
        <div class="listProduct">
            <img src="{{ asset('pics/back1.png') }}" alt="" class="back1">
            <img src="{{ asset('pics/back2.png') }}" alt="" class="back2">
            <img src="https://static.vecteezy.com/system/resources/previews/010/832/908/original/tropical-green-palm-leaf-tree-isolated-on-white-background-free-png.png" alt="" class="tropical">
            <img src="{{ asset('pics/back3.png') }}" alt="" class="back3">


        </div>
    </div>
    <div class="cartTab">
        <h1>Shopping Cart</h1>
        <div class="listCart">

        </div>
        <div class="btn">
            <button class="close">Close</button>
            <button class="checkOut">Check Out</button>
        </div>
    </div>

    <footer id="footer">

    <img src="{{ asset('pics/lastlogo.png') }}" alt="" class="logo">
        <img src="{{ asset('pics/back4.png') }}" alt="" class="back4">
        <img src="{{ asset('pics/back5.png') }}" alt="" class="back5">
        <img src="{{ asset('pics/back6.png') }}" alt="" class="back6">





        <div class="social">
            <div><i class="fa fa-facebook"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-youtube-play"></i>
            </div>

            <p>copyright <span>&#169; COSC333_students</span></p>
        </div>
    </footer>

    <script src="{{asset('resources/js/products.js')}}"></script>

</body>

</html>