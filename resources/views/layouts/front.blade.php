<!DOCTYPE html>
<html lang="en" class="scroll-smooth dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="FcP5XSWeK2YHHMatXtuM7-E-9J8XxZDtCKMtvjz00wM"/>
    @yield('meta')
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="canonical" href='{{ url()->current() }}'>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Manrope:wght@400;500;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- fonts -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/fonts/unicons/unicons.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ url('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ url('style.css') }}">
    <script src="https://cdn.usefathom.com/script.js" data-site="ESBFKVKN" defer></script>
</head>
<body>

@include('layouts.front.navigation')

@yield('content')
{{ $slot ?? '' }}

@include('layouts.front.footer')

</body>
</html>
