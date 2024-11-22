<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haroine's Quiz</title>
    @vite(['resources/css/testbegin.css','resources/js/test.js'])

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link rel="stylesheet" href="testbegin.css">
    <link rel="icon" href="/assets/Heroineicon.png" type="image/x-icon">
</head>

<body>
    <nav>
        <a href="/"><img src="lastlogo.png" alt="" id="Icon"></a>
        <h1 class="Heroine">Hairoine's Quiz </h1>
    </nav>
    <div class="quiz-container">
        <div class="title">Let's <span id="quiz-span"> Begin!</span></div>
        <div id="question" class="question"></div>
        <label class="option">
            <input type="radio" name="option" value="1" />
            <span class="option1"></span>
        </label>
        <label class="option">
            <input type="radio" name="option" value="2" />
            <span class="option2"></span>
        </label>
        <label class="option">
            <input type="radio" name="option" value="3" />
            <span class="option3"></span>
        </label>
        <!-- Buttons -->
        <div class="controls">
            <button class="previous">Previous</button>
            <button class="next">Next</button>
        </div>
    </div>

    <div class="result">

    </div>

    <footer id="footer">



        <div class="social">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-instagram"></i>
            <i class="fa fa-youtube-play"></i>
            <p>copyright <span>&#169; COSC333_students</span></p>
        </div>
    </footer>
    </div>
    <script src="/miscellaneous/home_btn.js"></script>
    <script src="{{ asset('resources/js/test.js') }}"></script>
</body>

</html>