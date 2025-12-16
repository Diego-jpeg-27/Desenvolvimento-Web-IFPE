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
                                    {{-- Lógica visual para destacar os papéis --}}
                                    @if($user->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @elseif($user->role === 'bibliotecario')
                                        <span class="badge bg-warning text-dark">Bibliotecário</span>
                                    @else
                                        <span class="badge bg-success">Cliente</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Botão de Visualizar REMOVIDO para corrigir o erro --}}

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