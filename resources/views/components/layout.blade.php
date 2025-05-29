<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Diario Micológico</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @stack('scripts')
</head>
<body class="flex flex-col h-screen bg-brown-100 text-brown-800">
    <x-header/>
        @if (session('success'))    
            <x-alerts.success>{{ session('success') }}</x-alerts.success>
        @elseif (session('fail'))
            <x-alerts.fail>{{ session('fail') }}</x-alerts.fail>
        @endif   
        {{ $slot }}
    <x-footer/>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <script src="https://kit.fontawesome.com/f86955cabd.js" crossorigin="anonymous"></script>
</body>
</html>