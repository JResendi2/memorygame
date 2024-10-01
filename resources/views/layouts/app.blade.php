<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{env('APP_NAME', 'Juego de memoria')}}</title>

        @yield('style')
        @routes

        @vite(['resources/sass/app.scss'])

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
          rel="stylesheet"
        />
        <link href="https://fonts.googleapis.com/css2?family=Spicy+Rice&display=swap" rel="stylesheet">
    </head>
    <body class="bg-info px-5 py-3">
        <header class="d-flex justify-content-between">
            <h1 class="font-spicy text-white">JUEGO DE MEMORIA</h1>
            <a href="{{route('games.index')}}">
                <h3 class="font-spicy text-white">Puntajes</h3>
            </a>
        </header>
        <div class="container-xl pt-5">
            @yield('content')
        </div>
    </body>
    @yield('script')
</html>
