@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="my-4">Lista de Livros</h1>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    {{--
        BOTÕES DE CRIAÇÃO
        Apenas quem tem permissão de 'create' (Admin e Bibliotecário) verá isso.
    --}}
    @can('create', App\Models\Book::class)
        <div class="mb-4">
            <a href="{{ route('books.create.id') }}" class="btn btn-success">
                <i class="bi bi-plus"></i> Adicionar Livro (Com ID)
            </a>


            <a href="{{ route('books.create.select') }}" class="btn btn-primary">
                <i class="bi bi-plus"></i> Adicionar Livro (Com Select)
            </a>
        </div>
    @endcan


    {{-- LISTA EM MODELO DE CARD --}}
    <div class="row g-4">


        @foreach($books as $book)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">


                {{-- CAPA --}}
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                         class="card-img-top"
                         style="height: 280px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/300x450?text=Sem+Capa"
                         class="card-img-top"
                         style="height: 280px; object-fit: cover;">
                @endif


                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="text-muted mb-2">
                        <strong>Autor:</strong> {{ $book->author->name }}
                    </p>


                    <div class="d-flex gap-2">


                        {{-- Visualizar: Todos podem ver (conforme Policy view) --}}
                        <a href="{{ route('books.show', $book->id) }}"
                           class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>


                        {{-- Editar: Apenas Admin/Bibliotecário --}}
                        @can('update', $book)
                            <a href="{{ route('books.edit', $book->id) }}"
                               class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        @endcan


                        {{-- Deletar: Apenas Admin/Bibliotecário --}}
                        @can('delete', $book)
                            <form action="{{ route('books.destroy', $book->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja excluir este livro?')">


                                @csrf
                                @method('DELETE')


                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Deletar
                                </button>
                            </form>
                        @endcan


                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>


    {{-- Paginação --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection