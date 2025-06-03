<h1>Nueva propuesta de especie</h1>

<p><strong>{{ $data['user'] }}</strong> ({{ $data['usermail'] }}) ha enviado una nueva propuesta de especie con los siguientes datos:</p>

<ul>
    <li><strong>Género:</strong> {{ $data['genero'] }}</li>
    <li><strong>Especie:</strong> {{ $data['especie'] }}</li>
    <li><strong>Nombre común:</strong> {{ $data['nombre_comun'] ?? 'No especificado' }}</li>
    <li><strong>Toxicidad:</strong> {{ $data['toxicidad'] ?? 'No especificada' }}</li>
    <li><strong>Comestibilidad:</strong> {{ $data['comestibilidad'] ?? 'No especificada' }}</li>
</ul>