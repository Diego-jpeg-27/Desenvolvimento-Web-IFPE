<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Editar Anime</h1>

        <form action="{{ route('animes.update', $anime) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $anime->title }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea id="description" name="description" class="form-control" required>{{ $anime->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Gênero</label>
                <input type="text" id="genre" name="genre" class="form-control" value="{{ $anime->genre }}" required>
            </div>

            <div class="mb-3">
                <label for="creator" class="form-label">Criador</label>
                <input type="text" id="creator" name="creator" class="form-control" value="{{ $anime->creator }}" required>
            </div>

            <div class="mb-3">
                <label for="release_year" class="form-label">Ano de Lançamento</label>
                <input type="number" id="release_year" name="release_year" class="form-control" value="{{ $anime->release_year }}" required>
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>
</body>
</html>