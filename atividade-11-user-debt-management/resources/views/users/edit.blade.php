@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Permissões do Usuário</h1>

    {{-- Exibe erros de validação caso ocorram --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nome (Bloqueado para edição, apenas visualização) --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control bg-light" id="name" value="{{ $user->name }}" disabled>
        </div>

        {{-- Email (Bloqueado para edição) --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control bg-light" id="email" value="{{ $user->email }}" disabled>
        </div>

        {{-- SELETOR DE PAPEL (Obrigatório para a funcionalidade) --}}
        <div class="mb-4">
            <label for="role" class="form-label fw-bold">Papel (Role) no Sistema</label>
            <select name="role" id="role" class="form-control border-primary">
                <option value="cliente" {{ $user->role == 'cliente' ? 'selected' : '' }}>
                    Cliente (Acesso Padrão)
                </option>
                <option value="bibliotecario" {{ $user->role == 'bibliotecario' ? 'selected' : '' }}>
                    Bibliotecário (Gerencia Livros)
                </option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                    Admin (Acesso Total)
                </option>
            </select>
            <div class="form-text text-muted">
                Selecione o nível de acesso que este usuário terá no sistema.
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Salvar Alterações
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection