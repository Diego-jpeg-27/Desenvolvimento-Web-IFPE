@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="my-4">Editar Autor</h1>
   
    {{-- DEBUG --}}
    <p>ID: {{ $author->id }} | Nome atual: {{ $author->name }} | Email atual: {{ $author->email ?? 'N/A' }}</p>
   
    <form action="{{ route('authors.update', $author) }}" method="POST" onsubmit="console.log('SUBMIT OK!');" novalidate>
        @csrf
        @method('PUT')
       
        <!-- Nome -->
        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name', $author->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail *</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email', $author->email) }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <!-- Data Nascimento -->
        <div class="mb-3">
            <label for="birth_date" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                   id="birth_date" name="birth_date" value="{{ old('birth_date', $author->birth_date) }}">
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <input type="submit" class="btn btn-success" value="Atualizar">
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection