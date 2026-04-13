<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
<meta name="apple-mobile-web-app-title" content="ProfitPort" />
<link rel="manifest" href="/site.webmanifest" />
    <link rel="stylesheet" href="{{ asset('vitecss/fonts/fonts.css?v='.config('versions.vite_version').'') }}">
    <link rel="stylesheet" href="{{ asset('vitecss/css/app.css?v='.config('versions.vite_version').'') }}">
    
    <title>{{ config('app.name') }} || Users || @yield('title') </title>
</head>
<body>
    <header>

    </header>
    <main>
        @yield('main')
    </main>
    <footer>

    </footer>
    <script src="{{ asset('js/app.js?v='.config('versions.vite_version').'') }}"></script>
</body>
</html>
