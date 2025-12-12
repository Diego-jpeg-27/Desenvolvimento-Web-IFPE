@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Botão Voltar para a Lista (UX Enhancement) --}}
    <div class="mb-3">
        <a href="{{ route('books.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Voltar para a Lista de Livros
        </a>
    </div>
    
    {{-- CARD DE INFORMAÇÕES DO LIVRO --}}
    <div class="card mb-4">
        <div class="card-body d-flex">

            {{-- CAPA DO LIVRO --}}
            <div class="me-4">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                         alt="Capa do livro"
                         class="img-thumbnail"
                         style="width: 200px; height: 300px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/200x300?text=Sem+Capa"
                         class="img-thumbnail"
                         style="width: 200px; height: 300px;">
                @endif
            </div>

            {{-- DETALHES DO LIVRO --}}
            <div>
                <h2>{{ $book->title }}</h2>

                <p class="mb-1">
                    <strong>Autor:</strong> {{ $book->author->name }}
                </p>

                <p class="mb-1">
                    <strong>Editora:</strong> {{ $book->publisher->name }}
                </p>

                <p class="mb-1">
                    <strong>Categoria:</strong> {{ $book->category->name }}
                </p>

                @if($book->published_year)
                    <p class="mb-1">
                        <strong>Ano de Publicação:</strong> {{ $book->published_year }}
                    </p>
                @endif
            </div>

        </div>
    </div>


    {{-- FORM DE EMPRÉSTIMO (PROTEGIDO) --}}
    {{-- Apenas Bibliotecários e Admins verão este bloco --}}
    @can('borrow', $book)
        <div class="card mb-4">
            <div class="card-header">Registrar Empréstimo</div>
            <div class="card-body">

                <form action="{{ route('books.borrow', $book) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuário</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            <option value="" selected>Selecione um usuário</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Registrar Empréstimo
                    </button>
                </form>

            </div>
        </div>
    @endcan


    {{-- HISTÓRICO DE EMPRÉSTIMOS --}}
    <div class="card">
        <div class="card-header">Histórico de Empréstimos</div>
        <div class="card-body">

            @if($book->users->isEmpty())
                <p>Nenhum empréstimo registrado.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Data de Empréstimo</th>
                            <th>Data de Devolução</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
    
                    @foreach($book->users as $user)
                        <tr>
                            <td>
                                {{-- Nome do Usuário --}}
                                {{ $user->name }}
                            </td>

                            <td>{{ $user->pivot->borrowed_at }}</td>

                            <td>
                                {{ $user->pivot->returned_at ?? 'Em Aberto' }}
                            </td>

                            <td>
                                @if(!$user->pivot->returned_at)
                                    {{-- PROTEÇÃO DO BOTÃO DEVOLVER --}}
                                    @can('borrow', $book)
                                        <form action="{{ route('borrowings.return', $user->pivot->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button class="btn btn-warning btn-sm">
                                                <i class="bi bi-arrow-return-left"></i>
                                                Devolver
                                            </button>
                                        </form>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endif

        </div>
    </div>

</div>
@endsection