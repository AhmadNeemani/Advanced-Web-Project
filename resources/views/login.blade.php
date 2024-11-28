<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">
    <script src="{{asset('reources/js/login.js')}}" defer></script>
    <title>Login</title>
    @vite('resources/css/login.css')

</head>

<body>
    <section>
        <div class="wrapper">
            <nav class="nav">
                <div class="nav-logo">
                    <h1>Hairoine</h1>
                </div>

                <p id="home"><a href="/">Home</a></p>
            </nav>

            <div class="form-box">


                <div class="login-container" id="login">
                    <div class="top">
                        <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                        <header>Login</header>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Username or Email" id="username">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Password" id="password">
                        <i class="bx bx-lock-alt"></i>
                    </div>

                    <p style="text-align: center; margin-bottom: 10px; color: white;" class="error"></p>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Sign In" id="signin-btn">
                    </div>

                    <div class="bottom">
                        <div class="one">
                            <input type="checkbox" id="login-check">Remember Me
                        </div>

                        <div class="two">
                            <label><a href="#">Forgot password?</a></label>
                        </div>
                    </div>
                </div>
                <!------------------- registration form -------------------------->
                <div class="register-container" id="register">
                    <div class="top">
                        <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                        <header>Sign Up</header>
                    </div>
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Firstname">
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Lastname">
                            <i class="bx bx-user"></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Email">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Register">
                    </div>
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" id="register-check">
                            <label for="register-check"> Remember Me</label>
                        </div>
                        <div class="two">
                            <label><a href="#">Terms & conditions</a></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function validateLogin() {
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;

                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (username === "" || password === "") {
                    document.querySelector('.login-container .error').textContent = "Username and password are required.";
                } else if (!emailRegex.test(username)) {
                    document.querySelector('.login-container .error').textContent = "Please enter a valid email address.";
                } else {

                    document.querySelector('.login-container .error').textContent = "";

                    window.location.href = "/";
                }
            }

            document.getElementById('signin-btn').addEventListener('click', validateLogin);
        });
    </script>







</body>

</html>