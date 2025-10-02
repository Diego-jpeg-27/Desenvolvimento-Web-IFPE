@extends('layouts.app')

@section('title', 'Lista de Animes')

@section('content')
    <h1>Lista de Animes</h1>

    <ul>
        @forelse($animes as $anime)
            <li>
                <a href="{{ route('animes.show', $anime) }}">{{ $anime->title }}</a>
            </li>
        @empty
            <li>Nenhum anime cadastrado ainda.</li>
        @endforelse
    </ul>

    <a href="{{ route('animes.create') }}">← Voltar para Cadastro</a>
@endsection
