<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - The Contenantal</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="auth-wrapper">

        <div class="auth-card wide">

            <!-- LEFT SIDE FORM -->
            <div class="auth-form">
                <div class="padding"></div>

                <h1 class="auth-title">Welcome</h1>
                <p class="auth-subtitle">Enter your credentials to access the guild</p>

                <form action="{{ url('/login') }}" method="POST">
                    @csrf

                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="password" name="password" placeholder="Password" required>

                    <button type="submit" class="auth-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Login to Guild
                    </button>

                    <div class="auth-footer">
                        <span>Don't have an account?</span>
                        <a href="{{ url('register') }}">Join the Guild</a>
                    </div>
                </form>

            </div>

            <!-- RIGHT SIDE IMAGE -->
            <div class="auth-preview">
                <img src="{{ asset('images/default.png') }}" alt="Login Preview">
            </div>

        </div>

    </div>

</body>

</html>