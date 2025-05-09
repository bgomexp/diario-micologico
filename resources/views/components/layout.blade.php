<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Diario Micológico</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/5635/5635613.png">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js') <!--FIXME esto se importa en todas las páginas-->
</head>
<body class="flex flex-col h-screen">
    <x-header/>    
        {{ $slot }}
</body>
<x-footer/>
</html>