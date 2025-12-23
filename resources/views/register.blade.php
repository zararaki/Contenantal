<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Join The Continental</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="bg-blur"></div>

    <div class="auth-wrapper">

        <div class="auth-card wide">

            <!-- LEFT SIDE FORM -->
            <div class="auth-form">

                <h1 class="auth-title">Join The Continental</h1>
                <p class="auth-subtitle">Choose your path in the guild</p>

                <form action="{{ url('/register') }}" method="POST">
                    @csrf

                    <input type="text" name="name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="password" name="password" placeholder="Password" required>

                    <p class="role-title">Select Role</p>

                    <div class="role-group">
                        @foreach($roles as $role)
                            <label class="role-option">
                                <input type="checkbox" name="role[]" value="{{ $role->id }}">
                                <span>{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>


                    <button type="submit" class="auth-btn">
                        Enter Guild
                    </button>

                    <div class="auth-footer">
                        <span>Already have an account?</span>
                        <a href="{{ url('login') }}">Login</a>
                    </div>
                </form>

            </div>

            <!-- RIGHT SIDE IMAGE (STATIC) -->
            <div class="auth-preview">
                <img src="{{ asset('images/default.png') }}" alt="Guild Preview">
            </div>

        </div>

    </div>

</body>

</html>