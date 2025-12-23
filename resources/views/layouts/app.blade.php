<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE CONTENANTAL</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Tailwind (Optional, for utility classes if used in Blade) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/hunter_style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/client_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/board_style.css') }}">

</head>

<body class="bg-gray-900 text-white min-h-screen">

    <!-- NAVBAR -->
    <nav>
        <div class="container mx-auto flex justify-between items-center p-4">
            <!-- BRAND -->
            <h1 class="text-2xl font-bold">THE CONTENANTAL</h1>

            <!-- LINKS -->
            <div class="space-x-4 flex items-center">
                <a href="/quests">Quest Board</a>

                @auth
                    @if(auth()->user()->isHunter())
                        <a href="/hunter/dashboard">Hunter Dashboard</a>
                    @endif
                    @if(auth()->user()->isClient())
                        <a href="/client/dashboard">Client Dashboard</a>
                    @endif
                    @if(auth()->user()->isAdmin())
                        <a href="/admin/dashboard">Admin Dashboard</a>
                    @endif

                    <span>Welcome, {{ auth()->user()->name }}</span>

                    <a href="/logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="/logout" method="POST" class="hidden">@csrf</form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container mx-auto mt-8 px-4">
        @include('partials.message')
        @yield('content')
    </div>

</body>

</html>