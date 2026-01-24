@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Lista de Livros</h1>
            @can('create', App\Models\Book::class)
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Novo Livro
                </a>
            @endcan
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Capa</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Categoria</th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>
                                    @if($book->cover_image)
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Capa" width="50"
                                            class="rounded">
                                    @else
                                        <span class="text-muted"><i class="bi bi-book" style="font-size: 1.5rem;"></i></span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $book->title }}</td>
                                <td>{{ $book->author->name ?? 'N/A' }}</td>
                                <td>{{ $book->category->name ?? 'N/A' }}</td>

                                {{-- LÓGICA DO STATUS --}}
                                <td class="text-center">
                                    @php
                                        // Usamos o método estático que criamos no Model Borrowing
                                        $isBorrowed = \App\Models\Borrowing::activeLoanForBook($book->id);
                                    @endphp

                                    @if($isBorrowed)
                                        <span class="badge bg-danger">
                                            <i class="bi bi-bookmark-x-fill"></i> Emprestado
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle-fill"></i> Disponível
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>

                                    @can('update', $book)
                                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan

                                    @can('delete', $book)
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Nenhum livro cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $books->links() }}
        </div>
    </div>
@endsection