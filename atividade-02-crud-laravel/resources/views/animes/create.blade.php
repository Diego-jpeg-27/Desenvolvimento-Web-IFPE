<html>
<head>
 
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Cadastrar Novo Anime</h1>

        <form action="{{ route('animes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Gênero</label>
                <input type="text" id="genre" name="genre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="creator" class="form-label">Criador</label>
                <input type="text" id="creator" name="creator" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="release_year" class="form-label">Ano de Lançamento</label>
                <input type="number" id="release_year" name="release_year" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
</body>
</html>