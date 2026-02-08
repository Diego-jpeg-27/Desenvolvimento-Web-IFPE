@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="mb-4">
            <h1>Lista de Livros</h1>
            @can('create', App\Models\Book::class)
                <a href="{{ route('books.create') }}" class="btn btn-success mt-2">
                    <i class="bi bi-plus-lg"></i> Novo Livro
                </a>
            @endcan
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive"> {{-- Adicionado para responsividade em telas pequenas --}}
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Capa</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Categoria</th>
                                <th class="text-center">Status</th>
                                <th class="text-end" style="min-width: 120px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>

                                    {{-- CAPA --}}
                                    <td>
                                        @if($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Capa"
                                                class="rounded shadow-sm" style="width: 80px; height: 110px; object-fit: cover;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light rounded border"
                                                style="width: 80px; height: 110px;">
                                                <i class="bi bi-book text-muted" style="font-size: 1.5rem;"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="fw-bold text-wrap" style="max-width: 250px;">{{ $book->title }}</td>
                                    <td>{{ $book->author->name ?? 'N/A' }}</td>
                                    <td>{{ $book->category->name ?? 'N/A' }}</td>

                                    {{-- STATUS --}}
                                    <td class="text-center">
                                        @php
                                            $isBorrowed = \App\Models\Borrowing::activeLoanForBook($book->id);
                                        @endphp

                                        @if($isBorrowed)
                                            <span class="badge bg-danger rounded-pill">
                                                <i class="bi bi-bookmark-x-fill"></i> Emprestado
                                            </span>
                                        @else
                                            <span class="badge bg-success rounded-pill">
                                                <i class="bi bi-check-circle-fill"></i> Disponível
                                            </span>
                                        @endif
                                    </td>

                                    {{-- AÇÕES ORGANIZADAS --}}
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2"> {{-- Flexbox com espaçamento padrão --}}

                                            {{-- Botão VER --}}
                                            <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary"
                                                title="Ver Detalhes">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                            @can('update', $book)
                                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-secondary"
                                                    title="Editar">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            @endcan

                                            @can('delete', $book)
                                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-emoji-frown fs-1 d-block mb-2"></i>
                                        Nenhum livro cadastrado no sistema.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
@endsection