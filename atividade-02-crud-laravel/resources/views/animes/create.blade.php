@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Cadastrar Novo Anime</h1>

    @include('animes._form', ['anime' => null])
@endsection