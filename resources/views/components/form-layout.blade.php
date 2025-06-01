<!DOCTYPE html>
<html lang="en" class="min-h-full bg-brown-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Diario Micológico</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    @vite('resources/css/app.css')
    @stack('scripts')
</head>
<body class="text-brown-800">
    {{ $slot }}
</body>
</html>