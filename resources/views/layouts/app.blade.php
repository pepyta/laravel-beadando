<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="grid-cols-1">
            <div class="border">
                <div class="container !mb-4 !mt-4">
                    <a href="/" class="p-2">
                        Főoldal
                    </a>
                    <a href="/teams" class="p-2">
                        Csapatok
                    </a>
                    <a href="/games" class="p-2">
                        Mérkőzések
                    </a>
                    <a href="/leaderboard" class="p-2">
                        Tabella
                    </a>
                    <a href="/favorites" class="p-2">
                        Kedvenceim
                    </a>

                    <div class="inline float-right">
                        @guest
                            <a href="{{ route("register") }}" class="p-2">
                                Regisztráció
                            </a>
                            <a href="{{ route("login") }}" class="p-2">
                                Bejelentkezés
                            </a>
                        @endguest
                        @auth
                            <span class="pr-4">
                                Szia, {{ Auth::user()->name }}!
                            </span>
                            <form method="POST" action="{{ route("logout") }}" class="inline">
                                @csrf
                                <input type="submit" value="Kijelentkezés" class="inline !bg-transparent !text-sky-500 !p-0" />
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
            {{ $slot }}
        </div>
    </body>
</html>
