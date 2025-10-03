@extends('layouts.app')

@section('content')

{{-- Formulário --}}
@include('animes._form', ['anime' => null])
@endsection
  
{{-- Botão de Voltar --}}
<a href="{{ url('/') }}" class="btn btn-secondary" style="margin-bottom: -220px; display: inline-block;"> Voltar </a>