@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="my-4">Editar Editora</h1>
    
    {{-- DEBUG --}}
    <p>ID: {{ $publisher->id }} | Nome: {{ $publisher->name }} | Endereço atual: "{{ $publisher->address ?? 'N/A' }}"</p>
    
    <form action="{{ route('publishers.update', $publisher) }}" method="POST" 
          onsubmit="console.log('SUBMIT OK!')" novalidate>
        @csrf
        @method('PUT')
        
        <!-- Nome -->
        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name', $publisher->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <!-- Endereço -->
        <div class="mb-3">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror"
                   id="address" name="address" value="{{ old('address', $publisher->address ?? '') }}">
            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <input type="submit" class="btn btn-success" value="Atualizar"> {{-- Mais confiável --}}
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection