<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Detalhes do Anime</h1>

        <p><strong>Título:</strong> {{ $anime->title }}</p>
        <p><strong>Descrição:</strong> {{ $anime->description }}</p>
        <p><strong>Gênero:</strong> {{ $anime->genre }}</p>
        <p><strong>Criador:</strong> {{ $anime->creator }}</p>
        <p><strong>Ano de Lançamento:</strong> {{ $anime->release_year }}</p>

        <a href="{{ route('animes.index') }}" class="btn btn-primary">Voltar para Lista</a>
    </div>
</body>
</html>