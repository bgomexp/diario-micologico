<!DOCTYPE html>
<html lang="en" class="min-h-full bg-brown-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada - Diario Micológico</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="text-brown-800 min-h-screen flex items-center justify-center pb-12">
    <section>
        <div class="pb-12 px-4 max-w-screen-xl lg:py-16 lg:px-6">
            <div class="pb-12 mx-auto max-w-screen-sm flex flex-col items-center">
                <img src="{{ asset('images/sadlogo.png') }}" alt="">
                <h1 class="mb-4 text-2xl tracking-tight font-medium font-youngserif lg:text-3xl">Error 404</h1>
                <p class="mb-4 text-3xl tracking-tight font-medium font-youngserif md:text-4xl">Página no encontrada</p>
                <p class="mb-4 text-lg font-light">Lo sentimos, no hemos logrado encontrar la página que buscas. </p>
                <x-link-button href="/" id="">Volver a la página de inicio</x-link-button>
            </div>   
        </div>
    </section>
</body>
</html>