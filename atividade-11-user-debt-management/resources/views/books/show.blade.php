@extends ('layouts.app')
@section('content')
    <div class="container">

        {{-- Botão Voltar --}}
        <div class="mb-3">
            <a href="{{ route('books.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Voltar para a Lista de Livros
            </a>
        </div>

        {{-- Verificação de Status usando o método do Model --}}
        @php
            $isBorrowed = \App\Models\Borrowing::activeLoanForBook($book->id);
        @endphp

        {{-- CARD DE INFORMAÇÕES DO LIVRO --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body d-flex flex-column flex-md-row">

                {{-- CAPA DO LIVRO --}}
                <div class="me-md-4 mb-3 mb-md-0 text-center">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Capa do livro" class="img-thumbnail"
                            style="width: 200px; height: 300px; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light border rounded"
                            style="width: 200px; height: 300px;">
                            <span class="text-muted">Sem Capa</span>
                        </div>
                    @endif
                </div>

                {{-- DETALHES DO LIVRO --}}
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center mb-2">
                        <h2 class="mb-0 me-3">{{ $book->title }}</h2>

                        {{-- BADGE DE STATUS --}}
                        @if($isBorrowed)
                            <span class="badge bg-danger fs-6">
                                <i class="bi bi-bookmark-x"></i> Indisponível (Emprestado)
                            </span>
                        @else
                            <span class="badge bg-success fs-6">
                                <i class="bi bi-check-circle"></i> Disponível
                            </span>
                        @endif
                    </div>
                    <hr>
                    <p class="mb-1"><strong>Autor:</strong> {{ $book->author->name ?? 'Não informado' }}</p>
                    <p class="mb-1"><strong>Editora:</strong> {{ $book->publisher->name ?? 'Não informada' }}</p>
                    <p class="mb-1"><strong>Categoria:</strong> {{ $book->category->name ?? 'Não informada' }}</p>
                    @if($book->published_year)
                        <p class="mb-1"><strong>Ano:</strong> {{ $book->published_year }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- AREA DE AÇÃO - EMPRÉSTIMO --}}
        {{-- Apenas Admin/Bibliotecário veem esta área --}}
        @can('borrow', $book)
            <div class="card mb-4">
                <div class="card-header bg-light fw-bold">
                    <i class="bi bi-journal-arrow-up"></i> Gerenciar Empréstimo
                </div>
                <div class="card-body">

                    {{-- LÓGICA DE EXIBIÇÃO DO FORMULÁRIO (Checklist) --}}
                    @if($isBorrowed)
                        {{-- CENÁRIO 1: LIVRO EMPRESTADO -> MOSTRA AVISO E BLOQUEIA FORM --}}
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-circle-fill fs-4 me-2"></i>
                            <div>
                                <strong>Atenção:</strong> Este livro já possui um empréstimo ativo.
                                É necessário realizar a devolução antes de emprestar novamente.
                            </div>
                        </div>

                        {{-- Botão desabilitado apenas visualmente para reforçar --}}
                        <button class="btn btn-secondary" disabled>
                            <i class="bi bi-plus-circle"></i> Registrar Empréstimo (Indisponível)
                        </button>

                    @else
                        {{-- CENÁRIO 2: LIVRO DISPONÍVEL -> MOSTRA FORMULÁRIO --}}
                        <form action="{{ route('books.borrow', $book) }}" method="POST">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <label for="user_id" class="form-label">Selecione o Usuário para Empréstimo</label>
                                    <select class="form-select" id="user_id" name="user_id" required>
                                        <option value="" selected>Escolha um usuário...</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-check-lg"></i> Confirmar Empréstimo
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        @endcan

        {{-- HISTÓRICO DE EMPRÉSTIMOS --}}
        <div class="card">
            <div class="card-header">Histórico de Movimentações</div>
            <div class="card-body">
                @if($book->users->isEmpty())
                    <p class="text-muted text-center my-3">Nenhum histórico de empréstimo para este livro.</p>
                @else
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Data Retirada</th>
                                <th>Data Devolução</th>
                                <th>Status/Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($book->users->sortByDesc('pivot.borrowed_at') as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->pivot->borrowed_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($user->pivot->returned_at)
                                            <span class="text-success">{{ $user->pivot->returned_at->format('d/m/Y H:i') }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Em Aberto</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Botão de Devolver só aparece se não foi devolvido ainda --}}
                                        @if(!$user->pivot->returned_at)
                                            @can('borrow', $book)
                                                <form action="{{ route('borrowings.return', $user->pivot->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-sm btn-outline-warning">
                                                        <i class="bi bi-arrow-return-left"></i> Receber Devolução
                                                    </button>
                                                </form>
                                            @endcan
                                        @else
                                            <i class="bi bi-check-all text-success"></i> Concluído
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