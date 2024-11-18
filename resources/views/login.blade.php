<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('pics/lastlogo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>

    <!-- Include the CSS file -->
    @vite(['resources/css/login.css'])
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
                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="login-container" id="login">
                    @csrf
                    <div class="top">
                        <span>Don't have an account? <a href="/signup">Sign Up</a></span>
                        <header>Login</header>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Username or Email" name="username" required>
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Password" name="password" required>
                        <i class="fa fa-lock"></i>
                    </div>
                    @if($errors->any())
                        <p style="text-align: center; margin-bottom: 10px; color: red;" class="error">
                            {{ $errors->first() }}
                        </p>
                    @endif
                    <div class="input-box">
                        <button type="submit" class="submit">Sign In</button>
                    </div>
                    <div class="bottom">
                        <div class="one">
                            <input type="checkbox" id="login-check">Remember Me
                        </div>
                        <div class="two">
                            <label><a href="#">Forgot password?</a></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
