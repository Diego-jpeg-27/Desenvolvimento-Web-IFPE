@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h1>Gerenciar Usuários</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Papel (Role)</th>
                            <th>Débito</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @elseif($user->role === 'bibliotecario')
                                        <span class="badge bg-warning text-dark">Bibliotecário</span>
                                    @else
                                        <span class="badge bg-success">Cliente</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Lógica de exibição do Débito e Botão de Quitação --}}
                                    @if($user->debit > 0)
                                        <span class="text-danger fw-bold">
                                            R$ {{ number_format($user->debit, 2, ',', '.') }}
                                        </span>
                                        <form action="{{ route('users.settle', $user) }}" method="POST" class="d-inline ms-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-success btn-sm" onclick="return confirm('Confirmar pagamento do débito de {{ $user->name }}?')">
                                                <i class="bi bi-cash-stack"></i> Zerar
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">R$ 0,00</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i> Editar Papel
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection