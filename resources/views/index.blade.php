@extends('layout')

@section('title', 'Home Page')

@section('content')
<!-- Banner Section -->
<section id="banner" style="background: linear-gradient(rgba(0, 0, 0, 0.5), #e57b7bed), url('{{ asset('src/hair01.jpeg') }}'); background-size: cover; background-position: center; height: 100vh;">
    <div class="banner-text">
        <h1>Hairoine</h1>
        <p>YOUR HAIR</p>
        <p>YOUR GOALS</p>
        <p>YOUR FORMULA</p>
       

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

<!-- Features Section -->
<section id="features">
    <div class="title-text">
        <p>features</p>
        <h1>why choose us ?</h1>
    </div>
    <div class="feature-box">
        <div class="features">
            <h1>our commitment</h1>
            <div class="features-desc">
                <div class="features-icon"><i class="fa fa-shield"></i></div>
                <div class="features-text">
                    <p>We formulate and produce our products in-house, ensuring total quality control at every stage. Our formula commitment ensures formulas are safety-tested, dermatologist-tested, and consumer-validated.</p>
                </div>
            </div>
            <h1>MINIMIZING OUR FOOTPRINT</h1>
            <div class="features-desc">
                <div class="features-icon"><i class="fa fa-check-square-o"></i></div>
                <div class="features-text">
                    <p>We use post-consumer recycled materials for product bottles and shipping boxes. Our packaging supplier holds SFI Certification, ensuring sustainable forestry practices in sourcing.</p>
                </div>
            </div>
            <h1>OUR ONE OF A KIND FACILITY</h1>
            <div class="features-desc">
                <div class="features-icon"><i class="fa fa-inr"></i></div>
                <div class="features-text">
                    <p>Our advanced facility creates a unique formula every 13 seconds, with customizations for fragrance, color, size, and bottle type.</p>
                </div>
            </div>
        </div>
        <div class="features-img">
            <img src="{{ asset('src/hair03.jpeg') }}">
        </div>
    </div>
</section>

<!-- Services Section -->
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
                <p>Our formulas are science-based and vegan.</p>
            </div>
        </div>
        <div class="single-service">
            <img src="{{ asset('src/hair9.jpg') }}">
            <div class="overlay"></div>
            <div class="service-desc">
                <h3>care</h3>
                <hr>
                <p>Our approach combines high-performing, targeted ingredients.</p>
            </div>
        </div>
        <div class="single-service">
            <img src="{{ asset('src/brown.jpg') }}">
            <div class="overlay"></div>
            <div class="service-desc">
                <h3>safety</h3>
                <hr>
                <p>Combining the best from nature and science for personalized formulas.</p>
            </div>
        </div>
    </div>
</section>


@endsection
