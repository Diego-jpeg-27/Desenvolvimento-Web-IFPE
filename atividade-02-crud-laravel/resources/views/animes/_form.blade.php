
{{-- reaproveitamento do formulário para outras views --}}

<form action="{{ isset($anime) ? route('animes.update', $anime) : route('animes.store') }}" method="POST">
     @csrf
      @if(isset($anime))
       @method('PUT')
        @endif

    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $anime->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea id="description" name="description" class="form-control" required>{{ old('description', $anime->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="genre" class="form-label">Gênero</label>
        <input type="text" id="genre" name="genre" class="form-control" value="{{ old('genre', $anime->genre ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="creator" class="form-label">Criador</label>
        <input type="text" id="creator" name="creator" class="form-control" value="{{ old('creator', $anime->creator ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="release_year" class="form-label">Ano de Lançamento</label>
        <input type="number" id="release_year" name="release_year" class="form-control" value="{{ old('release_year', $anime->release_year ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">
        {{ isset($anime) ? 'Atualizar' : 'Salvar' }}
    </button>
</form>
