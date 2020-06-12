@extends('layouts.principal')

@section('titulo', 'Lista de Clientes')

@section('conteudo')

<h3>Informações do Cliente</h3>

<p>ID: {{ $cliente['id'] }}</p>
<p>Nome: {{ $cliente['nome'] }}</p>
<br><hr>

<a href="{{ route('clientes.index') }}">Voltar</a>

@endsection
