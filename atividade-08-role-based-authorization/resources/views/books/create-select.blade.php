@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Adicionar Livro (Com Select)</h1>

    <div class="card p-4">
        <form action="{{ route('books.store.select') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="publisher_id" class="form-label">Editora</label>
                <select class="form-select" id="publisher_id" name="publisher_id" required>
                    <option selected>Selecione uma editora</option>
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="author_id" class="form-label">Autor</label>
                <select class="form-select" id="author_id" name="author_id" required>
                    <option selected>Selecione um autor</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option selected>Selecione uma categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Capa do Livro (opcional)</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image">
            </div>

            <div class="d-flex gap-2 mt-4">
                {{-- BOTÃO SALVAR --}}
                <button type="submit" class="btn btn-success">Salvar</button>

                {{-- BOTÃO CANCELAR ADICIONADO AQUI --}}
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    Cancelar 
                </a>
            </div>

        </form>
    </div>
</div>
@endsection