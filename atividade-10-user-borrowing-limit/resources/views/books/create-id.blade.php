@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Adicionar Livro (Com ID)</h1>

    <form action="{{ route('books.store.id') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Título --}}
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title" name="title" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Editora --}}
        <div class="mb-3">
            <label for="publisher_id" class="form-label">Editora</label>
            <select class="form-select @error('publisher_id') is-invalid @enderror"
                    id="publisher_id" name="publisher_id" required>
                <option value="" selected disabled>Selecione uma editora</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                @endforeach
            </select>
            @error('publisher_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Autor --}}
        <div class="mb-3">
            <label for="author_id" class="form-label">Autor</label>
            <select class="form-select @error('author_id') is-invalid @enderror"
                    id="author_id" name="author_id" required>
                <option value="" selected disabled>Selecione um autor</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
            @error('author_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Categoria --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select class="form-select @error('category_id') is-invalid @enderror"
                    id="category_id" name="category_id" required>
                <option value="" selected disabled>Selecione uma categoria</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Capa do Livro --}}
        <div class="mb-3">
            <label for="cover_image" class="form-label">Capa do Livro (opcional)</label>
            <input type="file" class="form-control" name="cover_image" id="cover_image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection