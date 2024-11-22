<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('pics/lastlogo.png') }}">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- smooth scroll cdn link  -->
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <title>HAIROINE</title>

    @vite(['resources/css/style.css', 'resources/js/index.js'])
    </head>



<body>
    <!-- main page -->
    <section id="banner" style="background: linear-gradient(rgba(0, 0, 0, 0.5), #e57b7bed), url('{{ asset('src/hair01.jpeg') }}'); background-size: cover; background-position: center; height: 100vh;">

        <img src="{{ asset('src/lastlogo.png') }}" class="logo">
        
        <div class="banner-text">
            
            <h1>Hairoine</h1>
            <p>YOUR HAIR</p>
            <p>YOUR GOALS</p>
            <p>YOUR FORMULA</p>
            
            <button id="banner-btn">Customize Your Formula!</button>

            <div class="popup" id="popup">
                <div class="popup-inner">
                    <h2>Hair Quiz</h2>
                    <p>Take Our Special Hair Quiz to Customize Your Product!</p>
                    <div id="go"><button id="TakeQuizbtn"><a href="/quiz">Take Quiz</a></button></div>
                    <br>
                    <button id="Skipbtn">Skip for now</button>
                </div>
            </div>

        </div>
    </section>


    <div id="side-nav">
        <nav>
            <ul>
                <li><a href="/">home</a></li>
                <li><a href="/quiz">Take Quiz</a></li>
                <li><a href="/index.php/products">View Products</a></li>
                <li><a href="/login">Login/Sign Up</a></li>
                <li><a href="#features">features</a></li>
                <li><a href="#services">services</a></li>
                <li><a href="#testimonial">testimonial</a></li>
                <li><a href="#footer">meet us</a></li>
            </ul>
        </nav>
    </div>
    <div id="menuBtn">
        <img src="{{ asset('src/menu.png') }}" id="menu">
    </div>


    <section id="features">
        <div class="title-text">
            <p>features</p>
            <h1>why choose us ?</h1>
        </div>
        <div class="feature-box">
            <div class="features">
                <h1>our commitment</h1>
                <div class="features-desc">
                    <div class="features-icon">
                        <i class="fa fa-shield"></i>
                    </div>
                    <div class="features-text">
                        <p>we formulate and produce our products in-house, ensuring total quality control at every stage. Our formula commitment ensures formulas are saftey-tested, dermatologist-tested, and consumer-validated.
                        </p>
                    </div>
                </div>
                <h1>MINIMIZING OUR FOOTPRINT</h1>
                <div class="features-desc">
                    <div class="features-icon">
                        <i class="fa fa-check-square-o"></i>
                    </div>
                    <div class="features-text">
                        <p>Every step we take is intentional, aiming to minimize our environmental impact. We use post-consumer recycled materials for our product bottles and shipping boxes. Our packaging supplier holds SFI Certification, ensuring sustainable
                            forestry practices in material sourcing.
                        </p>
                    </div>
                </div>
                <h1>OUR ONE OF A KIND FACILITY</h1>
                <div class="features-desc">
                    <div class="features-icon">
                        <i class="fa fa-inr"></i>
                    </div>
                    <div class="features-text">
                        <p>In our advanced production facility, our proprietary algorithm enables us to create a unique formula every 13 seconds. This facility is designed for comprehensive customization, accommodating various parameters including fragrance,
                            color, size, and bottle type. </p>
                    </div>
                </div>
            </div>
            <div class="features-img">
                <img src="{{ asset('src/hair03.jpeg') }}">
            </div>
        </div>
    </section>

    <!-- services page -->
    <section id="services">
        <div class="title-text">
            <p>services</p>
            <h1>we provide better</h1>
        </div>
        <div class="service-box">
            <div class="single-service">
                <img src="{{ asset('src/hair5.jpg') }}">
                <div class="overlay"></div>
                <div class="service-desc">
                    <h3>quality</h3>
                    <hr>
                    <p>We carefully review every ingredient for safety and performance.</p>
                </div>
            </div>
            <div class="single-service">
                <img src="{{ asset('src/ginger.jpg') }}">
                <div class="overlay"></div>
                <div class="service-desc">
                    <h3>formula</h3>
                    <hr>
                    <p> Our formulas are science-based and vegan.</p>
                </div>
            </div>
            <div class="single-service">
                <img src="{{ asset('src/hair9.jpg') }}">
                <div class="overlay"></div>
                <div class="service-desc">
                    <h3>care</h3>
                    <hr>
                    <p> Our innovative approach to beauty is to do more with fewer, targeted, high-performing ingredients.</p>
                </div>
            </div>
            <div class="single-service">
                <img src="{{ asset('src/brown.jpg') }}">
                <div class="overlay"></div>
                <div class="service-desc">
                    <h3>safety</h3>
                    <hr>
                    <p>Combining the best from nature + science, we deliver the most efficacious, personalized formula.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- testimonial page -->
    <section id="testimonial">
        <div class="title-text">
            <p>testimonial</p>
            <h1>what client says ?</h1>
        </div>
        <div class="testimonial-row">
            <div class="testimonial-column">
                <div class="user">
                    <img src="{{ asset('src/selfie1.jpg') }}">
                    <div class="user-info">
                        <h4>ken normen <i class="fa fa-twitter"></i></h4>
                        <small>@kennormen</small>
                    </div>
                </div>
                <p>Prior to using Hairione, my hair was course and brittle due to graying. It had also changed to a wavy frizz. After using Function of Beauty for several months, my hair is soft and manageable. I flat iron it every day and it is still very
                    healthy. I liked being able to choose what to put into my shampoo.</p>
            </div>
            <div class="testimonial-column">
                <div class="user">
                    <img src="{{ asset('src/selfie2.jpg') }}">
                    <div class="user-info">
                        <h4>kaylie gorge <i class="fa fa-twitter"></i></h4>
                        <small>@heykaylie</small>
                    </div>
                </div>
                <p>Hair quiz was both fun and easy to do!! The variety of scents, colors and options for hair types is fantastic. Shipping was also quick! The shampoo & conditioner combo has exceeded my expectations and has vastly improved the health of
                    my hair!! If you decide to buy these products, remember to give some time!</p>
            </div>
            <div class="testimonial-column">
                <div class="user">
                    <img src="{{ asset('src/selfie3.jpg') }}">
                    <div class="user-info">
                        <h4>eddie munson<i class="fa fa-twitter"></i></h4>
                        <small>@eddiem</small>
                    </div>
                </div>
                <p>I use Hairione products for years and have never been disappointed by an order. This time I received my products with sugared and spice(d) fragrance and I swear it‘s the best! I use shampoo, conditioner, hair oil and nie also the leave-in
                    conditioner and my hair has never looked and felt better!</p>
            </div>
        </div>
    </section>


    <footer id="footer">

        <img src="{{ asset('pics/lastlogo.png') }}" alt="" class="footerlogo">
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

    <!-- custom js file -->
    <script src="{{ asset('resources/js/index.js') }}"></script>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</html>

