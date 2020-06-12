@extends('layouts.principal')

@section('titulo', 'Editar Cliente')

@section('conteudo')

<h3>Novo Cliente</h3>

<form action="{{ route('clientes.update', $cliente['id']) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nome </label><br>
    <input type="text" name="nome" value="{{ $cliente['nome'] }}"><br>
    <input type="submit" value="Salvar">
</form>

@endsection
