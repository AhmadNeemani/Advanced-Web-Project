<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haroine's Quiz</title>
    @vite(['resources/css/prsntst.css','resources/js/loginq.js'])
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="prsntst.css">
    <link rel="icon" href="/assets/Heroineicon.png" type="image/x-icon" >
</head>
<body>
    <nav>
       <p class="Heroine">Heroine</p>
    </nav> 
    
    <div class="login-page">
        <div class="form" >
          <div class="register-form" action="testbegin.html" hidden>
            <input type="text" placeholder="Name" id="name_reg" required/>
            <input type="password" placeholder="Password" id="pass_reg" required/>
            <input type="text" placeholder="Email@example.com" id="email_reg" required/>
            <button>create</button>
            <span hidden class="error_reg">Enter Fields</span>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
          </div>
          <div class="login-form">
            <input type="text" placeholder="Username" id="name_log" required/>
            <input type="password" placeholder="Password" id="pass_log" required/>
            <button>login</button>
            <span hidden class="error">Enter Fields</span>

            <p class="message">Not registered? <a href="#">Create an account</a></p>
          </div>
        </div>
      </div> 
    
    <script src="/miscellaneous/home_btn.js"></script>
    <script src="{{ asset('resources/js/loginq.js') }}"></script>
</body>
</html>