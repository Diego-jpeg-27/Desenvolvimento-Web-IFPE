@extends('layouts.app')


@section('content')
    <div class="container">
        <h1 class="my-4">Lista de Usuários</h1>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
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